<?php
include 'foo.php';

$servername = "occ5531.encs.concordia.ca";
$username = "occ55314";
$password = "ANELES11";
$dbname = "occ55314";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
         
// Get the form data
$employee = $_POST['employee_ID'];
$severity = $_POST['severity'];
$nature = $_POST['nature_of_infection'];
$date = $_POST['date_of_infection'];
$infectionDate = DateTime::createFromFormat('Y-m-d', $date);
$infectionDateStr = $infectionDate->format('Y-m-d');


// update wasInfected in Employees table
$updateSTMT = "UPDATE Employees SET wasInfected = 1 WHERE employee_ID = '$employee'";
$conn->query($updateSTMT);

// Verify role of infected employee
$getDetails = "SELECT e.employee_role, f.facility_ID, f.facility_name, m.manager_ID FROM Employees e, Facilities f, Managers m, Employment_History h WHERE e.employee_ID = h.employee_ID AND h.facility_ID = f.facility_ID AND f.facility_ID = m.facility_ID AND e.employee_ID = '$employee'";
$detailResult = $conn->query($getDetails);
$row = $detailResult->fetch_assoc();
$role = $row['employee_role'];
$facilityID = $row['facility_ID'];
$facility = $row['facility_name'];
$manager = $row['manager_ID'];

if ($role == 'Nurse' || $role == 'Doctor') {
    
    // initialize important dates
    $today = new DateTime();
    $todayStr = $today->format('Y-m-d H:i:s');
    $twoWeeksAgo = (DateTime::createFromFormat('Y-m-d', $date))->sub(new DateInterval('P14D'));
    $twoWeeksAgoStr = $twoWeeksAgo->format('Y-m-d');   
    $inTwoWeeks = (DateTime::createFromFormat('Y-m-d', $date))->add(new DateInterval('P14D'));
    $inTwoWeeksStr = $inTwoWeeks->format('Y-m-d');

    // clear Infected employee schedule for two weeks
    $updateSTMT = "UPDATE Schedule SET status = 'Canceled' WHERE employee_ID = $employee AND (date BETWEEN '$infectionDateStr' AND '$inTwoWeeksStr')";
    if ($conn->query($updateSTMT) === TRUE) {
        echo "<h4 class='log'>Schedule cleared for Employee #" . $employee . " until " . $inTwoWeeksStr . "</h4>";
    } 
    else {
        echo "Error: " . $updateSTMT . "<br>" . $conn->error;
    }  

    // Retrieve Close Contact Nurses & Doctors
    $closeContacts = "SELECT DISTINCT e.employee_ID FROM Employees e, Schedule s, Employment_History h WHERE e.employee_ID = s.employee_ID AND e.employee_ID = h.employee_ID AND s.date > '$twoWeeksAgoStr' AND h.facility_ID = '$facilityID' AND (e.employee_role = 'Nurse' OR e.employee_role = 'Doctor');";
    $contactResult = $conn->query($closeContacts);

    while ($row = $contactResult->fetch_assoc()) {
        $contactID = $row['employee_ID'];

        // Send Email Alert & Clear Schedule
        $emailSTMT = "INSERT INTO Emails (employee_ID, date_time, sender_ID, subject, body) VALUES ('$contactID', '$todayStr', '$manager', 'ALERT: A Close Contact has Tested Positive for $nature', 'An Employee Infection has been recorded at $facility on $infectionDateStr, the infected employee will not be returning to work until $inTwoWeeksStr.')";
        if ($conn->query($emailSTMT) === TRUE) {
            echo "<h4 class='log'>Close contact email alert sent to Employee #" . $contactID . "</h4>";
        } 
        else {
            echo "Error: " . $emailSTMT . "<br>" . $conn->error;
        } 
    }
}

// Insert Infection into the database
$insertSTMT = "INSERT INTO Infections (employee_ID, severity, nature_of_infection, date_of_infection) VALUES ('$employee', '$severity', '$nature', '$date')";

if ($conn->query($insertSTMT) === TRUE) {
    echo "<br><h4 class='log'>New Infection logged successfully.</h4>";
} 
else {
    echo "Error: " . $insertSTMT . "<br>" . $conn->error;
}
?>