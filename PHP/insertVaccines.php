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

// update isVaccinated in Employees table
$updateSTMT = "UPDATE Employees SET isVaccinated = 1 WHERE employee_ID = '$employee'";
$conn->query($updateSTMT);

// Get Dose number
$doseSTMT = "SELECT count(employee_ID) AS dose_count FROM Vaccines WHERE employee_ID = '$employee' GROUP BY employee_ID";
$result = $conn->query($doseSTMT);
$row = $result->fetch_assoc();
$dose = (int) $row['dose_count'];
$dose += 1;

// Insert the data into the database
$insertSTMT = "INSERT INTO Vaccines (employee_ID, facility_ID, type, vax_date, dose_number) VALUES ('$employee', '$facility', '$type', '$date', '$dose')";

if ($conn->query($insertSTMT) === TRUE) {
    echo "<h4 class='log'>New Vaccination logged successfully.</h4>";
} 
else {
    echo "Error: " . $insertSTMT . "<br>" . $conn->error;
}
?>