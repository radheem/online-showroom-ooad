// alert("hello");
$(document).ready(function(){
	var DOMAIN="http://localhost/showroom/public_html";

	//for registration
	$("#register_form").on("submit",function(){
		// alert("hello");
	
		
		var name=$("#username");
		var email=$("#email");
		var pass1=$("#password1");
		var pass2=$("#password2");
		var type=$("#userType");
		var salary=$("#salary");

		var status=false;
		var status1=false;
		var status2=false;
		var status3=false;
		var status4=false;
		var status5=false;
		

		var e_patt = new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);///^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2.4})$/);
		
		if(name.val().length<6){
			
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");
			status0=false;
		}else{
			
			name.removeClass("border-danger");
			$("#u_error").html("");
			status0=true;
		}


		// alert(email.val().length);
		if(!e_patt.test(email.val())){
			// alert("if");
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Enter a valid email address</span>");
			status1=false;
		}else{
			// alert("else");
			email.removeClass("border-danger");
			$("#e_error").html("");
			status1=true;
		}



		
		if(pass1.val().length<5){
			
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status2=false;
		}else{
			
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status2=true;
		}


		if(pass2.val().length<5){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status3=false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status3=true;
		}


		
		if(type.val()=="" ){
			
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Choose a User Type</span>");
			status4=false;
		}else{
			
			type.removeClass("border-danger");
			$("#t_error").html("");
			status4=true;
		}
		
		if(salary.val()==""){
			
			salary.addClass("border-danger");
			$("#salary_error").html("<span class='text-danger'>Enter salary of employee</span>");
			status5=false;
		}else{
			
			salary.removeClass("border-danger");
			$("#salary_error").html("");
			status5=true;
		}

		if(pass1.val() == pass2.val() && status0 == true && status1 == true && status2 == true && status3 == true && status4 == true && status5 == true){
			// alert("if");
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#register_form").serialize()+"&register="+1,
				success : function(data){
					
					if(data == "Email already registered"){
						alert("The email you entered is already registered");
					}else if (data=="User successfully registered") {
						alert("User successfully registered");
						window.location.href=encodeURI(DOMAIN+"/index.php?msg=You were succesfully registered! Now you can login");
					}else{
						alert(data);
						// alert("all good");
						
					}
				}

			})
		}else{
			// alert("else");
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Passwords did not match</span>");
			status=false;
		}
		})


	//for login
	$("#login_form").on("submit",function(){
		$(".lds-dual-ring").show();
		var email=$("#log_email");
		var pass=$("#log_password");
		var status0 = true;
		var status1 = true;

		if(email.val() == ""){
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please enter an email</span>");
			status0 = false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status0 = true;
		}
		if(pass.val() == ""){
			pass.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please enter a password</span>");
			status1 = false;
		}else{
			pass.removeClass("border-danger");
			$("#p_error").html("");
			status1 = true;
		}
		if(status0 == true && status1 == true){
			
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#login_form").serialize()+"&login="+1,
				success : function(data){
					// alert(data);
					if(data == "Not Registered"){
						email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>Email not registered</span>");
					}else if (data=="incorrect password") {
						pass.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Incorrect password</span>");
					}else if ("login successful"){
						// alert("all good");
						window.location.href=encodeURI(DOMAIN+"/dashboard.php");
					}else{
						alert(data);
					}
				}

			})
		}


	})	

	//adding a car
	$("#add_car").on("submit",function(){
		
		var rp=$("#rp");
		var make=$("#make");
		var model=$("#model");
		var year=$("#year");
		var bp=$("#bp");
		var color=$("#color");
		var transaction=$("#transaction");
		
		var status0 = false;
		var status1 = false;
		var status2 = false;
		var status3 = false;
		var status4 = false;
		var status5 = false;
		var status6 = false;

		var y_patt = new RegExp(/^[0-9]{4,4}$/);

		var r_patt = new RegExp(/^[a-zA-Z0-9]{6,9}$/);

		if(!r_patt.test(rp.val())){
			// alert("if");
			rp.addClass("border-danger");
			$("#rp_error").html("<span class='text-danger'>Enter a valid registration</span>");
			status0=false;
		}else{
			// alert("else");
			rp.removeClass("border-danger");
			$("#rp_error").html("");
			status0=true;
		}

		if(make.val() == ""){
			make.addClass("border-danger");
			$("#make_error").html("<span class='text-danger'>Please enter a make</span>");
			status1 = false;
		}else{
			make.removeClass("border-danger");
			$("#make_error").html("");
			status1 = true;
		}
		if(model.val() == ""){
			
			model.addClass("border-danger");
			$("#model_error").html("<span class='text-danger'>Please enter a model</span>");
			status2 = false;
		}else{
			model.removeClass("border-danger");
			$("#model_error").html("");
			status2 = true;
		}

		
		if(!y_patt.test(year.val())){
			// alert("if");
			year.addClass("border-danger");
			$("#year_error").html("<span class='text-danger'>Enter a valid year</span>");
			status3=false;
		}else{
			// alert("else");
			year.removeClass("border-danger");
			$("#year_error").html("");
			status3=true;
		}

		if(bp.val() == ""){
			bp.addClass("border-danger");
			$("#bp_error").html("<span class='text-danger'>Please enter a buying price</span>");
			status4 = false;
		}else{
			bp.removeClass("border-danger");
			$("#bp_error").html("");
			status4 = true;
		}

		if(color.val() == ""){
			color.addClass("border-danger");
			$("#color_error").html("<span class='text-danger'>Please enter a make</span>");
			status5 = false;
		}else{
			color.removeClass("border-danger");
			$("#color_error").html("");
			status5 = true;
		}
		if(transaction.val() == ""){
			transaction.addClass("border-danger");
			$("#transaction_error").html("<span class='text-danger'>Please select transaction type</span>");
			status6 = false;
		}else{
			transaction.removeClass("border-danger");
			$("#transaction_error").html("");
			status6 = true;
		}
		// alert(transaction.val());

		if(status0 == true && status1 == true && status2 == true && status3 == true && status4 == true && status5 == true && status6 == true){
			
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#add_car").serialize()+"&add_car="+1,
				success : function(data){
					// alert(data);
					if(data == "car sucessfully added to the database"){
						window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Car succesfully added to the database!");
					}else{
						alert(data);
						// alert("all good");
						// window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Something went wrong");
					}
				}

			})
		}

	})
	
