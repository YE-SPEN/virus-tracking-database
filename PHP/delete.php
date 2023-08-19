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

// Get the URL data
$table = $_GET['table'];

if ($table == "Employees") {
    $employee = $_GET['id'];

    $deleteSTMT = "DELETE FROM Employees WHERE employee_ID = '$employee'";
    if ($conn->query($deleteSTMT) === TRUE) {
        echo "<h4 class='log'>Employee #" . $employee . " has been deleted from the HFESTS Database.</h4>";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($table == "Facilities") {
    $facility = $_GET['facility_id'];

    $deleteSTMT = "DELETE FROM Facilities WHERE facility_ID = '$facility'";
    if ($conn->query($deleteSTMT) === TRUE) {
        echo "<h4 class='log'>Facility #" . $facility . " has been deleted from the HFESTS Database.</h4>";
    } 
    else {
        echo "Error: " . $deleteSTMT . "<br>" . $conn->error;
    }
}

if ($table == "Infections") {
    $employee = $_GET['id'];
    $date = $_GET['date_of_infection'];

    $deleteSTMT = "DELETE FROM Infections WHERE employee_ID = '$employee' AND date_of_infection = '$date'";
    if ($conn->query($deleteSTMT) === TRUE) {
        echo "<h4 class='log'>Infection record deleted.</h4>";
    } 
    else {
        echo "Error: " . $deleteSTMT . "<br>" . $conn->error;
    }
}

if ($table == "Vaccines") {
    $employee = $_GET['id'];
    $dose = $_GET['dose'];

    $deleteSTMT = "DELETE FROM Vaccines WHERE employee_ID = '$employee' AND dose_number = '$dose'";
    if ($conn->query($deleteSTMT) === TRUE) {
        echo "<h4 class='log'>Vaccination record deleted.</h4>";
    } 
    else {
        echo "Error: " . $deleteSTMT . "<br>" . $conn->error;
    }
}

?>