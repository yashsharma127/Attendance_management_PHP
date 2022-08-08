<?php
session_start();
if(!isset($_SESSION['username']))
{
  header('location: index.php');
}
?>
<?php 
ob_start();
ob_clean();
?>

<html>
<head>
        <title>Attendance management system</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="style3.css" />
  <style>.error{color:#FF0000;}</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>    
  <link rel="stylesheet" href="style3.css"/>
   <?php
  include "database.php";
  ?>
</head>

<body>
    <header>
         <nav class ="navbar">
    <div class="navbar_logo">
            <img src="logo1.png" alt="logo" class="company_logo" />
          </div>
          
          <center>
          <div class="company_name"> 
          <h1>Attendance management System</h1>
          <!-- <p>linear-gradient() + background-clip + text-fill-color</p> -->
          
          
            </div></center>
            <div class="nav_item">
            <div class="logged-user">
            <button  class="loggeduser"><?php echo ucwords($_SESSION['Name']);?></button>
              
            
          </div>
          <a href="logout.php" name = "log_out" value="logout" class="logout_button">Log out</a>
          
            </div>

        </nav> 
    </header>
    <main>
  
         <div class = "table"> 
        
  <ul class="nav nav-tabs " style = "justify-content: center" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true" 
    style = "background: transparent;
  color: whitesmoke;
  border: 1px solid white;
  padding: 1rem 2rem;
  border-radius: 10px;
  margin-right: 10px;">Employee</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" 
    style = "background: transparent;
  color: whitesmoke;
  border: 1px solid white;
  padding: 1rem 2rem;
  border-radius: 10px;
  margin-right: 10px;">Attendance</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false" 
    style = "background: transparent;
  color: whitesmoke;
  border: 1px solid white;
  padding: 1rem 2rem;
  border-radius: 10px;
  margin-right: 10px;">User</button>
  </li>
</ul>
<div class="tab-content" style = "margin-top: 10px"id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" style = "color: white ">
  

<!-- Add Employee Backend Server -->
<div>
  <?php
          $error=0;
          // Taking all 7 values from the form data(input)
           if(isset($_POST['addemployee']) && $_POST['addemployee'] === 'add')
           {
                  if(isset($_POST['Firstname'])){
                  $Firstname =  $_REQUEST['Firstname'];}

                  if(isset($_POST['Lastname'])){
                  $Lastname =  $_REQUEST['Lastname'];}

                  if(isset($_POST['Date_of_Birth'])){
                  $Date_of_Birth = $_REQUEST['Date_of_Birth'];}

                  if(isset($_POST['Email'])){
                  $Email = $_REQUEST['Email'];}

                  if(isset($_POST['Phone'])){ 
                      if($_POST['Phone']>=7777777777  &&  $_POST['Phone']<= 9999999999)
                          {
                              $Phone =  $_REQUEST['Phone'];
                          }
                      else
                          {
                          $error = 1;
                          } 
                    }

                  if(isset($_POST['Address'])){
                  $Address = $_REQUEST['Address'];}

                  if(isset($_POST['Date_of_Joining'])){
                  $Date_of_Joining = $_REQUEST['Date_of_Joining'];}

                  if($error==0){
                  $sql = "INSERT INTO employee(Firstname,Lastname,Date_of_Birth,Email,Phone,Address,Date_of_Joining)   
                  VALUES ('$Firstname','$Lastname','$Date_of_Birth','$Email','$Phone','$Address','$Date_of_Joining')";
              
                if(mysqli_query($conn, $sql)){
                    ?>
                    <script>alert('Employee Added successfully');</script>
                    <?php header('Refresh:1');
                 } 
                    } 
                else{
                    echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);    
                  }
          }
      
    ?>
</div>


