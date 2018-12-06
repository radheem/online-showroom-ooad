<?php 

include_once("../database/db.php");

class DBOperation
{
	private $con;
	public function DBOperation()
	{
		$db= new Database;
		$this->con=$db->connect();
	}

	public function addCar($registration,$make,$model,$year,$color,$bp,$bd,$expenses,$transaction){
		// echo $make;
		$registration=strtoupper($registration);
		$make=ucwords($make);
		$model=ucwords($model);
		$color=ucwords($color);
		$pre_stmt = $this->con->prepare("INSERT INTO `car`(`registration`, `make`, `model`, `year`, `color`, `buying_price`,`buying_date`,`expenses`,`transaction`) VALUES (?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param('sssisisis',$registration,$make,$model,$year,$color,$bp,$bd,$expenses,$transaction);
		$result=$pre_stmt->execute() or die($this->con->error);

		if($result){
			return "car sucessfully added to the database";
		}else{
			return "something went wrong";
		}

	}

	public function sellerAddCar($registration,$make,$model,$year,$color,$bp,$bd,$expenses,$transaction){
		// echo $make;
		$registration=strtoupper($registration);
		$make=ucwords($make);
		$model=ucwords($model);
		$color=ucwords($color);
		$comments="seller";
		$pre_stmt = $this->con->prepare("INSERT INTO `car`(`registration`, `make`, `model`, `year`, `color`, `buying_price`,`buying_date`,`expenses`,`transaction`,`comments`) VALUES (?,?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param('sssisisiss',$registration,$make,$model,$year,$color,$bp,$bd,$expenses,$transaction,$comments);
		$result=$pre_stmt->execute() or die($this->con->error);

		if($result){
			return "car sucessfully added to the database";
		}else{
			return "something went wrong";
		}


	}


	public function buy_this_car($buy_this_car){
		$comments="";
		$pre_stmt = $this->con->prepare("UPDATE `car` SET `comments`=? WHERE `car`.`car_id` = ?");

		$pre_stmt->bind_param('si',$commnets,$buy_this_car);
		$result=$pre_stmt->execute() or die($this->con->error);

		if($result){
			return "car sucessfully edited";
		}else{

			return "something went wrong";
		}

	}


	public function editCar($edit_car_id,$registration,$make,$model,$year,$color,$bp,$bd,$expenses,$transaction){
		// echo $transaction;
		$registration=strtoupper($registration);
		$make=ucwords($make);
		$model=ucwords($model);
		$color=ucwords($color);
		$available="Yes";
		//echo "UPDATE `car` SET (`registration`, `make`, `model`, `year`, `color`, `buying_price`,`buying_date`) = (?,?,?,?,?,?,?) WHERE 'car'.'car_id'=?";
		$pre_stmt = $this->con->prepare("UPDATE `car` SET `registration`=?,`make`=?,`model`=?,`year`=?,`color`=?,`buying_price`=?,`buying_date`=?,`available`=?,`expenses`=?,`transaction`=? WHERE `car`.`car_id` = ?");

		$pre_stmt->bind_param('sssisissisi',$registration,$make,$model,$year,$color,$bp,$bd,$available,$expenses,$transaction,$edit_car_id);
		$result=$pre_stmt->execute() or die($this->con->error);

		if($result){
			return "car sucessfully edited";
		}else{
			return "something went wrong";
		}

	}



	public function recordSale($salesman,$car,$selling_date,$selling_price,$transaction){
		// echo $car,$salesman;
		$pre_stmt = $this->con->prepare("INSERT INTO `sale`(`id`, `car_id`, `selling_date`, `selling_price`, `transaction`) VALUES (?,?,?,?,?)");
		$pre_stmt->bind_param('iisis',$salesman,$car,$selling_date,$selling_price,$transaction);
		$result=$pre_stmt->execute() or die($this->con->error);

		if($result){
			$pre_stmt1 = $this->con->prepare("UPDATE `car` SET `available` = 'No' WHERE `car`.`car_id` = ?");
			$pre_stmt1->bind_param('i',$car);
			$result=$pre_stmt1->execute() or die($this->con->error);
			if($result){
			return "sale recorded";
			}
		}else{
			return "something went wrong";
		}
	}

	public function getAllRecords($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				$rows[]=$row;
			}
			return $rows;
		}
		return "no_data";
	}

