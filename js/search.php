<?php
// Include database connection or perform any necessary setup
include 'database.php';
// Check if search query parameter is set
if(isset($_POST['search'])) {
    // Sanitize the search query to prevent SQL injection
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    // Construct the SQL query to search for students by name
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%'";
    // Perform the query
    $result = mysqli_query($conn, $sql);
    print_r($result);
    // Check if any rows were returned
    if(mysqli_num_rows($result) > 0) {
        // Fetch and output the results as JSON
        $students = [];
        while($row = mysqli_fetch_assoc($result)) {
            $students[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($students);
    } else {
        // No matching records found
        echo json_encode(['message' => 'No matching records found']);
    }
} else {
    // No search query provided
    echo json_encode(['message' => 'No search query provided']);
}
?>
