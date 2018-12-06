$(document).ready(function(){
	
	var DOMAIN="http://localhost/showroom/public_html";
	fetch_cars();
	function fetch_cars(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {get_income_statement:1},
			success: function(data){
				// alert(data);
				$("#income_statement").html(data);
			}



			})
	}
})	