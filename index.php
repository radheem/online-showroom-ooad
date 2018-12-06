<?php
	include_once("./database/constants.php");
	if(isset($_SESSION["user_id"])){
		header("location:".DOMAIN."/dashboard.php");
	}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href="#">Mozil Motors</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href=<?php echo DOMAIN;?>/dashboard.php><i class="fa fa-home">&nbsp</i>Home <span class="sr-only">(current)</span></a>
	      </li>
	      
	      	<?php
	      	if(isset($_SESSION["user_id"])){
	      	?>
	      	<li class="nav-item active">
	      		<a class="nav-link" href=<?php echo DOMAIN;?>/includes/logout.php><i class="fa fa-user">&nbsp</i>logout</a>
	      	<?php
	      }
	      ?>
	        
	      </li>
	    </ul>
	  </div>
	</nav>	
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Showroom Management System</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- <link rel="stylesheet" type	= "text/css" href="/includes/style.css"> -->
	<script type="text/javascript" rel="stylesheet" src="js/main.js"></script>
	
	
</head>
<body>
	<div class="lds-dual-ring"></div>
	<?php
		
	?>
	<br></br>
	<div class="container">
		<?php
		if(isset($_GET["msg"]) and !empty($_GET["msg"])){
		?>
		<div class="alert alert-success" role="alert">
  		<?php echo $_GET["msg"]; ?>
		</div>
		<?php
		}
		?>


		
		<div class="card mx-auto"  style="width: 18rem;">
		  <img class="card-img-top mx-auto" style="width:60%;"  src="./images/login.png" alt="Login">
		  <div class="card-body">
		    <h5 class="card-title"></h5>

		    <form id ="login_form" onsubmit="return false">
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email address</label>
			    <input type="email" name="log_email" id="log_email" class="form-control" placeholder="Enter email">
			    <small id="e_error" class="form-text text-muted"></small>
			  </div>

			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" id="log_password" name="log_password" class="form-control" placeholder="Password">
			    <small id="p_error" class="form-text text-muted"></small>
			  </div>
			  <button type="submit" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Login</button>
			</form>
		   </div>
		   <div class="card-footer"><a href="./buyer_view_cars.php"><b>I am a buyer</div>
		   	<div class="card-footer"><a href="/showroom/public_html/templates/seller_add_car.php"><b>I am a seller</div>
		</div>
	</div>

</body>
</html>
