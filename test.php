<?php
include_once("./database/constants.php");  

$row["car_id"]=17;


echo "<td>
			<a href='".DOMAIN."/includes/edit_car.php' car_id='".$row["car_id"]."' class='btn btn-info btn-sm edit_car'>Edit
			<a>
			<a href='#' car_id='".$row["car_id"]."' class='btn btn-danger btn-sm delete_car'>Delete
			</td>";






?>