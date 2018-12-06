$(document).ready(function(){
	
	var DOMAIN="http://localhost/showroom/public_html";
	fetch_cars();
	function fetch_cars(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {get_balance_sheet:1},
			success: function(data){
				// alert(data);
				$("#balance_sheet").html(data);
			}



			})
	}
})	