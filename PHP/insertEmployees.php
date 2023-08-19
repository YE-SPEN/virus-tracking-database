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
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$facility = $_POST['facility_ID'];
$role = $_POST['employee_role'];
$email = $_POST['email'];
$phone = $_POST['telephone'];
$medicare = $_POST['medicare_number'];
$dob = $_POST['date_of_birth'];
$citizenship = $_POST['citizenship'];
$address = $_POST['address'];
$city = $_POST['city'];
$postal = $_POST['postal_code'];

// add Employee to Locations table
$addLocation = "INSERT INTO Locations (address, city, postal_code) VALUES ('$address', '$city', '$postal')";
if ($conn->query($addLocation) === TRUE) {
    echo "<h4 class='log'>New Location record created successfully!</h4>";
} 
else {
    echo "Error: " . $addLocation . "<br>" . $conn->error;
}

// check capacity of assigned facility
$checkCapacity = "SELECT capacity, active_employees FROM Facilities WHERE facility_ID = '$facility'";
$capResult = $conn->query($checkCapacity);
$row = $capResult->fetch_assoc();
$capacity = $row['capacity'];
$active = $row['active_employees'];

if ($active >= $capacity) {
    echo "<h4 class='log'>Facility #" . $facility . " is at capacity and cannot add new employees.</h4>";
}

else {
    $newActive = $active +1;

    $addEmployee = "INSERT INTO Employees (first_name, last_name, employee_role, email, telephone, medicare_number, date_of_birth, citizenship, postal_code) VALUES ('$firstName', '$lastName', '$role', '$email', '$phone', '$medicare', '$dob', '$citizenship', '$postal')";
    if ($conn->query($addEmployee) === TRUE) {
        echo "<h4 class='log'>New Employee record created successfully!</h4>";
    } 
    else {
        echo "Error: " . $addEmployee . "<br>" . $conn->error;
    }

    $updateSTMT = "UPDATE Facilities SET active_employees = (active_employees+1) WHERE facility_ID = '$facility'";
    if ($conn->query($updateSTMT) === TRUE) {
        echo "<h4 class='log'>Facility #" . $facility . " active employees updated to " . $newActive . "</h4>";
    } 
    else {
        echo "Error: " . $updateSTMT . "<br>" . $conn->error;
    }

    // Retrieve new EID generated
    $getEID = "SELECT employee_ID FROM Employees WHERE medicare_number = '$medicare'";
    $result = $conn->query($getEID);
    $row = $result->fetch_assoc();
    $newEID = $row['employee_ID'];

    // Get Current date
    $startDate = date("Y-m-d");

    // Open Employment History Record for New Employee
    $insertSTMT = "INSERT INTO Employment_History (employee_ID, facility_ID, employee_role, start_date) VALUES ('$newEID', '$facility', '$role', '$startDate')";
    if ($conn->query($insertSTMT) === TRUE) {
        echo "<h4 class='log'>Employment History record opened for Employee #" . $newEID . " at Facility #" . $facility . " beginning on " . $startDate . "</h4>";
    } 
    else {
        echo "Error: " . $insertSTMT . "<br>" . $conn->error;
    }

}

?>