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
$id = $_POST['facility_ID'];
$facility_name = $_POST['facility_name'];
$type = $_POST['type'];
$capacity = $_POST['capacity'];
$url = $_POST['web_URL'];
$address = $_POST['address'];
$city = $_POST['city'];
$postal = $_POST['postal_code'];



$addLocation = "INSERT INTO Locations (address, city, postal_code) VALUES ('$address', '$city', '$postal')";
if ($conn->query($addLocation) === TRUE) {
    echo "<h4 class='log'>New Location record created successfully!</h4>";
} 
else {
    echo "<h4 class='log'>Address already exists in the system</h4>";
}

// Insert the data into the database
$updateFacility = "UPDATE Facilities
SET type = '$type',
    capacity = '$capacity',
    facility_name = '$facility_name',
    web_URL = '$url',
    postal_code = '$postal'
WHERE facility_ID = $id;";
if ($conn->query($updateFacility) === TRUE) {
echo "<h4 class='log'>Facility $id updated successfully!</h4>";
} 
else {
echo "Error: " . $updateFacility . "<br>" . $conn->error;
}



?>