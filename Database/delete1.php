<?php
include '../Database/database.php';
?>

<?php


$id = $_GET['ids'];

$deletequery = "DELETE FROM `timesheet` WHERE ID=$id";

$query = mysqli_query($conn,$deletequery);

 header("location: ../pages/page1.php");


?>