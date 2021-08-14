 <?php
//Incase table is not created then it will be created

//webtrixpro_users table

$Users_Table = "CREATE TABLE `webtrixpro_users`(`user_id` INT(99) NOT NULL AUTO_INCREMENT,
                                  `user_name` VARCHAR(100) NOT NULL,
                                  `user_company` VARCHAR(100) NOT NULL,
                                  `user_email` VARCHAR(100) NOT NULL,
                                  `user_password` VARCHAR(100) NOT NULL,
                                  `user_isAdmin` INT(50) NOT NULL,
                                  `user_profile` VARCHAR(255) NULL,
                                  `user_description` VARCHAR(999) NULL,
                                  PRIMARY KEY (`user_id`))";

$Table_Query = mysqli_query($con, $Users_Table);

if ($Table_Query) {
    $hash = "admin123";
    $hash = md5($hash);  //to encrypt password  
    $ADMIN_FIRST_INSERT = "INSERT INTO webtrixpro_users (`user_name`,`user_company`,`user_email`,`user_password`,`user_isAdmin`,`user_profile`) VALUES('Maham Hafeez','Webtrixpro','admin@gmail.com','$hash',1,'images/profile.jpg')";
    mysqli_query($con, $ADMIN_FIRST_INSERT);
}

//webtrixpro_projects table

$Projects_Table = "CREATE TABLE `webtrixpro_projects`(`project_id` INT(99) NOT NULL AUTO_INCREMENT,
                                  `project_name` VARCHAR(100) NOT NULL,
                                  `project_clientId` INT(100) NOT NULL,
                                  `project_platformId` INT(100) NOT NULL,
                                  `project_clientProfile` VARCHAR(100) NOT NULL,
                                  `project_date` VARCHAR(100) NOT NULL,
                                  `project_label` VARCHAR(100) NULL,
                                  `project_description` VARCHAR(999) NULL,
                                  PRIMARY KEY (`project_id`))";

mysqli_query($con, $Projects_Table);


//webtrixpro_platforms table

$Platforms_Table = "CREATE TABLE `webtrixpro_platforms`(`platform_id` INT(99) NOT NULL AUTO_INCREMENT,
                                  `web_platform` INT(100) NOT NULL,
                                  `andriod_platform` INT(100) NOT NULL,
                                  `ios_platform` INT(100) NOT NULL,
                                  PRIMARY KEY (`platform_id`))";
mysqli_query($con, $Platforms_Table);

//WebtrixPro_Updates Table

$Updates_table = "CREATE TABLE `webtrixpro_updates`(`update_id` INT(11) NOT NULL AUTO_INCREMENT,
                                  `project_id` INT(11) NOT NULL,
                                  `process_name` VARCHAR(500) NOT NULL,
                                  `process_description` VARCHAR(500) NOT NULL,
                                  `process_file` VARCHAR(500) NOT NULL,
                                  `process_title` VARCHAR(500) NOT NULL
                                  PRIMARY KEY (`update_id`))";
mysqli_query($con, $Updates_table);
?>