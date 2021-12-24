<?php
class User {
	private $user;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE name='$user'");
		$this->user = mysqli_fetch_array($user_details_query);
	}

	public function getUsername() {
		return $this->user['name'];
	}

	public function getNumPosts() {
		$username = $this->user['name'];
		$query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE name='$username'");
		$row = mysqli_fetch_array($query);
		return $row['num_posts'];
	}
	public function changeProfilePic($img){
		$username = $this->user['name'];
		// $imgName = $this->user['img'];
		$query = mysqli_query($this->con, "UPDATE users SET profile_pic='$img' WHERE name='$username'");
	}


}

?>