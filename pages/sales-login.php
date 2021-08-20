<?php require_once '../partials/header.php';?>
	<div class="logo-style">
		<img class="mt-4 ml-5" src="../images/logo.png" alt="Webtrixpro"/>
	</div>
	<div class="login-box">
	    <div class="container mt-5 mb-5">
	    	<h2 class="text-center">Sales Login</h2>
	    	<p class="text-center">Please login your account</p>
	    	<form>
	    		<div id="sales_login_error" style="display: none;" class= "alert alert-danger">All Fields Are Required!!</div>
			  <div class="form-group">
			    <label for="clientEmail">Email</label>
			    <input type="email" class="form-control" id="clientEmail" placeholder="Please enter your email address">
			  </div>
			  <div class="form-group">
			    <label for="clientPassword">Password</label>
			    <input type="password" class="form-control" id="clientPassword" placeholder="Please enter your password">
			  </div>
	 
	            <button id="salesLoginButton" type="submit" class="mt-4 btn btn-style float-right">Login</button>	 
				<div class="clearfix mt-5">													
				</div>
			</form>
	    </div>
    </div>

<?php require_once '../partials/footer.php';?>   