<!-- Update Employee Backend Server -->
<div>
    <?php
        $error=0;
        if(isset($_POST['submitupdate']) && $_POST['submitupdate'] === 'updateemployee')
        {
            if(isset($_POST['employee_id'])){
            $employee_id =  $_REQUEST['employee_id'];}
            if(isset($_POST['Firstname'])){
            $Firstname =  $_REQUEST['Firstname'];}

            if(isset($_POST['Lastname'])){
            $Lastname =  $_REQUEST['Lastname'];}

            if(isset($_POST['Date_of_Birth'])){
            $Date_of_Birth = $_REQUEST['Date_of_Birth'];}

            if(isset($_POST['Email'])){
            $Email = $_REQUEST['Email'];}

            if(isset($_POST['Phone'])){
              if($_POST['Phone']>=7777777777  &&  $_POST['Phone']<= 9999999999)
              {
                  $Phone =  $_REQUEST['Phone'];
              }
              else
              {
              $error = 1;
              } 
              }

            if(isset($_POST['Address'])){
            $Address = $_REQUEST['Address'];}

            if(isset($_POST['Date_of_Joining'])){
            $Date_of_Joining = $_REQUEST['Date_of_Joining'];}
            
            if($error==0)
            {
                $query = "UPDATE `employee` SET `Date_of_Birth`='$Date_of_Birth',`Email`='$Email',`Phone`='$Phone',
                `Address`='$Address',`Date_of_Joining`='$Date_of_Joining',`Firstname`='$Firstname',`Lastname`='$Lastname'
                WHERE EmployeeID = '$employee_id'";
                $showdata = mysqli_query($conn,$query);

                if($showdata){
                  ?>
                    <script>alert('Details Updated successfully');</script>
                <?php 
                    header('Refresh:1');
                
                  } else{
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);    
                }
            }
        }
    ?>

</div>


<!-- Add Employee -->
<div class = "main-div">
    <h2>Employee details</h2>
    
    <div class = "center_div">
      

    <div class="add_button" style = "margin-left: 83px">
      
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Add Employee
      </button>
    </div>

    <!-- add employee Modal -->
    <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title" style = "color: black">Fill the details</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <p><span class ="error">*required field</span></p>
            <form method="post" id="form1" action="" enctype ="multipart/form-data">
          
          

            <table>
            <tbody>

            <tr><td><label for="FirstName" style = "color:black" >Firstname:</label></td>
            <td><input type="text" name ="Firstname" value="<?php echo @$_POST['Firstname'];?>" required >
            <span class = "error">* </span>
            </td></tr>

            <tr><td><label for="LastName">Lastname:</label></td>
            <td><input type="text" name ="Lastname" value="<?php echo @$_POST['Lastname'];?>"  required>
            <span class = "error">*  </span>
            </td></tr> 

            <tr><td><label for="Date_of_Birth">Date of Birth:</label></td>
            <td><input type="date" name = "Date_of_Birth" value="<?php echo @$_POST['Date_of_Birth'] ?>"  required>
            <span class = "error">* </span>
            </td></tr>


            <tr><td><label for="Email">Email:</label></td>
            <td><input type="email" name = "Email" value = "<?php echo @$_POST['Email'];?>"  required>
            <span class = "error">* </span>
            </td></tr>


            <tr><td><label for="Phone">Phone:</label></td>
            <td><input type="number" name= "Phone" value = "<?php echo @$_POST['Phone'];?>"  required>
            <span class = "error">* </span>
            </td></tr>
                        
            <tr><td><label for="Address">Address:</label></td>
            <td><input type="text" name ="Address" value="<?php echo @$_POST['Address'];?>"  required>
            <span class = "error">* </span>
            </td></tr> 

            <tr><td><label for="Date_of_Joining">Date of Joining:</label></td>
            <td><input type="date" name = "Date_of_Joining" value="<?php echo @$_POST['Date_of_Joining'] ?>"  required>
            <span class = "error">* </span>
            </td></tr>

            </tbody>    
            </table>



            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="submit" name= "addemployee" id = "button1" value = "add" class="btn btn-danger">Submit</button>
          
            </div>
            </form>
            
            </div>
            </div>
    </div>


        <div class="table_responsive">
            <table>
                <thead>
                  <tr>
                      <th>EmployeeID</th>
                      <th>Employee Name</th>
                      <th>Date of Birth</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Date of Joining</th>
                      <th colspan = "2">Operations</th>
                </tr>

                </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT EmployeeID,Date_of_Birth,Email,Phone,Address,Date_of_Joining,Lastname,Firstname,
                    CONCAT(FIRSTNAME, ' ', LASTNAME) AS 'Employee Name' FROM `employee`";
                    
                    $query = mysqli_query($conn,$sql);
                  
                    echo "<br>";
                    
                    while($res = mysqli_fetch_array($query)){
                  
                    ?>
                    <tr>
                    <td><?php echo $res['EmployeeID']; ?></td>
                    <td><?php echo $res["Employee Name"]; ?></td>
                    <td><?php echo $res['Date_of_Birth']; ?></td>
                    <td><?php echo $res['Email']; ?></td>
                    <td><?php echo $res['Phone']; ?></td>
                    <td><?php echo $res['Address']; ?></td>
                    <td><?php echo $res['Date_of_Joining']; ?></td>
                    
                    <td> <a  href = "id=<?php echo $res['EmployeeID']; ?>"
                    id ="edit<?php echo $res['EmployeeID']; ?>"  onclick="editvalue('edit<?php echo $res['EmployeeID'];?>')" 
                    data-EmployeeID="<?php echo $res['EmployeeID']; ?>"
                    data-Firstname="<?php echo $res['Firstname']; ?>"
                    data-Lastname="<?php echo $res['Lastname']; ?>"
                    data-DOB="<?php echo $res['Date_of_Birth']; ?>"
                    data-Email="<?php echo $res['Email']; ?>"
                    data-Phone="<?php echo $res['Phone']; ?>"
                    data-Address="<?php echo $res['Address']; ?>"
                    data-DOJ="<?php echo $res['Date_of_Joining']; ?>"
                    
                    data-bs-toggle="modal" data-bs-target="#updateModal" title="Update">
                      <i class="fa fa-edit" aria-hidden="true"></i> </a> </td>
              <td> <a   href="delete.php?id=<?php echo $res['EmployeeID']; ?>" 
                      data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                      <i class="fa fa-trash" aria-hidden="true"></i> </a></td>
                  </tr>
                    <?php
                    }
                    ?>
                    
                  </tbody>
            </table>
      </div>
      </div>
