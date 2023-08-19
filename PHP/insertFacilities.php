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
$facility = $_POST['facility_name'];
$type = $_POST['type'];
$address = $_POST['address'];
$city = $_POST['city'];
$postal = $_POST['postal_code'];
$capacity = $_POST['capacity'];
$url = $_POST['web_URL'];

// add Employee to Locations table
$addLocation = "INSERT INTO Locations (address, city, postal_code) VALUES ('$address', '$city', '$postal')";
if ($conn->query($addLocation) === TRUE) {
    echo "<h4 class='log'>New Location record created successfully!</h4>";
} 
else {
    echo "Error: " . $addLocation . "<br>" . $conn->error;
}

// Insert the data into the database
$sql = "INSERT INTO Facilities (facility_name, type, capacity, web_URL, postal_code) VALUES ('$facility', '$type', '$capacity', '$url', '$postal')";

if ($conn->query($sql) === TRUE) {
    echo "<h4 class='log'>New Facility record created successfully.</h4>";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

