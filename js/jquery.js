
$(document).ready(function () {
    fetchStudents();


    // list of students



    // update data 

    $("#update_student_form").submit(function (event) {
        event.preventDefault(); // Prevent default form submission
        // console.log(123);
        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            url: "update_student.php",
            method: "POST",
            data: formData,
            success: function (response) {
                console.log(response);
                console.log(formData)
                // Optionally handle success response
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Delete data

    $(".delete-btn").click(function () {
        // Get the student ID from the data attribute
        var studentId = $(this).data('student-id');

        // Send AJAX request to deleted.php with the student ID
        $.ajax({
            url: 'deleted.php',
            method: 'GET',
            data: { deleteid: studentId },
            success: function (response) {
                // Handle success response
                console.log(response);
                // Optionally, you can perform actions like removing the deleted row from the DOM
                // Example: $(this).closest('tr').remove();
            },
            error: function (xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
});


$(document).on("click", "#add_student_btn", function () {
    $.ajax({
        url: "add_student.php",
        method: "POST",
        data: $("#add_student_form").serialize(),
        success: function (response) {

            $("#staticBackdrop").modal("hide");
            fetchStudents();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });

});

$(document).on("click", "#search_student", function () {
    var searchText = $("#nameInput").val();
    fetchStudents(searchText);
});

$(document).on("click", ".sort-link", function () {
    var sortby = $(this).data('sortby');
    var order = $(this).data('order');
    fetchStudents('', sortby, order);
    // alert(123);
});

// $(document).on("click", "#pagination-container a.page-link", function (event) {
//     event.preventDefault(); // Prevent default anchor click behavior

//     var page = $(this).data('page');
//     fetchStudents(page);
// });

// function fetchStudents(page) {
//     // Your code to fetch students based on the page parameter goes here
//     console.log("Fetching students for page: " + page);
// }



function fetchStudents(search = '', sortby = 'name', order = 'asc' ) {
    if (search == '') {
        search = $("#nameInput").val();
    }
    // alert(6666)
    $.ajax({
        url: 'fetch_students.php',
        method: 'POST',
        dataType: 'json',
        data: { search: search, sortby: sortby, order: order },
        success: function (response) {
            // Clear existing table data
            $('#dataTable tbody').empty();
            // $('#pagination-container').html(response);
            console.log("response",response); // Append rows for each student
           
            $.each(response, function (index, student) {
                var newRow = '<tr>' +
                    '<td>' + (index + 1) + '</td>' +
                    '<td>' + student.name + '</td>' +
                    '<td>' + student.class + '</td>' +
                    '<td>' + student.roll_no + '</td>' +
                    '<td>' +
                    '<button class="btn btn-primary">Edit</button>' +
                    '<button class="btn btn-danger">Delete</button>' +  
                    '</td>' +
                    '</tr>';
                $('#dataTable tbody').append(newRow);
            });
            $('#pagination_data').html(response.pagination);  
            // console.log("this data",response.pagination);
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}
