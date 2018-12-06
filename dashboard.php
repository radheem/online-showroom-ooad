<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Showroom Management System</title>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
	<?php
		include_once("./database/constants.php");
		include_once("./templates/header.php");
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
			<div class="row">
				<div class="col-md-4" >
					<div class="card " style="width: 18rem;">
						<br></br>
					  	<img class="card-img-top mx-auto" style="width: 80%" src="./images/user.png" alt="Card image cap">
					  <div class="card-body">
					    <h5 class="card-title">Profile</h5>
					    <p class="card-text"><?php echo $_SESSION["username"]?></p>
					    <p class="card-text"><?php echo $_SESSION["usertype"]?></p>
					    <p class="card-text">Last Login : <?php echo $_SESSION["last_login"]?></p>
					    <a href="./includes/edit_profile.php" class="btn btn-primary"><i class="fa fa-user">&nbsp</i>Edit Profile</a>
					  </div>    
					</div>
				</div>
				<div class="col-md-8" 	>
					<!-- <div class ="jumbotron" style="width:100%; height:100%"> -->
						<div class="row">
							<div class ="col-md-7"><h2>Hello <?php echo $_SESSION["usertype"]?></h2>
							</div>
							<div class ="col-md-1">
								

							</div>
							</div>

					
											
						<div class="row">
							<div class="card" style="width: 100%">
						      <div class="card-body">
						        <h5 class="card-title">Manage Cars</h5>
						        <p class="card-text">Here you can add new cars and update information of exsisting cars</p>
						        <a href="templates/addCar.php" class="btn btn-primary">Add Car</a>
						        <a href="view_cars.php" class="btn btn-primary">View all Cars</a>
						      </div>
						    </div>
						</div>
						<?php
						if($_SESSION["usertype"]=='Admin'){
						?>
						<div class="row">
							<div class="card" style="width: 100%">
						      <div class="card-body">
						        <h5 class="card-title">Manage Employees</h5>
						        <p class="card-text">Choose who can use the database and manage privileges</p>
						        <a href="register.php" class="btn btn-primary">Add Employee</a>
						        <a href="view_users.php" class="btn btn-primary">Manage Employee</a>
						      </div>
					      	</div>
						</div>
						<?php
						}
						?>
						
						<div class ="row">
								<div class="card" style="width: 100% ">
							      <div class="card-body ">
							        <h5 class="card-title ">Record Sale</h5>
							        <p class="card-text">Here you can create new orders and review previous sales</p>
							        <a href="templates/recordSale.php" class="btn btn-primary">Record Sale</a>
							        <a href="view_sales.php" class="btn btn-primary">Manage Sales</a>
							      </div>
							    </div>
							</div>
						<div class="row">
							<div class="card" style="width: 100%">
						      <div class="card-body">
						        <h5 class="card-title">Showroom's Health</h5>
						        <p class="card-text">See your Financial Position and Profit/Loss</p>
						        <a href="balance_sheet.php" class="btn btn-primary">Balance Sheet</a>
						        <a href="income_statement.php" class="btn btn-primary">Income Statement</a>
						      </div>
						  	</div>
						</div>
				</div>
			</div>
	</div>
</body>
</html>
