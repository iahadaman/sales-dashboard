 <?php
	session_start();
	if(isset($_SESSION["admin_name"])) 
	{
		if(time()-$_SESSION["login_time_stamp"] > 1440)  
		{
		    session_unset();
		    session_destroy();
		    echo '1';
		}
	}
?>