</div> 


<!-- Update Employee -->
<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" style = "color: black">Update the details</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <p><span class ="error">*required field</span></p>
        <form method="post" id="update1" action="" enctype ="multipart/form-data">
        


  <table>
      <tbody>
        <input type="hidden" name="employee_id" id="edit_employeeid">

  <tr><td><label for="FirstName" style = "color:black" >Firstname:</label></td>
  <td><input type="text" name ="Firstname" id = "edit_firstname"  required >
  <span class = "error">* </span>
  </td></tr>

  <tr><td><label for="LastName">Lastname:</label></td>
  <td><input type="text" name ="Lastname" id = "edit_lastname" required>
  <span class = "error">*  </span>
  </td></tr> 

  <tr><td><label for="Date_of_Birth">Date of Birth:</label></td>
  <td><input type="date" name = "Date_of_Birth" id = "edit_dob" required>
  <span class = "error">* </span>
  </td></tr>


  <tr><td><label for="Email">Email:</label></td>
  <td><input type="email" name = "Email" id = "edit_email" required>
  <span class = "error">* </span>
  </td></tr>


  <tr><td><label for="Phone">Phone:</label></td>
  <td><input type="number" name= "Phone" id = "edit_phone" required>
  <span class = "error">* </span>
  </td></tr>
              
  <tr><td><label for="Address">Address:</label></td>
  <td><input type="text" name ="Address" id = "edit_address"  required>
  <span class = "error">* </span>
  </td></tr> 

  <tr><td><label for="Date_of_Joining">Date of Joining:</label></td>
  <td><input type="date" name = "Date_of_Joining" id = "edit_doj" required>
  <span class = "error">* </span>
  </td></tr>

  </tbody>    
  </table>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" name= "submitupdate" id = "updatebutton" value="updateemployee" class="btn btn-danger">Update</button>
        
        <!-- <script>    
            $("#button1").click(function() {
            alert("The Form has been Submitted.");
              }); 
          </script> -->

      </div>
        </form>
        
      </div>
    </div>
</div>


    <!-- Javascript -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  <script>
    
 function editvalue(id){
  var emp = id;
    var EmployeeID = document.getElementById(emp).getAttribute('data-employeeid');
    var Firstname = document.getElementById(emp).getAttribute('data-Firstname');
    var Lastname =document.getElementById(emp).getAttribute('data-Lastname');
    var DOB =document.getElementById(emp).getAttribute('data-DOB');
    var Email =document.getElementById(emp).getAttribute('data-Email');
    var Phone =document.getElementById(emp).getAttribute('data-Phone');
    var Address =document.getElementById(emp).getAttribute('data-Address');
    var DOJ =document.getElementById(emp).getAttribute('data-DOJ');

    document.getElementById('edit_employeeid').value=EmployeeID;
    document.getElementById('edit_firstname').value=Firstname;
    document.getElementById('edit_lastname').value=Lastname;
    document.getElementById('edit_dob').value=DOB;
    document.getElementById('edit_email').value=Email;
    document.getElementById('edit_phone').value=Phone;
    document.getElementById('edit_address').value=Address;
    document.getElementById('edit_doj').value=DOJ;

  }
  
    </script>
    <script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })
</script>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab" style = "color: white">
  

