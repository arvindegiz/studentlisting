<?php


if(isset($_POST['edit_submit'])){
  $id = isset($_POST['id']) ? $_POST['id'] : '';
  $roll_number = isset($_POST['roll_no']) ? $_POST['roll_no'] : '';
  $std_name = isset($_POST['std_name']) ? $_POST['std_name'] : '';
  $std_class = isset($_POST['std_class']) ? $_POST['std_class'] : '';
  $created = date('Y-m-d H:i:s'); // Get the current timestamp
 
  $sql = "UPDATE students SET name='$std_name', class='$std_class', created_at='$created'  roll_no='$roll_number' , WHERE id = '$id";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header('location:listing1.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>