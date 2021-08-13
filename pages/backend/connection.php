  <?php
	$HostName = "localhost";
	$UserName = "root";
	$Password = "";
	$MY_DB = "webtrixpro";

	$con = mysqli_connect($HostName, $UserName, $Password);
	$sql1 = "CREATE DATABASE `$MY_DB`";
	mysqli_query($con, $sql1);
	$con = mysqli_connect($HostName, $UserName, $Password, $MY_DB);
	if(!$con)
    {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
	    DataBase Not-Connected -- You should check in C-Panel.
	    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	    </div>';
    }
?>