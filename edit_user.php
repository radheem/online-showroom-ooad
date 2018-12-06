<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Edit User</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<?php
		include_once("./database/constants.php");  
		include_once("./templates/header.php");
	?>
	<br></br>
	<div class="container">
		<div class="card mx-auto"  style="width: 18rem">
		  <img class="card-img-top mx-auto" style="width:60%;"  src="./images/registration.png" alt="Registration">
		  <div class="card-body">
		    <h5 class="card-title"></h5>
		    <form id="edit_user" onsubmit="return false" autocomplte="off">
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" name="email" class="form-control " id="email" aria-describedby="email" placeholder="Enter email">
			    <small id="e_error" class="form-text text-muted"></small>
			  <div class="form-group">
			  	<div class="form-group">
			    <label for="username">Username</label>
			    <input type="text" name="username" class="form-control " id="username" aria-describedby="email" placeholder="Enter username">
			    <small id="u_error" class="form-text text-muted"></small>
			  <div class="form-group">
			    <label for="password1">Password</label>
			    <input type="password" name="password1" class="form-control" id="password1" placeholder="Password">
			    <small id="p1_error" class="form-text text-muted"></small>
			  <div class="form-group">
			    <label for="password2">Re-enter Password</label>
			    <input type="password" name="password2" class="form-control" id="password2" placeholder="Re-enter Password">
			    <small id="p2_error" class="form-text text-muted"></small>
			  <div class="form-group">
			    <label for="userType">User Type</label>
			    <select name="usertype" class="form-control" id="userType">
				    <option value="">Choose User Type</option>
				    <option value="Admin">Admin</option>
				    <option value="Salesman">Salesman</option>
			    </select>
			    <small id="t_error" class="form-text text-muted"></small>
			    <div class="form-group">
			    <label for="salary">Salary</label>
			    <input type="Number" name="salary" class="form-control" id="salary" placeholder="Annual Salary of Employee">
			    <small id="salary_error" class="form-text text-muted"></small>

			  </div>
			  </div>
			  </div>
			  </div>

			  <button type="submit" name="user_register" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Edit User</button>
			</form>
		   </div>
		   <div class="card-footer"><a href="index.php">Login instead?</div>
		</div>
	</div>
	<!-- <script>
		
		$(document).ready(function(){
		 $("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");
		});
	</script> -->
</body>
</html>