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
$manager = $_POST['employee'];
$facility = $_POST['facility'];

// Check if Facility exists in manager table
$checkSTMT = "SELECT manager_ID FROM Managers WHERE facility_ID = '$facility'";
$checkResult = $conn->query($checkSTMT);

$insertSTMT = "INSERT INTO Managers (manager_ID, facility_ID) VALUES ('$manager', '$facility')";
if ($conn->query($insertSTMT) === TRUE) {
    echo "<h4 class='log'>New Manager created successfully.</h4>";
} 
else {
    echo "Error: " . $insertSTMT . "<br>" . $conn->error;
}

// delete old manager
if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    $oldManager = $row['manager_ID'];

    $deleteSTMT = "DELETE FROM Managers WHERE manager_ID = '$oldManager'";
    if ($conn->query($deleteSTMT) === TRUE) {
        echo "<h4 class='log'>Old Manager deleted successfully.</h4>";
    } 
    else {
        echo "Error: " . $deleteSTMT . "<br>" . $conn->error;
    }
}

// Update Manager's Role Employees table
$updateSTMT3 = "UPDATE Employees SET employee_role = 'Administration' WHERE employee_ID = '$manager'";
if ($conn->query($updateSTMT3) === TRUE) {
    echo "<h4 class='log'>Employee #" . $manager . " Role Updated to ADMINISTRATION.</h4>";
} 
else {
    echo "Error: " . $updateSTMT3 . "<br>" . $conn->error;
}

?>
