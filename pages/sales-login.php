<?php require_once '../partials/header.php';?>

<body>
	<div class="logo-style">
		<img class="mt-4 ml-5" src="../images/logo.png" alt="Webtrixpro"/>
	</div>
	<div class="login-box">
	    <div class="container mt-5 mb-5">
	    	<h2 class="text-center">Sales Login</h2>
	    	<p class="text-center">Please login your account</p>
	    	<form>
			  <div class="form-group">
			    <label for="exampleInputEmail1">Email</label>
			    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Please enter your email address">
			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Please enter your password">
			  </div>
	 
	            <button type="submit" class="mt-4 btn btn-style float-right">Login</button>	 
				<div class="clearfix mt-5">									
					<a href = "forget-password.php" class="pull-left">
					forget password?</a>				
				</div>
			</form>
	    </div>
    </div>

	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>