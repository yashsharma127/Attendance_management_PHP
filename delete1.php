<?php
include 'database.php';
?>

<?php


$id = $_GET['ids'];

$deletequery = "DELETE FROM `timesheet` WHERE ID=$id";

$query = mysqli_query($conn,$deletequery);

 header("location:page1.php");


?>