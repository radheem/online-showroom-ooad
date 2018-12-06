<?php 
include_once("../database/constants.php");

include("DBOperation.php");
include("user.php");
// session_start();

//echo $_SESSION["usertype"];

//registration
// echo $_POST["edit_car_id"];
if (isset($_POST["register"])) {
	$user=new User();
	$result=$user->registerUser($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"],$_POST["salary"]);
	echo $result;
	exit();
}

//login

if (isset($_POST["login"])) {
	$user=new User();
	$result=$user->loginUser($_POST["log_email"],$_POST["log_password"]);
	echo $result;
	exit();

}

//addCar
if (isset($_POST["add_car"])) {
	// echo $_POST["edit_car_id"];
	$DBO=new DBOperation();
	$result= $DBO->addCar($_POST["rp"],$_POST["make"],$_POST["model"],$_POST["year"],$_POST["color"],$_POST["bp"],$_POST["buying_date"],$_POST["expenses"],$_POST["transaction"]);
	echo $result;
	exit();
}

if (isset($_POST["seller_add_car"])) {
	// echo $_POST["edit_car_id"];
	$DBO=new DBOperation();
	$result= $DBO->sellerAddCar($_POST["rp"],$_POST["make"],$_POST["model"],$_POST["year"],$_POST["color"],$_POST["bp"],$_POST["buying_date"],$_POST["expenses"],$_POST["transaction"]);
	echo $result;
	exit();
}

//get data
if (isset($_POST["getCars"])){
	echo "hello";
	$obj=new DBOperation();
	$rows=$obj->getAvailableCars();
	foreach($rows as $row){
		echo "<option value='".$row["car_id"]."'>".$row["registration"]." ".$row["color"]." ".$row["make"]." ".$row["model"]." ".$row["year"]."</option>";
	}
	exit();
}

if (isset($_POST["viewCars"])){
	// echo "hello";
	$obj=new DBOperation();
	$pno=$_POST["pageno"];
	$result=$obj->get_records_with_pagination("car",$pno);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if(count($rows) > 0){
		$num=($pno-1)*20+1;
		foreach($rows as $row){
			// <a href='".DOMAIN."/includes/edit_car.php' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
			echo 
			"<tr>
			<td>".$num."</td>
			<td>".$row["registration"]."</td>
			<td>".$row["make"]."</td>
			<td>".$row["model"]."</td>
			<td>".$row["year"]."</td>
			<td>".$row["color"]."</td>";
			if(!isset($_POST["buyer_viewCars"])){
				echo 
				"<td>$".$row["buying_price"]."</td>
				<td>".substr( $row["buying_date"], 0, 4)."</td>
				<td>$".$row["expenses"]."</td>
				<td>".$row["transaction"]."</td>";
				if($row["comments"] == 'seller'){
					echo "
					<td>
					<a href='#' car_id='".$row["car_id"]."' class='btn btn-info btn-sm buy_this_car'>Buy this Car
					</td>";
				}else if($row["available"] == 'Yes'){
					echo "<div class='row'> 
					<td>
					<a href='#' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
					<a href='#' car_id='".$row["car_id"]."' class='btn btn-danger btn-sm delete_car'>Delete
					</td>
					</div>";
				}
			}
			echo "</tr>";
			$num++;
		}	
		echo "<tr><td colspan ='3'>".$pagination."</td></tr>";
	}
	
	exit();
}

if (isset($_POST["viewUsers"])){
	// echo "hello";
	$obj=new DBOperation();
	$pno=$_POST["pageno"];
	$result=$obj->get_records_with_pagination("user",$pno);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if(count($rows) > 0){
		$num=($pno-1)*20+1;
		foreach($rows as $row){
			// <a href='".DOMAIN."/includes/edit_car.php' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
			echo 
			"<tr>
			<td>".$num."</td>
			<td>".$row["username"]."</td>
			<td>".$row["email"]."</td>
			<td>".$row["usertype"]."</td>
			<td>".$row["register_date"]."</td>
			<td>".$row["last_login"]."</td>
			<td>".$row["salary"]."</td>
			</td>";
			if($_SESSION["usertype"] == 'Admin'){
				if($_SESSION["user_id"] == $row["id"]){
					echo "<td>
					<a href='./includes/edit_profile.php' user_id='".$row["id"]."' class='btn btn-info btn-sm '>Edit
					<a>";
				}else{
					
					
						if($row["email"] == 'Disabled'){
							echo "<td><a href='#' user_id='".$row["id"]."' class='btn btn-danger btn-sm enable_user'>Enable
							</td>";
						}else{
							echo "<td>
							<a href='#' user_id='".$row["id"]."' class='btn btn-info btn-sm edit_user'>Edit
							<a>";
							echo "<a href='#' user_id='".$row["id"]."' class='btn btn-danger btn-sm disable_user'>Disable
							</td>";

						}
					}
				}
			echo "</tr>";
			$num++;
		}	
		echo "<tr><td colspan ='3'>".$pagination."</td></tr>";
	}
	
	exit();
}

if (isset($_POST["viewSales"])){
	// echo "hello";
	$obj=new DBOperation();
	
	$rows=$obj->get_sales();

	if(count($rows) > 0){
		$num=0;
		foreach($rows as $row){
			// <a href='".DOMAIN."/includes/edit_car.php' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
			
			echo
			"<tr>
			<td>".$num."</td>
			<td>".$row["make"]." ".$row["model"]." ".$row["year"]."</td>
			<td>".$row["username"]."</td>
			<td>".$row["buying_date"]."</td>
			<td>".$row["selling_date"]."</td>
			<td>".$row["transaction"]."</td>
			<td>".$row["selling_transaction"]."</td>
			<td>".$row["buying_price"]."</td>
			<td>$".$row["expenses"]."</td>
			<td>".$row["selling_price"]."</td>
			<td>".$row["profit"]."</td>"	;


			echo "<td>
			<a href='#' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
			<a href='#' car_id='".$row["car_id"]."' class='btn btn-danger btn-sm delete_car'>Delete
			</td>";

			echo "</tr>";
			$num++;
		}	
	}
	
	exit();
}


if (isset($_POST["getSalesman"])){
	$obj=new DBOperation();
	$rows=$obj->getAllRecords("user");
	foreach($rows as $row){
		echo "<option value='".$row["id"]."'>".$row["username"]." (".$row["email"].")</option>";
	}
	exit();
}

if (isset($_POST["record_sale"])){
	$obj=new DBOperation();
	$result=$obj->recordSale($_POST["select_salesman"],$_POST["select_car"],$_POST["selling_date"],$_POST["selling_price"],$_POST["transaction"]);
	echo $result;
	exit();
}

if (isset($_POST["delete_car"])){
	// alert("hello");
	$obj=new DBOperation();
	$result=$obj->deleteRecord("car","car_id",$_POST["delete_car"]);
	echo $result;
	exit();
}



if (isset($_POST["disable_user"])){
	//alert("hello");
	$user=new User();
	$result=$user->disableUser($_POST["disable_user"]);
	echo $result;
	exit();
}
if (isset($_POST["enable_user"])){
	//alert("hello");
	$user=new User();
	$result=$user->enableUser($_POST["enable_user"]);
	echo $result;
	exit();
}



if (isset($_POST["edit_car_id"])) {
	session_start();
	$_SESSION["edit_car_id"]=$_POST["edit_car_id"];
	echo $_SESSION["edit_car_id"];
	exit();
}

if (isset($_POST["buy_this_car"])) {
	session_start();
	$DBO=new DBOperation();
	$result= $DBO->buy_this_car($POST["buy_this_car"]);
	echo $result;
	exit();
	exit();
}

if (isset($_POST["edit_car_page"]) ) {
	// echo $_POST["edit_car_id"];
	// session_start();
	//$_SESSION["edit_car_id"];
	$DBO=new DBOperation();
	$result= $DBO->editCarPage($_SESSION["edit_car_id"]);
	echo $result;
	exit();
}

if (isset($_POST["edit_car"]) ) {
	// echo $_POST["edit_car_id"];
	// session_start();
	//$_SESSION["edit_car_id"];
	// echo $_POST["transaction"];
	$DBO=new DBOperation();
	$result= $DBO->editCar($_SESSION["edit_car_id"],$_POST["rp"],$_POST["make"],$_POST["model"],$_POST["year"],$_POST["color"],$_POST["bp"],$_POST["buying_date"],$_POST["expenses"],$_POST["transaction"]);
	echo $result;
	exit();
}




if (isset($_POST["edit_profile"]) ) {
	// echo $_POST["edit_car_id"];
	// session_start();
	//$_SESSION["edit_car_id"];
	$user=new User();
	$result=$user->editProfile($_SESSION["user_id"],$_POST["username"],$_POST["email"],$_POST["password1"],$_POST["salary"]);
	echo $result;
	exit();
}



if (isset($_POST["edit_user_id"])) {
	// session_start();
	$_SESSION["edit_user_id"]=$_POST["edit_user_id"];
	echo $_SESSION["edit_user_id"];
	exit();
}
if (isset($_POST["edit_user"])) {
	$user=new User();
	$result=$user->editUser($_SESSION["edit_user_id"],$_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"],$_POST["salary"]);
	echo $result;
	exit();
}


if (isset($_POST["get_balance_sheet"])) {
	$obj=new DBOperation();
	
	echo $obj->get_balance_sheet();	
	exit();
}

if (isset($_POST["get_income_statement"])) {
	$obj=new DBOperation();
	// echo "gello";
	
	echo $obj->get_income_statement();	
	exit();
}

?>