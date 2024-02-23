<?php
// Include database connection
include 'database.php';

$wherePlus = ' WHERE deleted = 0 ';
if(isset($_POST['search']) &&  !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $wherePlus .= " AND name LIKE '%$search%' ";
} 


$sortby = !empty($_POST['sortby']) ? $_POST['sortby'] : 'name';
$order = !empty($_POST['order']) ? $_POST['order'] : 'asc';



// $sql = "SELECT * FROM students WHERE deleted = 0 ORDER BY name $order";
$sql = "SELECT * FROM students "  . $wherePlus . " ORDER BY " . $sortby . " " . $order;

$result = mysqli_query($conn, $sql);

$students = []; 

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
    

$conn->close();

// Output students as JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
