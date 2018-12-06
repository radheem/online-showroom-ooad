<?php
class Database
{
	private $con;
	
	public function Connect(){
		$this->con=new Mysqli("localhost","root","","bilal");

		if($this->con){
			return "success";
		}else{
			return "failure";
		}
		
	}
}
$database= new Database();
echo $database->Connect();
?>