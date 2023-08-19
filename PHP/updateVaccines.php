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
$facility = $_POST['facility_id'];
$type = $_POST['type'];
$date = $_POST['vax_date'];
$vaccineDate = DateTime::createFromFormat('Y-m-d', $date);
$vaccineDateStr = $vaccineDate->format('Y-m-d');


// Update Infection in the database
$updateVaccine = "UPDATE Vaccines
SET type = '$type',
    facility_ID = '$facility'
WHERE employee_ID = $employee AND vax_date = '$vaccineDateStr'";
if ($conn->query($updateVaccine) === TRUE) {
echo "<h4 class='log'>Vaccination Record updated successfully </h4>";
} 
else {
echo "Error: " . $updateVaccine . "<br>" . $conn->error;
}

?>