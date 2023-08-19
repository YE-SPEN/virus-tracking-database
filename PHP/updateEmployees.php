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
$employee_ID = $_POST['employee_ID'];
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$role = $_POST['employee_role'];
$email = $_POST['email'];
$phone = $_POST['telephone'];
$medicare = $_POST['medicare_number'];
$dob = $_POST['date_of_birth'];
$citizenship = $_POST['citizenship'];
$address = $_POST['address'];
$city = $_POST['city'];
$postal = $_POST['postal_code'];

     // Add Employee to Locations table
     $checkKeys = "SELECT COUNT(*) AS count FROM Locations WHERE postal_code = '$postal';";
     $result = $conn->query($checkKeys);
     while($row = mysqli_fetch_assoc($result)){
     
        if($row["count"] == 0){
        $addLocation = "INSERT INTO Locations (address, city, postal_code) VALUES ('$address', '$city', '$postal')";
        if ($conn->query($addLocation) === TRUE) {
            echo "<h4 class='log'>New Location record created successfully!</h4>";
            
            $updateEmployee = "UPDATE Employees
            SET first_name = '$firstName',
                last_name = '$lastName',
                employee_role = '$role',
                email = '$email',
                telephone = '$phone',
                medicare_number = '$medicare',
                date_of_birth = '$dob',
                postal_code = '$postal'
            WHERE employee_ID = $employee_ID;";
            
            if ($conn->query($updateEmployee) === TRUE) {
                echo "<h4 class='log'>Employee $employee_ID updated successfully!</h4>";
            } 
            else {
                echo "Error: " . $updateEmployee . "<br>" . $conn->error;
            }
    
        } 
        else{
            echo "<h4 class='log'>Error adding new location</h4>";
        }
    }
    else {
        echo "Error: " . $postal . " already exists in the database";
        $updateEmployee = "UPDATE Employees
            SET first_name = '$firstName',
                last_name = '$lastName',
                employee_role = '$role',
                email = '$email',
                telephone = '$phone',
                medicare_number = '$medicare',
                date_of_birth = '$dob'
            WHERE employee_ID = $employee_ID;";
            if ($conn->query($updateEmployee) === TRUE) {
                echo "<h4 class='log'>Employee $employee_ID updated successfully!</h4>";
            } 
            else {
                echo "Error: " . $updateEmployee . "<br>" . $conn->error;
            }
    }
}
        
    

?>