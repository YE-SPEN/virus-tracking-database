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
$employee = $_POST['eid'];
$facility = $_POST['fid'];
$shiftDate = $_POST['shift_date'];
$start = $_POST['start'];
$startTime = date('H:i', strtotime($start));
$end = $_POST['end'];
$endTime = date('H:i', strtotime($end));

// check vaccination status
$vaxCheck = "SELECT isVaccinated FROM Employees WHERE employee_ID = '$employee'";
$result = $conn->query($vaxCheck);
$row = $result->fetch_assoc();
$vaxStatus = $row['isVaccinated'];
$recentVaxDate = NULL;

if ($vaxStatus == 1) {
    $sixMonthsAgo = (new DateTime())->modify('-6 months');
    
    $recentVax = "SELECT vax_date FROM Vaccines WHERE employee_ID = '$employee' AND dose_number = (SELECT max(dose_number) FROM Vaccines WHERE employee_ID = '$employee' GROUP BY employee_ID)";
    $vaxResult = $conn->query($recentVax);
    $row = $vaxResult->fetch_assoc();
    $recentVaxDate = DateTime::createFromFormat('Y-m-d', $row['vax_date']);
}

if ($vaxStatus == 0 || $sixMonthsAgo > $recentVaxDate) {
    echo "<h4 class='log'>Cannot create schedule. Employee must have been vaccinated within the past 6 months.</h4>";
}

else {
    // check for schedule conflict
    $dateCheck = "SELECT start_time, end_time FROM Schedule WHERE employee_ID = '$employee' AND date = '$shiftDate'";
    $dateResult = $conn->query($dateCheck);
    
    if ($dateResult->num_rows > 0) {
        $row = $dateResult->fetch_assoc();
        $confStart = $row['start_time'];
        $confStartTime = date('H:i', strtotime($confStart));
        $confEnd = $row['end_time'];
        $confEndTime = date('H:i', strtotime($confEnd));

        $startDiff = (strtotime($startTime) - strtotime($confEndTime)) / 3600;
        $endDiff = (strtotime($endTime) - strtotime($confStartTime)) / 3600;

        if ($startDiff <= 1 || $endDiff <= 1) {
            echo "<h4 class='log'>Schedule Conflict. Employee #" . $employee . " is already working during this time on " . $shiftDate . "</h4>";
        }
        else { 
            // Insert the data into the database
            $insertSTMT = "INSERT INTO Schedule (employee_id, facility_id, date, start_time, end_time) VALUES ('$employee', '$facility', '$shiftDate', '$start', '$end')";
    
            if ($conn->query($insertSTMT) === TRUE) {
                echo "<h4 class='log'>Schedule Updated for Employee #" . $employee . "</h4>";
            } 
            else {
                echo "Error: " . $insertSTMT . "<br>" . $conn->error;
            }
        }
    } 

    else { 
        // Insert the data into the database
        $insertSTMT = "INSERT INTO Schedule (employee_id, facility_id, date, start_time, end_time) VALUES ('$employee', '$facility', '$shiftDate', '$start', '$end')";

        if ($conn->query($insertSTMT) === TRUE) {
            echo "<h4 class='log'>Schedule Updated for Employee #" . $employee . "</h4>";
        } 
        else {
            echo "Error: " . $insertSTMT . "<br>" . $conn->error;
        }
    }
}
?>