<!-- Add attendance backend server -->
<div>
  <?php
          // Taking all 5 values from the form data(input)
          if(isset($_POST['submit2']) && $_POST['submit2'] === 'att')
            {
            if(isset($_POST['UserID'])){
            $UserID =  $_REQUEST['UserID'];}

            if(isset($_POST['EmployeeID'])){
            $EmployeeID =  $_REQUEST['EmployeeID'];}

            if(isset($_POST['Time_in'])){
            $Time_in = $_REQUEST['Time_in'];}

            if(isset($_POST['Time_out'])){
            $Time_out = $_REQUEST['Time_out'];}


            $sql = "INSERT INTO timesheet (UserID,EmployeeID,Time_out,Time_in)   
            VALUES ('$UserID','$EmployeeID','$Time_out','$Time_in')";
          

            if(mysqli_query($conn, $sql)){
              ?>
              <script>alert('Employee Added successfully');</script>
              <?php header('Refresh:1');
              } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);    
            }
            
          }
    ?>
</div>


<!-- Update attendace backend server -->
<div>
    <?php
      if(isset($_POST['submitattendance']) && $_POST['submitattendance'] === 'update_att')
      {
        if(isset($_POST['ID'])){
            $ID =  $_REQUEST['ID'];}

        if(isset($_POST['UserID'])){
            $UserID =  $_REQUEST['UserID'];}

        if(isset($_POST['EmployeeID'])){
        $EmployeeID =  $_REQUEST['EmployeeID'];}

        if(isset($_POST['Time_in'])){
        $Time_in = $_REQUEST['Time_in'];}

        if(isset($_POST['Time_out'])){
        $Time_out = $_REQUEST['Time_out'];}
          
        $query = "UPDATE `timesheet` SET `ID`='$ID',`UserID`='$UserID',
        `EmployeeID`='$EmployeeID',`Time_in`='$Time_in',`Time_out`='$Time_out' 
          WHERE ID = '$ID'";
                $showdata = mysqli_query($conn,$query);

                if($showdata){
                  ?>
                  <script>alert('Employee Added successfully');</script>
                  <?php header('Refresh:1');

                  } else{
                    echo "ERROR: Hush! Sorry $sql. "
                        . mysqli_error($conn);    
                }
              }
        ?>
</div>


<!-- Add attendance and table -->
<div class = "main-div">
    <h2>Attendance details</h2>

              <div class = "center_div">
            <div class="add" style = "margin-left: 85px">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add attendance
          </button>
          </div>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style = "color: black">Attendance Form</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    
                  
                </div>
                <div class="modal-body">
                <p><span class ="error">*required field</span></p>
                  <form method = "POST" action="">
                

                  <table>
              <tbody>

          <tr><td><label for="UserID" style = "color:black" >UserID:</label></td>
          <td><input type="text" name ="UserID" value="<?php echo @$_POST['UserID'];?>" required >
          <span class = "error">* </span>
          </td></tr>

          <tr><td><label for="LastName">EmployeeID:</label></td>
          <td><input type="text" name ="EmployeeID" value="<?php echo @$_POST['EmployeeID'];?>"  required>
          <span class = "error">*  </span>
          </td></tr> 

          <tr><td><label for="Time_in">Time in:</label></td>
          <td><input type="time" name = "Time_in" value="<?php echo @$_POST['Time_in'] ?>"  required>
          <span class = "error">* </span>
          </td></tr>


          <tr><td><label for="Time_out">Time out:</label></td>
          <td><input type="time" name = "Time_out" value="<?php echo @$_POST['Time_out'];?>"  required>
          <span class = "error">* </span>
          </td></tr>

          </tbody>
          </table>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                <button type="submit" name= "submit2" id = "button2" class="btn btn-danger" value = "att" data-bs-dismiss="modal">Submit</button>
                
              </div>
              </form>
              </div>
            </div>
          </div>



              <div class="table-responsive">
                  <table>
                      <thead>
                        <tr>
                            <th>ID</th>
                            <th>UserID</th>
                            <th>EmployeeID</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th colspan = "2">Operations</th>
                      </tr>

                      </thead>
                        <tbody>
                          <?php
                          $sql = "SELECT ID,UserID,EmployeeID,Time_in,Time_out FROM `timesheet`";
                          
                          $query = mysqli_query($conn,$sql);
                        
                          echo "<br>";
                          
                          while($res = mysqli_fetch_array($query)){
                          // echo $res['EmployeeID'].$res["Firstname"].$res["Lastname"] . "<br>";
                          ?>
                          <tr>
                          <td><?php echo $res['ID']; ?></td>
                          <td><?php echo $res['UserID']; ?></td>
                          <td><?php echo $res['EmployeeID']; ?></td>
                          <td><?php echo $res['Time_in']; ?></td>
                          <td><?php echo $res['Time_out']; ?></td>

                          <td> <a href="ids=<?php echo $res['ID'];  ?>" 
                          id ="change<?php echo $res['ID'];  ?>"  
                          onclick="editattend('change<?php echo $res['ID'];?>')"
                            data-id="<?php echo $res['ID']; ?>"
                            data-userid="<?php echo $res['UserID']; ?>"
                            data-employeeid="<?php echo $res['EmployeeID']; ?>"
                            data-time_in="<?php echo $res['Time_in']; ?>"
                            data-time_out="<?php echo $res['Time_out']; ?>"
                    
                          data-bs-toggle="modal" data-bs-target="#attendanceupdate" data-bs-placement="bottom" title="Update" >
                            <i class="fa fa-edit" aria-hidden="true"></i> </a> </td>
                          <td> <a href="delete1.php?ids=<?php echo $res['ID']; ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                            <i class="fa fa-trash" aria-hidden="true"></i> </a></td>
                        </tr>
                          <?php
                          }
                          ?>
                          
                        </tbody>
                  </table>
            </div>
            </div>
