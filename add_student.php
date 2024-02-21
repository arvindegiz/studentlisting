<?php
include 'database.php';
$output = ['sucess' => false];
$roll_number = isset($_POST['roll_no']) ? $_POST['roll_no'] : '';
$std_name = isset($_POST['std_name']) ? $_POST['std_name'] : '';
$std_class = isset($_POST['std_class']) ? $_POST['std_class'] : '';
$created = time();

$sql = "INSERT INTO students (name, class, roll_no, created_at) VALUES ('$std_name',  '$std_class' , '$roll_number' , '$created')";
//   echo $sql; die();

  if ($conn->query($sql) === TRUE) {
    $output = ['sucess' => true];
  } else {
    $output = ['sucess' => false];
  }

echo json_encode($output);

// add edit ajax and jquery
?>