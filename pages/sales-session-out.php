  <?php
	session_start();
	if(isset($_SESSION["client_name"])) 
	{
		if(time()-$_SESSION["sales_login_time_stamp"] > 1440)  
		{
		    session_unset();
		    session_destroy();
		    echo '1';
		}
	}
?>