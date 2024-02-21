<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>My Project</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">Student</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="student.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="student.php">Add Student</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="listing.php">List Student</a>
        </li>
       </ul>
    </div>
  </div>
</nav>
	<div class="container">
		<div class="m-5">
			<h1 class="text-center">Add Student</h1>
		</div>
		<form id="add_student_form" class="col-6 mx-auto" method="post" action="add_edit_student.php">
		  <div class="row mb-3">
		    <label for="" class="col-sm-2 col-form-label">Name</label>
		    <div class="col-sm-10">
		      <input name="name" type="text" class="form-control" id="" required>
		    </div>
		  </div>


		   <div class="row mb-3">
		    <label for="" class="col-sm-2 col-form-label">Class</label>
		    <div class="col-sm-10">
		      <input name="class" type="text" class="form-control" id="" required>
		    </div>
		  </div>


		   <div class="row mb-3">
		    <label for="" class="col-sm-2 col-form-label">Roll no</label>
		    <div class="col-sm-10">
		      <input name="roll_no" type="text" class="form-control" id="" required>
		    </div>
		  </div>

		  
		 <div class="text-center">
		 	<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		 </div>
		 
		</form>
				
				
			</div>
			
			

</body>
	
	
	

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
<style type="text/css">
/*	input {  
  border-radius: 5px;  
  border: 1px solid #ccc;  
  padding: 4px;  
  font-family: 'Lato';  
  width: 300px;  
  margin-top: 10px;  
} */ 
/*label {  
  width: 300px;  
  font-weight: bold;  
  display: inline-block;  
  margin-top: 20px;  
}*/  
/*label span {  
  font-size: 1rem;  
}*/  
label.error {  
    color: red;  
    font-size: 1rem;  
    display: block;  
    margin-top: 5px;  
}  
input.error {  
    border: 1px solid red;  
    font-weight: 200;  
    color: red;  
}   
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"> </script>  
<script> 

$(document).ready (function () {  
  $("#add_student_form").validate ();  
}); 



</script>