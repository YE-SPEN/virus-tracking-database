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


// Update Infection in the database
$updateInfection = "UPDATE Infections
SET severity = '$severity',
    nature_of_infection = '$nature'
WHERE employee_ID = $employee AND date_of_infection = '$infectionDateStr'";
if ($conn->query($updateInfection) === TRUE) {
echo "<h4 class='log'>Infection Record updated successfully </h4>";
} 
else {
echo "Error: " . $updateInfection . "<br>" . $conn->error;
}

?>