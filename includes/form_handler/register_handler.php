<?php

//Declaring variables to prevent errors
$name = ""; //user name
$email = ""; //email
$password = ""; //password
$confirmpassword = ""; //password 2
$error_array = array(); //Holds error messages

if(isset($_POST['submit'])){

	//Registration form values

	//user name
	$name = strip_tags($_POST['name']); //Remove html tags
	$name = str_replace(' ', '', $name); //remove spaces
	$name = ucfirst(strtolower($name)); //Uppercase first letter
	$_SESSION['name'] = $name; //Stores first name into session variable
  

  //email
	$em = strip_tags($_POST['email']); //Remove html tags
	$em = str_replace(' ', '', $em); //remove spaces
	$_SESSION['email'] = $em; //Stores email into session variable

  	//Password
	$password = strip_tags($_POST['password']); //Remove html tags
	$password2 = strip_tags($_POST['confirmpassword']); //Remove html tags

 

  //validate email
  
  if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

    $em = filter_var($em, FILTER_VALIDATE_EMAIL);

    //Check if email already exists 
    $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

    //Count the number of rows returned
    $num_rows = mysqli_num_rows($e_check);

    if($num_rows > 0) {
      array_push($error_array, "Email already in use<br>");
    }

  }
  else {
    array_push($error_array, "Invalid email format<br>");
    
  }

  if(strlen($name) > 25 || strlen($name) < 3) {
		array_push($error_array, "Your  name must be between 3 and 25 characters<br>");
	}



	if($password != $password2) {
		array_push($error_array,  "Your passwords do not match<br>");
	}
	if(preg_match('/[^A-Za-z0-9]/', $password)) {
			array_push($error_array, "Your password can only contain english characters or numbers<br>");
	}

	if(strlen($password) > 30 || strlen($password) < 5) {
		array_push($error_array, "Your password must be betwen 5 and 30 characters<br>");
	}

  if(empty($error_array)) {
    $password = md5($password); //Encrypt password before sending to database

    //Generate username by concatenating first name and last name
    $username = strtolower($name);
    $check_username_query = mysqli_query($con, "SELECT name FROM users WHERE name='$username'");
    $i = 0; 
		//if username exists add number to username
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++; //Add 1 to i
			$username = $username . "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT name FROM users WHERE name='$username'");
		}
    //Profile picture 
		$rand = rand(1, 2); //Random number between 1 and 2

		if($rand == 1)
			$profile_pic = "assets/img/profile_pic/defaults/head_alizarin.png";
		else if($rand == 2)
			$profile_pic = "assets/img/profile_pic/defaults/head_amethyst.png";


		$query = mysqli_query($con, "INSERT INTO users VALUES ('','$username', '$em', '$password',  '$profile_pic','0','no')");
    
    array_push($error_array, "You're all set! Goahead and login!<br>");

    //Clear session variables 
		$_SESSION['name'] = "";
		$_SESSION['email'] = "";
        
  }

}

?>