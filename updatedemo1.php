<?php
include "database.php";
?>



<?php

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
            
              } else{
                echo "ERROR: Hush! Sorry $sql. "
                    . mysqli_error($conn);    
            }
        
      
      header("location:page1.php");
    ?>

