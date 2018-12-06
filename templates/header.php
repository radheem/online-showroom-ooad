<?php
	
	 if(!isset($_SESSION["user_id"])){
	 	header("location:".DOMAIN."/");
	 }

?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	  <a class="navbar-brand" href=<?php echo DOMAIN?>/dashboard.php>Mozil Motors</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href=<?php echo DOMAIN?>/dashboard.php><i class="fa fa-home">&nbsp</i>Home <span class="sr-only">(current)</span></a>
	      </li>
	      
	      	<?php
	      	if(isset($_SESSION["user_id"])){
	      	?>
	      	<li class="nav-item active">
	      		<a class="nav-link" href=<?php echo DOMAIN?>/includes/logout.php><i class="fa fa-user">&nbsp</i>logout</a>
	      	<?php
	      }
	      ?>
	        
	      </li>
	    </ul>
	  </div>
	</nav>	