<?php
$servername = "localhost";
$username = "root";
$password = "";
$database ="Project_For_Dentist"; 	

$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error){
   die("Connection Failed:".connect_error);
}

/**this is the file used for connection with database and included in needed files*/
?>