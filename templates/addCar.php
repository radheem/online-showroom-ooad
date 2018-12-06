<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Add new car</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</head>
<body>
	<?php
		include_once("../database/constants.php");
		include_once("header.php");
	?>

	<br></br>
	<div class="container">
		<div class="card mx-auto"  style="width: 21rem">
			<br></br>
		  <img class="card-img-top mx-auto" style="width:100%;"  src="../images/addCar.png" alt="Add new car">
		  <small id="image_error" class="form-text text-muted"></small>
		  <div class="card-body">
		    <h5 class="card-title"></h5>
		    <form id="add_car" onsubmit="return false" autocomplte="off">
			  <div class="form-group">
			  	<label for="rp">Registration</label>
			    <input type="text" name="rp" class="form-control " id="rp" aria-describedby="rp" placeholder="Enter Registration plate">
			    <small id="rp_error" class="form-text text-muted"></small>
			    <label for="make">Make</label>
			    <input type="text" name="make" class="form-control " id="make" aria-describedby="make" placeholder="Enter Make">
			    <small id="make_error" class="form-text text-muted"></small>
			    <div class="form-group">
			  	<div class="form-group">
			    <label for="model">Model</label>
			    <input type="text" name="model" class="form-control " id="model" aria-describedby="model" placeholder="Enter Model">
			    <small id="model_error" class="form-text text-muted"></small>
			  <div class="form-group">
			  	<div class="form-group">
			    <label for="year">Year</label>
			    <input type="number" name="year" class="form-control " id="year" aria-describedby="year" placeholder="Enter Year">
			    <small id="year_error" class="form-text text-muted"></small>
			  <div class="form-group">
			    <label for="model">Color</label>
			    <input type="text" name="color" class="form-control " id="color" aria-describedby="color" placeholder="Enter color">
			    <small id="color_error" class="form-text text-muted"></small>
			  <div class="form-group">
			    <label for="bp">Buying price</label>
			    <input type="number" name="bp" class="form-control" id="bp" placeholder="Enter your buying price">
			    <small id="bp_error" class="form-text text-muted"></small>
			    <label for="buying_date">Buying date</label>
			    <input type="date" name="buying_date" class="form-control " id="buying_date" aria-describedby="buying_date" placeholder="Enter date of purchase" value="<?php echo date('Y-m-d'); ?>">
			    <small id="bd_error" class="form-text text-muted"></small>
			    <div class="form-group">
			    <div class="form-group">
			    <label for="expenses">Expenses</label>
			    <input type="number" name="expenses" class="form-control " id="expenses" aria-describedby="expenses" placeholder="Expenses made on the car">
			    <small id="expenses_error" class="form-text text-muted"></small>
			    <label for="transaction">Transaction Type</label>
			    <select name="transaction" class="form-control" id="transaction">
				    <option value="">Choose Transaction Type</option>
				    <option value="Cash">Cash</option>
				    <option value="Bank">Bank</option>
				    <option value="Credit">Credit</option>
			    </select>
			    <small id="transaction_error" class="form-text text-muted"></small>
			    
			    

			  </div>
			  </div>
			  </div>
			  </div>

			  <button type="submit" name="user_register" class="btn btn-primary"><i class="fa fa-car">&nbsp;&nbsp;</i>Add car</button>
			</form>
		   </div>
		   <div class="card-footer"><a href="../dashboard.php">Cancel</div>

		</div>
	</div>

	<!-- <script>
		
		$(document).ready(function(){
		 $("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");
		});
	</script> -->
</body>

</html>