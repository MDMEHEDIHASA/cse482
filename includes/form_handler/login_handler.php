<?php

//Declaring variables to prevent errors
$error_array = array();

if(isset($_POST['submit'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['email'] = $email; //Store email into session variable 
	$password = md5($_POST['password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$name = $row['name'];

		if(!empty($_POST['remember'])){
			setcookie("email",$_POST['email'],time()+(3600*24*7));
			setcookie("password",$_POST['password'],time()+(3600*24*7));
		}else{
			if(isset($_COOKIE["email"])){
				setcookie("email","");
			}
			if(isset($_COOKIE["password"])){
				setcookie("password","");
			}
		}
         
		$_SESSION['name'] = $name;
		header("Location:index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}
	

}

?>