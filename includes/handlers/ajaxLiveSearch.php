<?php


$con2 = mysqli_connect("localhost", "root", "", "cse482"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}



// include("../../includes/classes/User.php");

$query = $_POST['search'];
//$userLoggedIn = $_POST['userLoggedIn'];

// $names = explode(" ", $query);

//If query contains an underscore, assume user is searching for usernames
// if(strpos($query, '_') !== false) 
	$usersReturnedQuery = mysqli_query($con2, "SELECT * FROM users WHERE name LIKE '%{$query}%'  LIMIT 10");
    // echo print_r($usersReturnedQuery);

if($query != ""){

	while($row = mysqli_fetch_array($usersReturnedQuery)) {
		//$user = new User($con, $userLoggedIn);

		// if($row['username'] != $userLoggedIn)
		// 	$mutual_friends = $user->getMutualFriends($row['username']) . " friends in common";
		// else 
		// 	$mutual_friends == "";

		echo "<div class='my-3'>
				<a href='" . $row['name'] . "' style='color: #1485BD'>
					<div class='liveSearchProfilePic'>
						<img class='round_image mr-2' src='" . $row['profile_pic'] ."'>
						<p class='d-inline'>".$row['name']."</p>
					</div>
					
				</a>
				</div>";

	}

}

?>