$("#seller_add_car").on("submit",function(){
		
		var rp=$("#rp");
		var make=$("#make");
		var model=$("#model");
		var year=$("#year");
		var bp=$("#bp");
		var color=$("#color");
		var transaction=$("#transaction");
		
		var status0 = false;
		var status1 = false;
		var status2 = false;
		var status3 = false;
		var status4 = false;
		var status5 = false;
		var status6 = false;

		var y_patt = new RegExp(/^[0-9]{4,4}$/);

		var r_patt = new RegExp(/^[a-zA-Z0-9]{6,9}$/);

		if(!r_patt.test(rp.val())){
			// alert("if");
			rp.addClass("border-danger");
			$("#rp_error").html("<span class='text-danger'>Enter a valid registration</span>");
			status0=false;
		}else{
			// alert("else");
			rp.removeClass("border-danger");
			$("#rp_error").html("");
			status0=true;
		}

		if(make.val() == ""){
			make.addClass("border-danger");
			$("#make_error").html("<span class='text-danger'>Please enter a make</span>");
			status1 = false;
		}else{
			make.removeClass("border-danger");
			$("#make_error").html("");
			status1 = true;
		}
		if(model.val() == ""){
			
			model.addClass("border-danger");
			$("#model_error").html("<span class='text-danger'>Please enter a model</span>");
			status2 = false;
		}else{
			model.removeClass("border-danger");
			$("#model_error").html("");
			status2 = true;
		}

		
		if(!y_patt.test(year.val())){
			// alert("if");
			year.addClass("border-danger");
			$("#year_error").html("<span class='text-danger'>Enter a valid year</span>");
			status3=false;
		}else{
			// alert("else");
			year.removeClass("border-danger");
			$("#year_error").html("");
			status3=true;
		}

		if(bp.val() == ""){
			bp.addClass("border-danger");
			$("#bp_error").html("<span class='text-danger'>Please enter a buying price</span>");
			status4 = false;
		}else{
			bp.removeClass("border-danger");
			$("#bp_error").html("");
			status4 = true;
		}

		if(color.val() == ""){
			color.addClass("border-danger");
			$("#color_error").html("<span class='text-danger'>Please enter a make</span>");
			status5 = false;
		}else{
			color.removeClass("border-danger");
			$("#color_error").html("");
			status5 = true;
		}
		if(transaction.val() == ""){
			transaction.addClass("border-danger");
			$("#transaction_error").html("<span class='text-danger'>Please select transaction type</span>");
			status6 = false;
		}else{
			transaction.removeClass("border-danger");
			$("#transaction_error").html("");
			status6 = true;
		}
		// alert(transaction.val());

		if(status0 == true && status1 == true && status2 == true && status3 == true && status4 == true && status5 == true && status6 == true){
			
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#seller_add_car").serialize()+"&seller_add_car="+1,
				success : function(data){
					// alert(data);
					if(data == "car sucessfully added to the database"){
						window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Your car was recorded!");
					}else{
						alert(data);
						// alert("all good");
						// window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Something went wrong");
					}
				}

			})
		}

	})

	fetch_cars();
	function fetch_cars(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getCars:1},
			success: function(data){
				// alert(data);
				var root = "<option value=''>Choose a Car</option>";
				$("#select_car").html(root+data);
			}



			})
	}	
	fetch_salesman();
	function fetch_salesman(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getSalesman:1},
			success: function(data){
				// alert(data);
				var root = "<option value=''>Choose Salesman</option>";
				$("#select_salesman").html(root+data);
			}



			})
	}	
	$("#record_sale").on("submit",function(){
		
		var car=$("#select_car");
		var salesman=$("#select_salesman");
		var sp=$("#selling_price");
		status1 = true;
		status1 = true;
		status3 = true;
		

		if(car.val() == ""){
			car.addClass("border-danger");
			$("#car_error").html("<span class='text-danger'>Please select a car</span>");
			status1 = false;
		}else{
			car.removeClass("border-danger");
			$("#car_error").html("");
			status1 = true;
		}

		if(salesman.val() == ""){
			salesman.addClass("border-danger");
			$("#salesman_error").html("<span class='text-danger'>Please enter a make</span>");
			status2 = false;
		}else{
			salesman.removeClass("border-danger");
			$("#salesman_error").html("");
			status2 = true;
		}
		if(sp.val() == ""){
			sp.addClass("border-danger");
			$("#sp_error").html("<span class='text-danger'>Please enter a buying price</span>");
			status3 = false;
		}else{
			sp.removeClass("border-danger");
			$("#sp_error").html("");
			status3 = true;
		}

		if(status1 == true && status2 == true && status3 == true){
			
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#record_sale").serialize()+"&record_sale="+1,
				success : function(data){
					// alert(data);
					if(data == "sale recorded"){
						window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Sale succesfully recoreded!");
					}else{
						// alert("all good");
						alert(data);
						// window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Something went wrong.Sale was not recoreded");
					}
				}

			})
		}

	})
	view_cars(1);
	function view_cars(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {viewCars:1,pageno:pn},
			success: function(data){
				// alert(data);
				
				$("#view_cars").html(data);
			}



			})
	}

	buyer_view_cars(1);
	function buyer_view_cars(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {buyer_viewCars:1,viewCars:1,pageno:pn},
			success: function(data){
				// alert(data);
				
				$("#buyer_view_cars").html(data);
			}



			})
	}

	view_users(1);
	function view_users(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {viewUsers:1,pageno:pn},
			success: function(data){
				//alert(data);
				
				$("#view_users").html(data);
			}



			})
	}

	view_sales(1);
	function view_sales(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {viewSales:1,pageno:pn},
			success: function(data){
				//alert(data);
				
				$("#view_sales").html(data);
			}



			})
	}

	$("body").delegate(".page-link","click",function(){
		// alert("hello");
		var pn=$(this).attr("pn");
		// alert(pn);
		view_cars(pn);
	})

	$("body").delegate(".delete_car","click",function(){
		// alert("hello");
		var car_id=$(this).attr("car_id");
		
		if(confirm("Are you sure you want to delete this record?")){
			// alert(car_id);	
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {delete_car:car_id},
				success : function(data){
					// alert(data);
					if(data == "Record successfully deleted"){
						alert("Record successfully deleted");
						window.location.href="";
					}else{
						alert(data);
						// alert("all good");
						alert("Something went wrong");
						window.location.href="";
					}
				}

			})
		}

	})
	
	

	$("body").delegate(".edit_user","click",function(){
		// alert("hello");
		edit_user_id=$(this).attr("user_id");
		$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {edit_user_id:edit_user_id},
				success : function(data){
					// alert(data);
					// alert("hello");
					window.location.href=encodeURI(DOMAIN+"/edit_user.php");
					
				}

			})
			// alert(car_id);			
	})



	$("body").delegate(".disable_user","click",function(){
		// alert("hello");
		var user_id=$(this).attr("user_id");
		
		if(confirm("Are you sure you want to disable this user?")){
			// alert(car_id);	
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {disable_user:user_id},
				success : function(data){
					// alert(data);
					if(data == "User successfully disabled"){
						alert("User successfully disabled");
						window.location.href="";
					}else{
						alert(data);
						// alert("all good");
						alert("Something went wrong");
						window.location.href="";
					}
				}

			})
		}

	})

	$("body").delegate(".enable_user","click",function(){
		// alert("hello");
		var user_id=$(this).attr("user_id");
		
		if(confirm("Are you sure you want to enable this user?")){
			// alert(car_id);	
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {enable_user:user_id},
				success : function(data){
					// alert(data);
					if(data == "User successfully enabled"){
						alert("User successfully enabled");
						window.location.href="";
					}else{
						alert(data);
						// alert("all good");
						alert("Something went wrong");
						window.location.href="";
					}
				}

			})
		}

	})

	$("body").delegate(".edit_car","click",function(){
		// alert("hello");
		edit_car_id=$(this).attr("car_id");
		$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {edit_car_id:edit_car_id},
				success : function(data){
					// alert(data);
					// alert("hello");
					window.location.href=encodeURI(DOMAIN+"/includes/edit_car.php");
					
				}

			})
			// alert(car_id);			
	})

	$("body").delegate(".buy_this_car","click",function(){
		// alert("hello");
		car_id=$(this).attr("car_id");
		$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : {buy_this_car:car_id},
				success : function(data){
					// alert(data);
					// alert("hello");
					// window.location.href=encodeURI(DOMAIN+"/includes/edit_car.php");
					
				}

			})
			// alert(car_id);			
	})

	$("#edit_car").on("submit",function(){
		
		var rp=$("#rp");
		var make=$("#make");
		var model=$("#model");
		var year=$("#year");
		var bp=$("#bp");
		var color=$("#color");
		var transaction=$("#transaction");
		
		var status0 = false;
		var status1 = false;
		var status2 = false;
		var status3 = false;
		var status4 = false;
		var status5 = false;
		var status6 = false;

		var y_patt = new RegExp(/^[0-9]{4,4}$/);

		var r_patt = new RegExp(/^[a-zA-Z0-9]{6,9}$/);

		if(!r_patt.test(rp.val())){
			// alert("if");
			rp.addClass("border-danger");
			$("#rp_error").html("<span class='text-danger'>Enter a valid registration</span>");
			status0=false;
		}else{
			// alert("else");
			rp.removeClass("border-danger");
			$("#rp_error").html("");
			status0=true;
		}

		if(make.val() == ""){
			make.addClass("border-danger");
			$("#make_error").html("<span class='text-danger'>Please enter a make</span>");
			status1 = false;
		}else{
			make.removeClass("border-danger");
			$("#make_error").html("");
			status1 = true;
		}
		if(model.val() == ""){
			
			model.addClass("border-danger");
			$("#model_error").html("<span class='text-danger'>Please enter a model</span>");
			status2 = false;
		}else{
			model.removeClass("border-danger");
			$("#model_error").html("");
			status2 = true;
		}

		
		if(!y_patt.test(year.val())){
			// alert("if");
			year.addClass("border-danger");
			$("#year_error").html("<span class='text-danger'>Enter a valid year</span>");
			status3=false;
		}else{
			// alert("else");
			year.removeClass("border-danger");
			$("#year_error").html("");
			status3=true;
		}

		if(bp.val() == ""){
			bp.addClass("border-danger");
			$("#bp_error").html("<span class='text-danger'>Please enter a buying price</span>");
			status4 = false;
		}else{
			bp.removeClass("border-danger");
			$("#bp_error").html("");
			status4 = true;
		}

		if(color.val() == ""){
			color.addClass("border-danger");
			$("#color_error").html("<span class='text-danger'>Please enter a make</span>");
			status5 = false;
		}else{
			color.removeClass("border-danger");
			$("#color_error").html("");
			status5 = true;
		}
		if(transaction.val() == ""){
			transaction.addClass("border-danger");
			$("#transaction_error").html("<span class='text-danger'>Please select transaction type</span>");
			status6 = false;
		}else{
			transaction.removeClass("border-danger");
			$("#transaction_error").html("");
			status6 = true;
		}

		if(status0 == true && status1 == true && status2 == true && status3 == true && status4 == true && status5 == true && status6 == true){
			
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#edit_car").serialize()+"&edit_car="+1,
				success : function(data){
					// alert(data);
					if(data == "car sucessfully edited"){
						window.location.href=encodeURI(DOMAIN+"/view_cars.php");
					}else{
						alert(data);
						// alert("all good");
						// window.location.href=encodeURI(DOMAIN+"/dashboard.php?msg=Somthing went wrong! Car was not updated.");
					}
				}

			})
		}

	})


	$("#edit_profile").on("submit",function(){
		// alert("hello");
	
		var status=false;
		var name=$("#username");
		var email=$("#email");
		var pass1=$("#password1");
		var pass2=$("#password2");
//		pass1.addClass("border-danger");
		// $("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");

	
// 		//var n_patt = new RegExp(/^[A-Za-z ]+$/);
		var e_patt = new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);///^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2.4})$/);
		
		if(name.val().length<6){
			
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");
			status=false;
		}else{
			
			name.removeClass("border-danger");
			$("#u_error").html("");
			status=true;
		}


		// alert(email.val().length);
		if(!e_patt.test(email.val())){
			// alert("if");
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Enter a valid email address</span>");
			status=false;
		}else{
			// alert("else");
			email.removeClass("border-danger");
			$("#e_error").html("");
			status=true;
		}



		
		if(pass1.val().length<5){
			
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status=false;
		}else{
			
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status=true;
		}


		if(pass2.val().length<5){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status=false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status=true;
		}		

		if(pass1.val() == pass2.val() && status == true){
			// alert("if");
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#edit_profile").serialize()+"&edit_profile="+1,
				success : function(data){
					alert("edited");
					alert(data);
					if(data == "Email already registered"){
						alert("The email you entered is already registered");
					}else if (data=="Something went wrong") {
						alert("Something went wrong");
					}else{
						// alert("all good");
						window.location.href=encodeURI(DOMAIN+"/index.php?msg=You were succesfully registered! Now you can login");
					}
				}

			})
		}else{
			// alert("else");
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Passwords did not match</span>");
			status=false;
		}
		})



	$("#edit_user").on("submit",function(){
		var name=$("#username");
		var email=$("#email");
		var pass1=$("#password1");
		var pass2=$("#password2");
		var type=$("#userType");

		var status=false;
		var status1=false;
		var status2=false;
		var status3=false;
		var status4=false;
		

		var e_patt = new RegExp(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);///^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2.4})$/);
		
		if(name.val().length<6){
			
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Name should be atleast 6 characters long</span>");
			status0=false;
		}else{
			
			name.removeClass("border-danger");
			$("#u_error").html("");
			status0=true;
		}


		// alert(email.val().length);
		if(!e_patt.test(email.val())){
			// alert("if");
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Enter a valid email address</span>");
			status1=false;
		}else{
			// alert("else");
			email.removeClass("border-danger");
			$("#e_error").html("");
			status1=true;
		}



		
		if(pass1.val().length<5){
			
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status2=false;
		}else{
			
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status2=true;
		}


		if(pass2.val().length<5){
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password should be atleast 5 characters long</span>");
			status3=false;
		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status3=true;
		}


		
		if(type.val()=="" ){
			
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Choose a User Type</span>");
			status4=false;
		}else{
			
			type.removeClass("border-danger");
			$("#t_error").html("");
			status4=true;
		}
		

		if(pass1.val() == pass2.val() && status0 == true && status1 == true && status2 == true && status3 == true && status4 == true){
			// alert("if");
			$.ajax({
				
				url: DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#edit_user").serialize()+"&edit_user="+1,
				success : function(data){
					
					if(data == "Email already registered"){
						alert("The email you entered is already registered");
					}else if (data=="User sucessfully edited") {
						alert("User sucessfully edited");
						window.location.href=encodeURI(DOMAIN+"/view_users.php");
					}else{
						alert(data);
						// alert("all good");
						window.location.href=encodeURI("");
					}
				}

			})
		}else{
			// alert("else");
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Passwords did not match</span>");
			status=false;
		}
		})
})

	
