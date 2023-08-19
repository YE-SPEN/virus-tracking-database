<html>
<head>
  <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>HFESTS Hub</title>
  <style>  
    header {
      display: flex;
      align-items: center;
    }
    .logo {
      margin-right: 20px;
      align-items: top;
    } 
    nav {
      display: flex;
      gap: 10px;
      font-size: 16px;
      align-items: center;
    } 
    nav a {
      color: white;
      text-decoration: none;
      font-weight: normal;
      transition: font-weight 0.2s ease-in-out;
      padding: 10px;
    }
    nav a:hover {
      color: white;  
      text-decoration: none;
      border: 1.5px solid white;
      border-radius: 14px;
    }
    nav a.active {
      background-color: white;
      font-weight: bold;
      color: #222222;
      border-radius: 14px;
    }
    body {
      background-color: #008080;
      margin: 50px;
      font-family: Tahoma;
    }
    h1, h2, h3, h4 {
      font-family: Tahoma;
      color: #064D51;
      font-weight: bold;
    }
    h4.log {
      color: #fff;
    }
    .container {
      background-color: #fff;
      color: #222222;
      width: 100%;
      font-family: Tahoma;
      border-radius: 18px;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background-color: #fff;
    }
    th, td {
      border: 1px solid #dddddd;
      padding: 8px;
      text-align: left;
      font-family: Tahoma;
    }
    th {
      border-collapse: collapse;
      background-color: #064D51;
      color: #fff;
      position: sticky;
      top: -5;
    }
    input[type="text"], select {
      width: 100%;
      box-sizing: border-box;
      border-radius: 4px;
      font-size: 14px;
      background-color: #fff;
      background-image: url('searchicon.png');
      background-position: 10px 10px; 
      background-repeat: no-repeat;
      padding: 12px 12px 12px 12px;
      color: #222222;
      -webkit-transition: width 0.4s ease-in-out;
      transition: width 0.4s ease-in-out;
    }
    .btn-primary {
      background-color: #008080;
    }
    .btn-primary:hover {
      background-color: #064D51;
      transition: background-color 0.5s ease;
    }
    .btn-primary:focus {
    background-color: #064D51;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    transition: box-shadow 0.5s ease;
    }
    .btn-secondary {
      background-color: #f7f7f7;
      border: 1px solid #064D51;
    }
    .btn-secondary:hover {
      background-color: #dddddd;
      transition: background-color 0.5s ease;
      border: 1px solid #064D51;
    }
    .btn-secondary:focus {
    background-color: #dddddd;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    transition: box-shadow 0.5s ease;
    border: 1px solid #064D51;
    }
    .myBox {
      border: none;
      padding: 5px;
      font: 24px/36px sans-serif;
      width: 100%;
      height: 1000px;
      overflow: scroll;
    }
    input.myInput {
      border: 1.5px solid #064D51;
      padding: 5px;
      font-family: Tahoma;
      width: 40%;
      padding: 10px;
    }
    ::-webkit-scrollbar {
      width: 12px;
      height: 12px;
    }
    ::-webkit-scrollbar-track {
      border: 1px #222222;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: #A8A8A8;  
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #787878;  
    }
    .form-row {
      display: flex;
      flex-wrap: wrap;
    }
    .form-column {
      flex: 50%;
      padding: 10px;
    }
    .readonly {
      background-color: #eee;
      color: #888;
      cursor: not-allowed;
    }
  </style>

</head>
<?php

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
?>

<header>
  <div class="logo">
    <img src="https://467210.fs1.hubspotusercontent-na1.net/hubfs/467210/Eric%20Sandbox/hfests_logo.png" width="400px">
</div>

<?php
  // Display the individual table links
  $query = "SHOW TABLES";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    echo "<nav>";
    while ($row = mysqli_fetch_assoc($result)) {
      foreach ($row as $table) {
        $class = '';
        if (isset($_GET['table']) && $_GET['table'] === $table) {
          $class = 'active';
        }
        echo "<a href='?table=" . $table . "' class='$class'>" . $table . "</a>";
      }
    }
    echo "</nav>";
  }
