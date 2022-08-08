<?php
// connecting to databse
$servername = "localhost";
$username = "root";
$password = "";
$database = "attendance";

//creating a connection
$conn = mysqli_connect($servername,$username,$password,$database);

//checking if connection is success or not
if(!$conn)
{
  die("Sorry we failed to connect: ".mysqli_connect_error());
}
// else{
//   echo "Connection is successfull<br>";
// }


?>