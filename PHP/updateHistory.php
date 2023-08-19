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
$action = $_POST['action'];
$employee = $_POST['employee_ID'];
$facility = $_POST['facility_ID'];
$role = $_POST['employee_role'];
$date = $_POST['date'];

// check capacity of affected facility
$checkCapacity = "SELECT capacity, active_employees FROM Facilities WHERE facility_ID = '$facility'";
$capResult = $conn->query($checkCapacity);
$row = $capResult->fetch_assoc();
$capacity = $row['capacity'];
$active = $row['active_employees'];

if ($active == $capacity) {
    echo "<h4 class='log'>Facility #" . $facility . " is at capacity and cannot add new employees.</h4>";
} 

if ($active < $capacity && $action == 'ADD') {
    $newActive = $active+1;

    $insertSTMT = "INSERT INTO Employment_History (employee_ID, facility_ID, employee_role, start_date) VALUES ('$employee', '$facility', '$role', '$date')";
    if ($conn->query($insertSTMT) === TRUE) {
        echo "<h4 class='log'>New Employment record created for Employee #" . $employee . " at Facility #" . $facility . "</h4>";
    } 
    else {
        echo "Error: " . $insertSTMT . "<br>" . $conn->error;
    }

    $updateFAC = "UPDATE Facilities SET active_employees = '$newActive' WHERE facility_ID = '$facility'";
    if ($conn->query($updateFAC) === TRUE) {
        echo "<h4 class='log'>Facility #" . $facility . " active employees updated to " . $newActive . "</h4>";
    } 
    else {
        echo "Error: " . $updateFAC . "<br>" . $conn->error;
    }

    $updateStatus = "UPDATE Employees SET isActive = 1 WHERE employee_ID = '$employee'";
    $conn->query($updateStatus);
}

if ($action == 'TERMINATE') {
    $newActive = $active-1;
    
    // terminate selected employee record
    $updateEH = "UPDATE Employment_History SET end_date = '$date' WHERE facility_ID = '$facility' AND employee_ID = $employee";
    if ($conn->query($updateEH) === TRUE) {
        echo "<h4 class='log'>Employment Record updated for Employee #" . $employee . ".</h4>";
    } 
    else {
        echo "Error: " . $updateEH . "<br>" . $conn->error;
    }

    // decrement active employees for selected facility
    $updateFAC = "UPDATE Facilities SET active_employees = '$newActive' WHERE facility_ID = '$facility'";
    if ($conn->query($updateFAC) === TRUE) {
        echo "<h4 class='log'>Facility #" . $facility . " active employees updated to " . $newActive . "</h4>";
    } 
    else {
        echo "Error: " . $updateFAC . "<br>" . $conn->error;
    }

    // check if employee active in any other facility
    $checkActive = "SELECT start_date FROM Employment_History WHERE employee_ID = '$employee' AND end_date IS NULL";
    $checkResult = $conn->query($checkActive);
        
    if ($checkResult->num_rows == 0) {
        $updateStatus = "UPDATE Employees SET isActive = 0 WHERE employee_ID = '$employee'";

        if ($conn->query($updateStatus) === TRUE) {
            echo "<h4 class='log'>Employee #" . $employee . " set to inactive.</h4>";
        } 
        else {
            echo "Error: " . $updateStatus . "<br>" . $conn->error;
        }
    }
}
?>