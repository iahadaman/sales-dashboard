 <?php
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();
include 'backend/connection.php';
include 'backend/database-tables.php';

// ADMIN LOGIN

if($_POST['type']==1)
{
	$user = htmlspecialchars(mysqli_real_escape_string($con, $_POST['login_email']));
	$pass = htmlspecialchars(mysqli_real_escape_string($con, $_POST['login_password']));
	$pass = md5($pass);
	$sql = "select * from webtrixpro_users where user_isAdmin != 1 and user_email = '$user' and user_password = '$pass'";
	$query = mysqli_query($con, $sql);
	if( mysqli_num_rows($query) )
	{
		while($client = mysqli_fetch_array($query)) {
			$_SESSION['client_name'] = $client['user_name'];
			$_SESSION['client_id'] = $client['user_id'];
		}		
	    // Login time is stored in a session variable
		$_SESSION["sales_login_time_stamp"] = time();
	    echo 1;
	}
	else
	{
	    echo 0;
	}
}


 // UPDATE USERS ACCOUNT

if($_POST['type']==2){
	  $clientName = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_name']));
	  $clientEmail = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_email']));
	  $clientPassword = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_password']));
  	  $old_image = htmlspecialchars(mysqli_real_escape_string($con, $_POST['client_OldProfile']));

  	    $client_id =  $_SESSION['client_id'];
 
		$datetime_variable = new DateTime();			 
		$datetime_variable = date_format($datetime_variable, 'Y-m-d H:i:s');
		$date = new DateTime();
		$date = date_format($date, 'ymd');

		if($_FILES['user_updateProfile']['name'] != '')
	    {
		    $filename = $_FILES['user_updateProfile']['name'];
		    $extension = pathinfo($filename, PATHINFO_EXTENSION);
		    $valid_extensions = array("jpg", "jpeg", "png", "PNG", "JPG");
		   if(in_array($extension, $valid_extensions)) {
				$new_name = rand() . $date .  "." . $extension;
				$update_filename = "images/" . htmlspecialchars( mysqli_real_escape_string($con, $new_name));
				move_uploaded_file($_FILES['user_updateProfile']['tmp_name'], $update_filename);
			}
			else {
				echo "Invalid Format";
			}
		}
		else{

			 $update_filename = $old_image;
		}

		$clientPassword = md5($clientPassword);  
		$updateUser =  "UPDATE `webtrixpro_users` SET `user_name`='$clientName', `user_email`='$clientEmail',`user_password`='$clientPassword',`user_profile`='$update_filename' WHERE user_id = '$client_id'";
        $query = mysqli_query($con, $updateUser);
		if($query) {
		  $_SESSION['client_name'] = $clientName;
		  echo 1;
		}
		else{
			echo 0;
		}		
		
}	

?>