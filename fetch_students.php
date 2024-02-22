<?php
// Include database connection
include 'database.php';

// Fetch students from the database
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = []; // Initialize an empty array to store student data

// Check if there are any rows returned from the query
if ($result->num_rows > 0) {
    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        // Add each row (student data) to the $students array
        $students[] = $row;
    }
}

// Close the database connection
$conn->close();

// Output students as JSON
header('Content-Type: application/json');
echo json_encode($students);
?>
