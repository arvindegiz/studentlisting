
$(document).ready(function() {
    fetchStudents();
    
    
    // list of students
    
    
    
    // update data 
    
    $("#update_student_form").submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        // console.log(123);
        // Serialize form data
        var formData = $(this).serialize();
    
        // Send AJAX request
        $.ajax({
            url: "update_student.php",
            method: "POST",
            data: formData,
            success: function(response) {
                console.log(response);
                console.log(formData)
                // Optionally handle success response
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    
    // Delete data
    
    $(".delete-btn").click(function() {
        // Get the student ID from the data attribute
        var studentId = $(this).data('student-id');
        
        // Send AJAX request to deleted.php with the student ID
        $.ajax({
            url: 'deleted.php',
            method: 'GET',
            data: { deleteid: studentId },
            success: function(response) {
                // Handle success response
                console.log(response);
                // Optionally, you can perform actions like removing the deleted row from the DOM
                // Example: $(this).closest('tr').remove();
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText);
            }
        });
    });
});


$(document).on("click", "#add_student_btn", function() {
    $.ajax({
        url: "add_student.php",
        method: "POST",
        data: $("#add_student_form").serialize(),
        success: function(response) {
            
            $("#staticBackdrop").modal("hide");
            fetchStudents();
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
   
});


function fetchStudents() {
    // alert(6666)
    $.ajax({
        url: 'fetch_students.php',
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Clear existing table data
            $('#dataTable tbody').empty();
            console.log(response);
            // Append rows for each student
            $.each(response, function(index, student) {
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
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


// $(document).ready(function() {
//     $('#search_student').click(function() {
//         var searchValue = $('#nameInput').val();
//         // Perform Ajax request
//         $.ajax({
//             url: 'search.php', // Your PHP file to handle the search request
//             method: 'POST',
//             data: { search: searchValue }, // Pass the search value as a POST parameter
//             dataType: 'json',
//             success: function(response) {
//                 // Clear existing table data
//                 $('#dataTable tbody').empty();
                
//                 if (response && response.length > 0) {
//                     // Append rows for each student
//                     $.each(response, function(index, student) {
//                         var newRow = '<tr>' +
//                             '<td>' + (index + 1) + '</td>' +
//                             '<td>' + student.name + '</td>' +
//                             '<td>' + student.class + '</td>' +
//                             '<td>' + student.roll_no + '</td>' +
//                             '<td>' +
//                             '<button class="btn btn-primary">Edit</button>' +
//                             '<button class="btn btn-danger">Delete</button>' +
//                             '</td>' +
//                             '</tr>';
//                         $('#dataTable tbody').append(newRow);
//                     });
//                 } else {
//                     // No matching records found
//                     $('#dataTable tbody').append('<tr><td colspan="5">No matching records found</td></tr>');
//                 }
//             },
//             error: function(xhr, status, error) {
//                 // Handle errors
//                 console.error(error);
//             }
//         });
//     });
// });
