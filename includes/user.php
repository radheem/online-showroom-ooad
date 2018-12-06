<?php 

/**
 * 
 */
class User
{
	private $con;
	public function __construct()
	{
		 
		include_once("../database/db.php");
		$db=new Database();
		$this->con=$db->connect();

		if($this->con){
			// echo 'Connected';
		}else{
			// echo 'Connection error';
		}
	}

	private function userExists($email){
		$pre_stmt=$this->con->prepare("SELECT id FROM USER WHERE EMAIL=? ");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();
		if($result->num_rows>0){
			return 1;
		}else{
			return 0;
		}
	}

	public function registerUser($username,$email,$password,$usertype,$salary){
		if($this->userExists($email)){
			return 'Email already registered';
		}else{
			$pass_hash=password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$date=date("y-m-d h:m:s");
			$notes="";
			$pre_stmt=$this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `salary`, `notes`) VALUES (?,?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("ssssssis",$username,$email,$pass_hash,$usertype,$date,$date,$salary,$notes);
			$result=$pre_stmt->execute() or die($this->con->error);
			
			if($result){
				return "User successfully registered";
			}else{
				return 'Something went wrong';
			}	
		}
		
	}

	public function editUser($userid,$username,$email,$password,$usertype,$salary){
		if($this->userExists($email)){
			return 'Email already registered';
		}else{
			$pass_hash=password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$date=date("y-m-d h:m:s");
			$notes="";
			$pre_stmt = $this->con->prepare("UPDATE `user` SET `username`=?,`email`=?,`password`=?,`usertype`=?,`salary`=?  WHERE `user`.`id` = ?");
			$pre_stmt->bind_param("ssssii",$username,$email,$pass_hash,$usertype,$salary,$userid);
			$result=$pre_stmt->execute() or die($this->con->error);
			
			if($result){
				return "User sucessfully edited";
			}else{
				return 'Something went wrong';
			}	
		}
		
	}

	public function editProfile($userid,$username,$email,$password,$salary){
		
		$pass_hash=password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
		$date=date("y-m-d h:m:s");
		$notes="";
		$pre_stmt = $this->con->prepare("UPDATE `user` SET `username`=?,`email`=?,`password`=?,`salary`=? WHERE `user`.`id` = ?");
		$pre_stmt->bind_param("sssii",$username,$email,$pass_hash,$salary,$userid);
		$result=$pre_stmt->execute() or die($this->con->error);
		
		if($result){
			$_SESSION["user_id"]=$userid;
			$_SESSION["username"]=$username;
			return "User sucessfully edited";
		}else{
			return 'Something went wrong';
		}	
	
		
	}

	public function disableUser($userid){
		$email="Disabled";
		$pre_stmt=$this->con->prepare("SELECT * from user where id=? ");
		$pre_stmt->bind_param("i",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();
		$row = $result->fetch_assoc();
		$notes=$row["email"];


		$pre_stmt=$this->con->prepare("UPDATE `user` SET `email`=?,`notes`=? WHERE `user`.`id` = ?");
		$pre_stmt->bind_param("ssi",$email,$notes,$userid);
		$pre_stmt->execute() or die($this->con->error);
		// echo $result;
		if($result){
			return "User successfully disabled";
		}else{
			return "Something went wrong";
		}


	}

	public function enableUser($userid){
		$pre_stmt=$this->con->prepare("SELECT * from user where id=? ");
		$pre_stmt->bind_param("i",$userid);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();
		$row = $result->fetch_assoc();
		$email=$row["notes"];
		$notes="";


		$pre_stmt=$this->con->prepare("UPDATE `user` SET `email`=?,`notes`=? WHERE `user`.`id` = ?");
		$pre_stmt->bind_param("ssi",$email,$notes,$userid);
		$pre_stmt->execute() or die($this->con->error);
		// echo $result;
		if($result){
			return "User successfully enabled";
		}else{
			return "Something went wrong";
		}


	}

	public function loginUser($email,$password){
		$pre_stmt=$this->con->prepare("SELECT * from user where email=? ");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();

		if($result->num_rows<1){
			return 'Not Registered';
		}else{
			$row=$result->fetch_assoc();
			if(password_verify($password,$row["password"])){
			// 	foreach ($row as $key => $value) {
   //  				echo "Key: $key; Value: $value\n";
			// 	}
				$_SESSION["user_id"]=$row["id"];
				$_SESSION["username"]=$row["username"];
				$_SESSION["last_login"]=$row["last_login"];
				$_SESSION["usertype"]=$row["usertype"];
				

				$pre_stmt=$this->con->prepare("UPDATE user set last_login= ? where email=?");
				$date=date("y-m-d h:m:s");
				$pre_stmt->bind_param("ss",$date,$email);
				$pre_stmt->execute() or die($this->con->error);
				$result=$pre_stmt->get_result();
				//echo $_SESSION["username"].$_SESSION["usertype"];
				if($result){
					return "error updating last_login";
				}else{
					return "login successful";
				}
				}else{
				return "incorrect password";
				}
		}

	}
}

// $obj= new User();
// echo $obj->registerUser("Muzammil","mmuzammilsoahil5@gmail.com","12345","Admin");

// echo $obj->loginUser("mmuzammilsoahil5@gmail.com","12345");
 ?>