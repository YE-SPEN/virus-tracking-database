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
$facility = $_POST['fid'];
$start = $_POST['start'];
$periodStart = DateTime::createFromFormat('Y-m-d', $start);
$periodStartStr = $periodStart->format('Y-m-d');

$end = $_POST['end'];
$periodEnd = DateTime::createFromFormat('Y-m-d', $end);
$periodEndStr = $periodEnd->format('Y-m-d');

$today = new DateTime();
$todayStr = $today->format('Y-m-d H:i:s');

// get facility manager ID
$getManager = "SELECT manager_ID FROM Managers WHERE facility_ID = '$facility'";
$result = $conn->query($getManager);
$row = $result->fetch_assoc();
$manager = $row['manager_ID'];

// get Facility Name
$getName = "SELECT facility_name FROM Facilities WHERE facility_ID = '$facility'";
$result2 = $conn->query($getName);
$row = $result2->fetch_assoc();
$facilityName = $row['facility_name'];

$emailSubject = "$facilityName: Schedule for period Beginning $periodStartStr";

// find active employee IDs
$getEmployees = "SELECT employee_ID FROM Employment_History WHERE facility_ID = '$facility' AND end_date IS NULL";
$contactResult = $conn->query($getEmployees);

while ($row = $contactResult->fetch_assoc()) {
    $employee = $row['employee_ID'];
    $emailBody = '';
    $workDay = clone $periodStart;

    while ($workDay <= $periodEnd) {
        $workDayStr = $workDay->format('Y-m-d');
        $getSchedule = "SELECT start_time, end_time FROM Schedule WHERE facility_ID = '$facility' AND employee_ID = '$employee' AND date = '$workDayStr'";
        $scheduleResult = $conn->query($getSchedule);
        
        if ($scheduleResult->num_rows == 0) {
            $emailBody .= $workDayStr . ": No Assignment\n";
        }      
        else {
            $shift = $scheduleResult->fetch_assoc();
            $startTime = $shift['start_time'];
            $endTime = $shift['end_time'];
            $emailBody .= $workDayStr . ": $startTime - $endTime\n";
        }
        $workDay->modify('+1 day');
    }

    // Send email to employee with full schedule during the period
    $emailSTMT = "INSERT INTO Emails (employee_ID, date_time, sender_ID, subject, body) VALUES ('$employee', '$todayStr', '$manager', '$emailSubject', '$emailBody')";
        
    if ($conn->query($emailSTMT) === TRUE) {
        echo "<h4 class='log'>Schedule Email sent to Employee #" . $employee . "</h4>";
    } 
    else {
        echo "Error: " . $emailSTMT . "<br>" . $conn->error;
    }
}

?>