</div> 


<!-- Update Attendance -->
<div class="modal fade" id="attendanceupdate">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title" style = "color: black">Update Attendance</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
          <p><span class ="error">*required field</span></p>
          <form method="post" id="update1-2" action="updatedemo1.php" enctype ="multipart/form-data">
        
          <table>
      <tbody>
            <input type="hidden" name="ID" id="edit_id">

    <tr><td><label for="UserID" style = "color:black" >UserID:</label></td>
    <td><input type="text" name ="UserID" id = "edit_userid"  required >
    <span class = "error">* </span>
    </td></tr>

    <tr><td><label for="LastName">EmployeeID:</label></td>
    <td><input type="text" name ="EmployeeID" id = "edit__employeeid"   required>
    <span class = "error">*  </span>
    </td></tr> 

    <tr><td><label for="Time_in">Time in:</label></td>
    <td><input type="time" name = "Time_in" id = "edit_time_in"  required>
    <span class = "error">* </span>
    </td></tr>


    <tr><td><label for="Time_out">Time out:</label></td>
    <td><input type="time" name = "Time_out" id = "edit_time_out"  required>
    <span class = "error">* </span>
    </td></tr>

    </tbody>
    </table>


        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" name= "submitattendance" id = "submit_attendance" value="update_att" class="btn btn-danger" >Submit</button>

      </div>
      </form>
      </div>
    </div>
</div> 


  <!-- javascript code -->
<div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script>
    
  function editattend(id){
    var emp = id;
      var id = document.getElementById(emp).getAttribute('data-id');
      var userid = document.getElementById(emp).getAttribute('data-userid');
      var employeeid =document.getElementById(emp).getAttribute('data-employeeid');
      var time_in =document.getElementById(emp).getAttribute('data-time_in');
      var time_out =document.getElementById(emp).getAttribute('data-time_out');
      

      document.getElementById('edit_id').value=id;
      document.getElementById('edit_userid').value=userid;
      document.getElementById('edit__employeeid').value=employeeid;
      document.getElementById('edit_time_in').value=time_in;
      document.getElementById('edit_time_out').value=time_out;
  

    }
    
      </script>
    

    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
 </script>
</div>  


</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab" style = "color: white">
<!-- logged in user details -->
<div class = "main-div">
    <h2>User Details</h2>
    
    <div class = "center_div">
  

    <div class="table-responsive">
        <table>
            <thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Date of Birth</th>
                  <th>Email</th>
             </tr>

            </thead>
              <tbody>
                <?php
                $sql = "SELECT ID,UserName,Password,Name,date_of_birth,email FROM `user_login`";
                
                $query = mysqli_query($conn,$sql);
               
                echo "<br>";
                
                 while($res = mysqli_fetch_array($query)){
                // echo $res['EmployeeID'].$res["Firstname"].$res["Lastname"] . "<br>";
                ?>  
                <tr>
                <td><?php echo $res['ID']; ?></td>
                <td><?php echo $res['Name']; ?></td>
                <td><?php echo $res['date_of_birth']; ?></td>
                <td><?php echo $res['email']; ?></td>
               </tr>
                <?php
                 }
                ?>
                
              </tbody>
        </table>
   </div>
   </div>
</div> 

</div>
</div> 
 </div>         
    </main>
    <!-- <hr style = "margin-top: 70px"> -->




</body>
</html>

