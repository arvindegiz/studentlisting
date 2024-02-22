<?php
include("database.php");

// $sql = "SELECT * FROM students WHERE deleted = 0";

// // Execute the SQL query
// $result = $conn->query($sql);

// Check if the query was successful
// if ($result) {
//     // Fetch the data and store it in an array
//     $studentData = array();

//     while ($row = $result->fetch_assoc()) {
//         $studentData[] = $row;
//     }

//     // Convert the array to JSON format
//     $response = json_encode($studentData);

//     // Send the JSON response
//     echo $response;
// } else {
//     // If the query fails, return an error message
//     echo json_encode(array("error" => "Failed to retrieve student data from the database"));
// }


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $sql = "SELECT * from students where id = " . $_GET['id'] . " limit 1";
    $res = $conn->query($sql);
    $data = mysqli_fetch_assoc($res);
    print_r($data['id']);
}


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Your custom script -->
    <script src="js/script.js"></script>
</head>

<body>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="student.php">Student Listing</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="listing.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="student.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">List Student</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="container">



        <div class="row">
            <div class="col-md-3 my-4">
                <div class="input-group">
                    <input class="form-control" type="search" name="search" placeholder="Search name" id="nameInput">
                    <span class="input-group-append">
                        <button class="btn btn-outline-secondary bg-primary text-white form-control" id="search_student" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>

            </div>
            <div class="col-md-3 my-4">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle col-md-9" type="button" id="sortbyAtribute" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort Data
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="text-decoration-none btn" id="sort_by_name_asc" type="button" href="<?php echo $url_param . "sortby=name&order=asc"; ?>">Sort by Name A-Z</a></li>
                        <li><a class="text-decoration-none btn" id="sort_by_name_dsc" type="button" href="<?php echo $url_param . "sortby=name&order=desc"; ?>">Sort by Name Z-A</a></li>
                        <li><a class="text-decoration-none btn" id="sort_by_roll_no" type="button" href="<?php echo $url_param . "sortby=roll_no&order=asc"; ?>">Sort by Roll No</a></li>
                        <li><a class="text-decoration-none btn" id="sort_by_Class" type="button" href="<?php echo $url_param . "sortby=class&order=asc"; ?>">Sort by Class</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 my-4">
                <button type="button" class="btn btn-primary my-2 float-end col-md-9" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
            </div>
        </div>



        <!-- Button trigger modal -->
        <!-- <div class="container">
            <button type="button" class="btn btn-primary my-2 float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add</button>
        </div> -->


        <div class="container text-end my-2" id="studentList">
            <table id="dataTable" class="table table-striped align-middle table-bordered border-secondary text-center table-responsive">
                <thead class="bg-primary text-white">
                    <tr>
                        <th scope="col">S.N.</th>
                        <th id="student_name" scope="col">Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Roll No</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>


        </div>


        <!-- add  Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Student</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add_student_form" method="post" action="">
                            <div class="mb-3 row">
                                <label for="inputRoll" class="col-sm-2 col-form-label">Roll No</label>
                                <div class="col-sm-10">
                                    <input type="number" name="roll_no" class="form-control" id="inputRoll">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="std_name" class="form-control" id="inputName">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputClass" class="col-sm-2 col-form-label">Class</label>
                                <div class="col-sm-10">
                                    <input type="number" name="std_class" class="form-control" id="inputClass">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="add_student_btn">Add Student</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Student Modal -->
        <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Student</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_student_form" method="post" action="">
                            <?php
                            if (isset($_GET['id'])) { ?>
                                <input name="id" type="hidden" class="form-control" id="" value="<?= $_GET['id'] ?>" required>
                            <?php } ?>
                            <div class="mb-3 row">
                                <label for="inputRoll" class="col-sm-2 col-form-label">Roll No</label>
                                <div class="col-sm-10">
                                    <input type="number" name="roll_no" class="form-control" value="<?php if (isset($_GET['id'])) {
                                                                                                        echo $data['roll_no'];
                                                                                                    } ?>" id="inputRoll" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="std_name" class="form-control" value="<?php if (isset($_GET['id'])) {
                                                                                                        echo $data['name'];
                                                                                                    } ?>" id="inputName" required>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputClass" class="col-sm-2 col-form-label">Class</label>
                                <div class="col-sm-10">
                                    <input type="number" name="std_class" class="form-control" value="<?php if (isset($_GET['id'])) {
                                                                                                            echo $data['class'];
                                                                                                        } ?>" id="inputClass" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="update_student_btn">Update Student</button>
                    </div>
                </div>
            </div>
        </div>



    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>   -->
<script>
    // $(document).ready (function () {  
    //   $("#add_student_form").validate ();  
    // }); 
</script>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script>
    $(document).ready(function() {
        $("#add_student_btn").click(function() {
            $.ajax({
                url: "add_student.php",
                method: "POST",
                data: $("#add_student_form").serialize(),
                success: function(response) {
                    console.log(response);
                    // $("#staticBackdrop").modal("hide");
                    // // location.reload();
                    // $("#dataTable").html(response);
                    // // var student = JSON.parse(response);

                    // // Append a new row to the table
                    // // var newRow = "<tr>" +
                    // //     "<td>" + students.sn + "</td>" +
                    // //     "<td>" + students.name + "</td>" +
                    // //     "<td>" + students.class + "</td>" +
                    // //     "<td>" + students.roll_no + "</td>" +
                    // //     "<td>" +
                    // //     "<button class='btn btn-primary'>Edit</button>" +
                    // //     "<button class='btn btn-danger'>Delete</button>" +
                    // //     "</td>" +
                    // //     "</tr>";

                    // // $("#dataTable tbody").append(newRow);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });






</script> -->