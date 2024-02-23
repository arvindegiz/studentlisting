<?php
// Include database connection or perform any necessary setup
include 'database.php';

if(isset($_POST['search'])) {
  
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT * FROM students WHERE name LIKE '%$search%'";
    
    $result = mysqli_query($conn, $sql);
    print_r($result);
   
    if(mysqli_num_rows($result) > 0) {
        $students = [];
        while($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($students);
    } else { 
        echo json_encode(['message' => 'No matching records found']);
    }
} else {
    echo json_encode(['message' => 'No search query provided']);
}
?>
