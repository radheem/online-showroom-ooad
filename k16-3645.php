<?php
class Db
{
	private $radheem;
	
	public function Con(){
		$this->radheem=new Mysqli("localhost","root","","test");

		if($this->radheem){
			return "conection established";
		}else{
			return "connection failure";
		}
		
	}
}
$db= new Db();
echo $db->Con();
?>