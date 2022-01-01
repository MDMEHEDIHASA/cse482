<?php


$con2 = mysqli_connect("localhost", "root", "", "cse482"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}




$query = $_POST['search'];

	$usersReturnedQuery = mysqli_query($con2, "SELECT * FROM users WHERE name LIKE '%{$query}%'  LIMIT 10");

if($query != ""){

	while($row = mysqli_fetch_array($usersReturnedQuery)) {

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