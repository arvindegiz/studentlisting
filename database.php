<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "studentlisting";

// Create connection
$conn = new mysqli($servername, $username, $password ,$database );

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


// $name=$_POST['roll_number	'];
// $name=$_POST['name'];
// $name=$_POST['class'];

// $sql= mysqli_query($conn,"INSERT INTO students(name,pass) VALUES('".$roll_number."','".$name."','".$class."')");










?>