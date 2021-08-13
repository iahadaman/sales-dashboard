 <?php
	$DB_HOST = "localhost";
	$DB_USER = "root";
	$DB_PASS = "";
	$DB_NAME = "webtrixpro";

	$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
	if($con === false)
    {
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>