?>
</header>

<body>
  <div class="container">
  <?php
    // Retrieve the tables and display
    if ($_GET['table']) {
      $table = $_GET['table'];
      $query = "SELECT * FROM " . $table;
      $result = mysqli_query($conn, $query);
      echo "<h2>" . $table . "</h2>";
      ?>

<?php

$action = $_POST['action'];

// Generate the JavaScript code that will set the modal title and action
echo '<script>';
echo 'function setInsert() {';
echo 'var modal = $("#' . $table . 'Modal");';
echo 'modal.find(".modal-title").text(" Add New Record ");';
echo 'modal.find("form").attr("action", "' ."insert$table.php" . '");';
echo 'modal.find("form")[0].reset();';
echo '}';
echo 'function setUpdate() {';
echo 'var modal = $("#' . $table . 'Modal");';
echo 'modal.find(".modal-title").text(" Update Record ");';
echo 'modal.find("form").attr("action", "' ."update$table.php" . '");';
echo 'var dropdown = modal.find("#employee_ID");';
echo 'var dropdown1 = modal.find("#vax_date");';
echo 'var dropdown2 = modal.find("#date_of_infection");';
echo 'dropdown.prop("readonly", true);';
echo 'dropdown1.prop("readonly", true);';
echo 'dropdown2.prop("readonly", true);';
echo '}';
echo '</script>';
?>

      <!-- Button to trigger modal -->
      <?php 
      if ($table == 'Employment_History' ) {
      ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#HistoryModal">Update Employment History</button>
      <?php
      }
      else if($table != 'Emails' && $table != 'Locations'){ 
      ?>
        <form method="post">
          <input type="hidden" name="action" id="action" value='insert'>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-action='insert' data-target="#<?php echo $table ?>Modal"onclick="setInsert()">Add Record into <?php echo $table ?></button>
        </form>
      <?php 
      }
      if ($table == 'Schedule' ) {
        ?>
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#SendSchedule">Send Weekly Schedule</button>
        <?php
        }


      if (mysqli_num_rows($result) > 0) {
        echo "<br><br><input type='text' class='myInput' id='myInput' onkeyup='searchTable()' placeholder='Search " . $table . " ...'><br><br>";
        echo "<div class='myBox'>";
        echo "<table id='myTable'>";
        $columns = mysqli_fetch_fields($result);
        echo "<thead><tr>";
        foreach ($columns as $column) {
          echo "<th onclick='sortTable(" . '"' . $column->name . '"' . ")'>" . $column->name . "</th>";
        }
        if ($table == 'Employees' || $table == 'Facilities' || $table == 'Vaccines' || $table == 'Infections') {
          echo "<th>Action</th>";
        }
        echo "</tr></thead>";
        echo "<tbody>";
        
          
        // display table
          "<tr>";
          while ($row = mysqli_fetch_assoc($result)) {
          // initialize possible deletions
          $currEmployee = $row['employee_ID'];
          $currFacility = $row['facility_ID'];
          $currDate = $row['vax_date'];
          $currDose = $row['dose_number'];
          $infection_date = $row['date_of_infection'];

          foreach ($row as $cell) {
            echo "<td>" . $cell . "</td>";
          }
          if ($table == 'Employees' || $table == 'Facilities' || $table == 'Vaccines' || $table == 'Infections') {
            echo "<td><button type='button' class='btn btn-primary' onclick='updateRow(" . json_encode($row) . "); setUpdate()' data-toggle='modal' data-target='#" . $table . "Modal'>Update</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            echo "<a type='button' href='/delete.php?table=".$table."&id=".$currEmployee."&facility_id=".$currFacility."&dose=".$currDose."&date_of_infection=".$infection_date."' class='btn btn-secondary'>Delete</a>";
          }
          echo "</td></tr>";                        
        }
        echo "</tbody></table>";
        echo "</div>";
      }
    }
    ?>

            
             
           
      
      <div class="modal fade" id="HistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Update Employment History</h4>
            </div>
            <div class="modal-body">
              <form action="updateHistory.php" method="post">
              <div class="form-row">
                      <label for="action">Select an Action:</label>
                      <select name="action" id="action">
                        <option value="">--Select--</option>
                        <option value="ADD">Add New Employment Record</option>
                        <option value="TERMINATE">Terminate Active Employee</option>
                      </select>
                </div>
                <div class="form-row">
                  <div class="form-column">
                      <label for="facility_ID">Facility:</label>
                      <select name="facility_ID" id="facility_ID">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT facility_id, facility_name FROM Facilities";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["facility_id"] . "'>" . $row["facility_id"] . ' ' . $row["facility_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                  </div>  
                  <div class="form-column">
                      <label for="employee_ID">Employee:</label>
                      <select name="employee_ID" id="employee_ID">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT employee_id, first_name, last_name FROM Employees";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["employee_id"] . ' ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                </div>              
                <div class="form-row">
                    <div class="form-column">
                      <label for="date">Date:</label>
                      <input type="date" name="date" id="date" class="form-control" required>
                    </div>
                    <div class="form-column">
                            <label for="employee_role">Role:</label>
                            <select name="employee_role" id="employee_role">
                                <option value="">--Select--</option>
                                <option value="Nurse">Nurse</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Administration">Administration</option>
                                <option value="Security">Security</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Regular Employee">Regular Employee</option>
                                <option value="Receptionist">Receptionist</option>
                            </select>
                        </div>
                </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    
      <div class="modal fade" id="SendSchedule" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Send Weekly Schedule</h4>
            </div>
            <div class="modal-body">
              <form action="sendSchedule.php" method="post">
                <div class="form-row">
                      <label for="fid">Facility:</label>
                      <select name="fid" id="fid">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT facility_id, facility_name FROM Facilities";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["facility_id"] . "'>" . $row["facility_id"] . ' ' . $row["facility_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                </div>             
                <div class="form-row">
                    <div class="form-column">
                      <label for="start">Period Start Date:</label>
                      <input type="date" name="start" id="start" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="end">Period End Date:</label>
                      <input type="date" name="end" id="end" class="form-control" required>
                    </div> 
                </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="ScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Schedule an Employee</h4>
            </div>
            <div class="modal-body">
              <form action="insertSchedule.php" method="post">
                <div class="form-row">
                  <div class="form-column">
                      <label for="fid">Facility:</label>
                      <select name="fid" id="fid">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT facility_id, facility_name FROM Facilities";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["facility_id"] . "'>" . $row["facility_id"] . ' ' . $row["facility_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                  </div>  
                  <div class="form-column">
                      <label for="eid">Employee:</label>
                      <select name="eid" id="eid">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT employee_id, first_name, last_name FROM Employees";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["employee_id"] . ' ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                      <label for="shift_date">Shift Date:</label>
                      <input type="date" name="shift_date" id="shift_date" class="form-control" required>
                </div>               
                <div class="form-row">
                    <div class="form-column">
                      <label for="start">Start Time</label>
                      <input type="time" name="start" id="start" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="end">End Time:</label>
                      <input type="time" name="end" id="end" class="form-control" required>
                    </div> 
                </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="VaccinesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Log New Vaccination</h4>
            </div>
            <div class="modal-body">
              <form action="insertVax.php" method="post">
                <div class="form-row">
                    <div class="form-column">
                      <label for="employee_ID">Vaccine Recipient:</label>
                      <select name="employee_ID" id="employee_ID">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT employee_ID, first_name, last_name FROM Employees";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_ID"] . "'>" . $row["employee_ID"] . ' ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                    <div class="form-column">
                      <label for="facility_id">Vaccination Site:</label>
                      <select name="facility_id" id="facility_id">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT facility_ID, facility_name FROM Facilities";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["facility_ID"] . "'>" . $row["facility_ID"] . ' ' . $row["facility_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                      <label for="date">Date of Vaccination:</label>
                      <input type="date" name="vax_date" id="vax_date" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="type">Type:</label>
                        <select name="type" id="type">
                          <option value="">--Select--</option>
                          <option value="Moderna">Moderna</option>
                          <option value="Pfizer">Pfizer</option>
                          <option value="AstraZeneca">AstraZeneca</option>
                          <option value="Johnson & Johnson">Johnson & Johnson</option>
                        </select>
                    </div> 
                </div>            
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

        <!-- New Record Modals -->
        <div class="modal fade" id="ManagersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Assign a Manager</h4>
            </div>
            <div class="modal-body">
              <form action="insertManager.php" method="post">
                <div class="form-row">
                    <div class="form-column">
                      <label for="employee">Manager:</label>
                      <select name="employee" id="employee">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT employee_id, first_name, last_name FROM Employees";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["employee_id"] . ' ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                    <div class="form-column">
                      <label for="facility">Facility:</label>
                      <select name="facility" id="facility">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT facility_ID, facility_name FROM Facilities";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["facility_ID"] . "'>" . $row["facility_ID"] . ' ' . $row["facility_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                </div>          
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="InfectionsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Log New Infection</h4>
            </div>
            <div class="modal-body">
              <form action="insertInfection.php" method="post">
                <div class="form-row">
                    <div class="form-column">
                      <label for="employee_ID">Infected Employee:</label>
                      <select name="employee_ID" id="employee_ID">
                        <option value="">--Select--</option>
                          <?php 
                            $sql = "SELECT employee_id, first_name, last_name FROM Employees";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row["employee_id"] . "'>" . $row["employee_id"] . ' ' . $row["first_name"] . ' ' . $row["last_name"] . "</option>";
                              }
                            }
                          ?>
                        </select>
                    </div>
                    <div class="form-column">
                      <label for="date">Date of Infection:</label>
                      <input type="date" name="date_of_infection" id="date_of_infection" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                      <label for="severity">Severity:</label>
                      <select name="severity" id="severity">
                        <option value="">--Select--</option>
                        <option value="asymptomatic">Asymptomatic</option>
                        <option value="mild">Mild</option>
                        <option value="severe">Severe</option>
                        <option value="hospitalized">Hospitalized</option>
                      </select>
                    </div> 
                    <div class="form-column">
                      <label for="nature_of_infection">Nature of Infection:</label>
                      <select name="nature_of_infection" id="nature_of_infection">
                        <option value="">--Select--</option>
                        <option value="COVID-19">COVID-19</option>
                        <option value="SARS-Cov-2 Variant">SARS-Cov-2 Variant</option>
                      </select>
                    </div> 
                </div>                         
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="FacilitiesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo ($_POST['action'] == 'insert' ? 'insertFacility.php' : 'updateFacility.php'); ?>" method="post"> 
                    <input type="hidden" name="action" value="<?php echo $_POST['action']; ?>">
                    <div class="form-row">
                    <div>
                      <input type="hidden" name="facility_ID" id="facility_ID">
                    </div> 
                    <div class="form-column">
                      <label for="facility_name">Facility Name:</label>
                      <input type="text" name="facility_name" id="facility_name" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="type">Facility Type:</label>
                      <select name="type" id="type">
                        <option value="">--Select--</option>
                        <option value="Hospital">Hospital</option>
                        <option value="CLSC">CLSC</option>
                        <option value="Pharmacy">Pharmacy</option>
                        <option value="Clinic">Clinic</option>
                        <option value="Special Installment">Special Installment</option>
                      </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                      <label for="address">Street Address:</label>
                      <input type="text" name="address" id="address" class="form-control" required>
                    </div> 
                    <div class="form-column">
                      <label for="city">City:</label>
                      <input type="text" name="city" id="city" class="form-control" required>
                    </div> 
                </div>               
                <div class="form-row">
                    <div class="form-column">
                      <label for="postal_code">Postal Code:</label>
                      <input type="text" name="postal_code" id="postal_code" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="capacity">Capacity:</label>
                      <input type="number" name="capacity" id="capacity" class="form-control" required>
                    </div> 
                </div>  
                <div class="form-row">
                    <div class="form-column">
                      <label for="web_URL">Web URL:</label>
                      <input type="text" name="web_URL" id="web_URL" class="form-control" required>
                    </div>
                </div>	          
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="EmployeesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo ($_POST['action'] == 'insert' ? 'insertEmployee.php' : 'updateEmployee.php'); ?>" method="post"> 
                    <div class="form-row">  
                        <div>
                          <input type="hidden" name="employee_ID" id="employee_ID">
                        </div> 
                        <div class="form-column">
                            <label for="first_name">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        <div class="form-column">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-column">
                            <label for="facility_ID">Facility:</label>
                            <select name="facility_ID" id="facility_ID">
                                <option value="">--Select--</option>
                                <?php 
                                $sql = "SELECT facility_id, facility_name FROM Facilities";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row["facility_id"] . "'>" . $row["facility_id"] . ' ' . $row["facility_name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-column">
                            <label for="employee_role">Role:</label>
                            <select name="employee_role" id="employee_role">
                                <option value="">--Select--</option>
                                <option value="Nurse">Nurse</option>
                                <option value="Doctor">Doctor</option>
                                <option value="Administration">Administration</option>
                                <option value="Security">Security</option>
                                <option value="Cashier">Cashier</option>
                                <option value="Regular Employee">Regular Employee</option>
                                <option value="Receptionist">Receptionist</option>
                            </select>
                        </div>
                    </div>	          
                    <div class="form-row">
                        <div class="form-column">
                            <label for="email">Email:</label>
                      <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="telephone">Telephone:</label>
                      <input type="text" name="telephone" id="telephone" class="form-control" required>
                    </div>
                </div>	          
                <div class="form-row">
                    <div class="form-column">
                      <label for="medicare_number">Medicare Number:</label>
                      <input type="text" name="medicare_number" id="medicare_number" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="date_of_birth">Date of Birth:</label>
                      <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                      <label for="citizenship">Citizenship:</label>
                      <input type="text" name="citizenship" id="citizenship" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="address">Street Address:</label>
                      <input type="text" name="address" id="address" class="form-control" required>
                    </div> 
                  </div>               
                  <div class="form-row">
                    <div class="form-column">
                      <label for="city">City:</label>
                      <input type="text" name="city" id="city" class="form-control" required>
                    </div>
                    <div class="form-column">
                      <label for="postal_code">Postal Code:</label>
                      <input type="text" name="postal_code" id="postal_code" class="form-control" required>
                    </div> 
                  </div>  
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>

      // function that allows user to search each tables columns
      function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td");
          for (var j = 0; j < td.length; j++) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";
              break;
            } else {
              tr[i].style.display = "none";
            }
          }
        }
      }

      function updateRow(row) {
        var modal = document.getElementById('<?php echo $table ?>Modal');
        var inputs = modal.querySelectorAll('input, select, date, time');
        for (var i = 0; i < inputs.length; i++) {
          var name = inputs[i].name;
          if (name in row) {
            inputs[i].value = row[name];
          } else {
            inputs[i].value = '';
          }
        }
      }

      function clearDefault() {
        var modal = document.getElementById('<?php echo $table ?>Modal');
        var inputs = modal.querySelectorAll('input, select');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = '';
          }
      }

      </script>
  </div>
</body>
</html>