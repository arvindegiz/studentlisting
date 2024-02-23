<?php
// Include database connection
include 'database.php';

$param_exists = false;
$url_param = '?';
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
    $param_exists = true;
    $url_param = "?pageno=" . $_GET['pageno'] . "&";
} else {
    $pageno = 1;
}

$no_of_records_per_page = 5;
$offset = ($pageno - 1) * $no_of_records_per_page;

$total_pages_sql = "SELECT COUNT(*) FROM students WHERE deleted = 0";
$result = mysqli_query($conn, $total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$wherePlus = ' WHERE deleted = 0 ';
if(isset($_POST['search']) &&  !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $wherePlus .= " AND name LIKE '%$search%' ";
} 


$sortby = !empty($_POST['sortby']) ? $_POST['sortby'] : 'name';
$order = !empty($_POST['order']) ? $_POST['order'] : 'asc';


// $sql = "SELECT * FROM students WHERE deleted = 0 ORDER BY name $order";
$sql = "SELECT * FROM students " . $wherePlus . " ORDER BY " . $sortby . " " . $order . " LIMIT  $offset, $no_of_records_per_page";

$result = mysqli_query($conn, $sql);

$students = []; 
// print_r($result->num_rows);die();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
// print_r($students);die();

$pagination = '';

for ($i = 1; $i <= $total_pages; $i++) {  
    $pagination .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
}  

$students['pagination'] = $pagination;

$conn->close();

// Output students as JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