		public function getAvailableCars(){
		$pre_stmt = $this->con->prepare("SELECT * FROM `car` WHERE `available` = 'Yes'");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				$rows[]=$row;
			}
			return $rows;
		}
		return "no_data";
		}

	public function deleteRecord($table,$pk,$id){
		// $pre_stmt = $this->con->prepare("DELETE FROM `car` WHERE `car`.`car_id` = ?");
		$pre_stmt = $this->con->prepare("DELETE FROM `".$table."` WHERE `".$table."`.`".$pk."` = ?");
		echo "DELETE FROM '".$table."' WHERE '".$table."'.'".$pk."' = ?";

		$pre_stmt->bind_param('i',$id);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return 'Record successfully deleted';
		}else{
			return 'something went wrong';
		}

	}

	private function pagination($con,$table,$pno,$n){
		$pre_stmt = $this->con->prepare("SELECT COUNT(*) as rows FROM 	".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$row =mysqli_fetch_assoc($result);

		$last = ceil($row["rows"]/$n);

		// echo "Total Pages ".$last."<br/>";

		$pagination = "<ul class='pagination'>";

		if($last != 1){

			if ($pno > 1){
				$previous = "";
				$previous = $pno-1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."'href='#'>"."Previous"."</a></li>";
				// echo "<a href='pagination.php?pageno=".$previous."'>"."Previous"."</a>";
				// echo $pagination;

			}
			for($i=$pno-5;$i<$pno;$i++){
				if($i>0){
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."'href='#'> ".$i."</a></li>";
					// echo $pagination;
				}
			}
			$pagination .= "<li class='page-item'><a class='page-link' style='color:red;' pn='".$i."'href='#'> ".$i."</a></li>";

			for($i=$pno+1;$i<$pno+4 && $i<=$last;$i++){
				
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."'href='#'> ".$i."</a></li>";
					// echo $pagination;
				
			}
			if($last > $pno){
				$next=$pno+1;
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."'href='#'>Next</a>";
			}
			$pagination.="</ul>";
			$limit = "LIMIT ".($pno-1)*$n.",".$n;
			// echo "final";
			// echo $pagination;

			return ["pagination"=>$pagination,"limit"=>$limit];
		}
	}

	public function get_records_with_pagination($table,$pno){
		
		$a = $this->pagination($this->con,$table,$pno,20);
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." ".$a["limit"]);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				$rows[]=$row;
			}
		}

		return ["rows"=>$rows,"pagination"=>$a["pagination"]];
	}

	public function get_sales(){
		$pre_stmt = $this->con->prepare("select *,(selling_price - buying_price)as profit from car c inner join (select u.username,s.car_id,s.`selling_date`, s.`selling_price`, s.`transaction` As selling_transaction from user u inner join sale s where u.id=s.id)s2 on s2.car_id=c.car_id");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				$rows[]=$row;
			}
		}

		return $rows;	
	}

	public function get_balance_sheet(){
        
        
        $year = date('Y') - 4;

        echo "<tr><td><b>Assets<b></td></tr>";
		echo "<tr><td><b> Current Assets<b></td></tr>";
		echo "<tr><td> Inventory</td>";
		
		echo "select EXTRACT(YEAR FROM buying_date) as year,sum(buying_price) as inventory from car where transaction in ('Cash','Bank') GROUP BY EXTRACT(YEAR FROM buying_date)";
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM buying_date) as year,sum(buying_price) as inventory from car where transaction in ('Cash','Bank') GROUP BY EXTRACT(YEAR FROM buying_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		$sum = array();
		$sum2 = array();

		for($i=0;$i<=4;$i++){
			$sum[$i]=0;
			$sum2[$i]=0;
		}
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		$year = date('Y') - 4;
		echo "<tr><td> Accounts Receivable</td>";
		
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM selling_date) as year,sum(selling_price) as inventory from sale where transaction='Credit' GROUP BY EXTRACT(YEAR FROM selling_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];
				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		$year = date('Y') - 4;
		echo "<tr><td> Cash on hand</td>";
		
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM selling_date) as year,sum(selling_price - expenses) as inventory from sale s inner join car c on s.car_id=c.car_id  where s.transaction='Cash' GROUP BY EXTRACT(YEAR FROM selling_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];
				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";


		$year = date('Y') - 4;
		echo "<tr><td> Cash in Bank</td>";
		
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM selling_date) as year,sum(selling_price - expenses) as inventory from sale s inner join car c on s.car_id=c.car_id  where s.transaction='Bank' GROUP BY EXTRACT(YEAR FROM selling_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];
				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";




		echo "<tr><td><b> Total Current Assets<b></td>";
		for($i=0;$i<=4;$i++){
			if(isset($sum[$i])){
				echo "<td><b>$".$sum[$i]."</td>";
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		for($i=0;$i<=4;$i++){
			$sum[$i]=0;
		}

		echo "<tr><td></td></tr>";
		echo "<tr><td><b> Liabilities<b></td>";
		echo "<tr><td><b> Current Liabilities<b></td>";
		

		$year = date('Y') - 4;
		echo "<tr><td> Accounts Payable</td>";
		
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM buying_date) as year,sum(buying_price) as inventory from car where transaction='Credit' GROUP BY EXTRACT(YEAR FROM buying_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];
				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		echo "<tr><td><b>Total Current Liabilities<b></td>";
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td><b>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
				$sum2[$i]+=$sum[$i];
			}else{
				echo "<td><b>$0</td>";
			}
		}
		echo "</tr>";

		

		
		echo "<tr><td></td></tr>";
		echo "<tr><td><b>Shareholder's Equity<b></td>";


		$year = date('Y') - 4;
		echo "<tr><td>Capital</td>";

		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM buying_date) as year,sum(buying_price) as inventory from car where transaction in ('Cash','Bank') GROUP BY EXTRACT(YEAR FROM buying_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		$sum = array();
		for($i=0;$i<=4;$i++){
			$sum[$i]=0;
		}

		
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		$year = date('Y') - 4;
		echo "<tr><td>Net Profit</td>";

		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM selling_date) as year,sum(selling_price - buying_price- expenses) as inventory from sale s inner join car c where s.car_id=c.car_id  GROUP BY EXTRACT(YEAR FROM selling_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();

		
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}
		echo "</tr>";

		echo "<tr><td><b> Total Shareholders Equity<b></td>";
		for($i=0;$i<=4;$i++){
			if(isset($sum[$i])){
				echo "<td><b>$".$sum[$i]."</td>";
				$sum2[$i]+=$sum[$i];
			}else{
				echo "<td><b>$0</td>";
			}
		}
		echo "</tr>";


		echo "<tr><td></td>";
		echo "<tr><td><b> Total Shareholders Equity and Liabilities<b></td>";
		for($i=0;$i<=4;$i++){
			if(isset($sum2[$i])){
				echo "<td><b>$".$sum2[$i]."</td>";
			}else{
				echo "<td><b>$0</td>";
			}
		}
		echo "</tr>";

		

	}

	public function get_income_statement(){
        
        
        $year = date('Y') - 4;

        
        echo "<tr><td><b><b></td></tr>";
        echo "<tr><td><b>Revenue<b></td></tr>";
		echo "<tr><td> Sales Revenue</td>";
		
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM selling_date) as year,sum(selling_price) as inventory from sale GROUP BY EXTRACT(YEAR FROM selling_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();
		$sum = array();
		$sum2 = array();

		for($i=0;$i<=4;$i++){
			$sum[$i]=0;
			$sum2[$i]=0;
		}
		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}

		echo "<tr><td><b> Total Net Revenue<b></td>";

		for($i=0;$i<=4;$i++){
				echo "<td><b>$".$sum[$i]."</td>";
		}

		echo "<tr>";

		echo "<tr><td>Cost of Goods Sold</td>";
		
		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM buying_date) as year,sum(buying_price) as inventory from car GROUP BY EXTRACT(YEAR FROM buying_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();

		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum[$i]-=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}

		echo "<tr><td><b> Total Gross Profit<b></td>";

		for($i=0;$i<=4;$i++){
				echo "<td><b>$".$sum[$i]."</td>";
		}

		echo "<tr>";


		echo "<tr><td></tr>";

		echo "<tr><td><b>Expenses<b></td></tr>";
		echo "<tr><td> Salary</td>";

	

		
		$pre_stmt = $this->con->prepare("select sum(salary) as sal from user");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = $result->fetch_assoc();
		$output = $rows["sal"];

		for($i=0;$i<=4;$i++){
			if(isset($output)){
				echo "<td>$".$output."</td>";
				$sum2[$i]+=$output;
			}else{
				echo "<td>$0</td>";
			}
		}

		echo "<tr><td> Expenses</td>";

		$pre_stmt = $this->con->prepare("select EXTRACT(YEAR FROM buying_date) as year,sum(expenses) as inventory from car GROUP BY EXTRACT(YEAR FROM buying_date)");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		$output = array();

		if ($result->num_rows >0 ) {
			while($row = $result->fetch_assoc()){
				if($row["year"]>=$year && $row["year"]<=$year+4){
					$output[$row["year"]-$year]=$row["inventory"];

				}
			}
		}
		for($i=0;$i<=4;$i++){
			if(isset($output[$i])){
				echo "<td>$".$output[$i]."</td>";
				$sum2[$i]+=$output[$i];
			}else{
				echo "<td>$0</td>";
			}
		}

		echo "<tr><td><b>Total Expenses<b></td>";

		for($i=0;$i<=4;$i++){
				echo "<td><b>($".$sum2[$i].")</td>";
		}

		echo "<tr><td><b><b></td></tr>";
		echo "<tr><td><b>Taxable Income</td>";

		for($i=0;$i<=4;$i++){
				$sum[$i]-=$sum2[$i];
				echo "<td><b>$".$sum[$i]."</td>";
		}

		echo "<tr><td><b>Income Tax Expense(17%)</td>";

		for($i=0;$i<=4;$i++){
				echo "<td><b>($".($sum[$i]*0.17).")</td>";
		}

		echo "<tr><td><b><b></td></tr>";
		echo "<tr><td><b>Net Income</td>";

		for($i=0;$i<=4;$i++){
				echo "<td><b>$".($sum[$i]*0.83)."</td>";
		}



	}
}



// $DBO=new DBOperation();
// echo $DBO->addCar("Honda","City",1995,950000,1100000,"Malik");
//echo $DBO->deleteRecord("car","car_id",22);
// print_r($DBO->get_records_with_pagination("car",3));

 ?>