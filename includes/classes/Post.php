<?php
class Post {
	private $user_obj;
	private $con;

	public function __construct($con, $user){
		$this->con = $con;
		$this->user_obj = new User($con, $user);
	}

	public function submitPost($title,$body,$img, $user_to) {
        $title = strip_tags($title);
        $title = mysqli_real_escape_string($this->con, $title);
		$check_empty_title = preg_replace('/\s+/', '', $title); //Deltes all spaces 

		$body = strip_tags($body); //removes html tags 
		$body = mysqli_real_escape_string($this->con, $body);
		$check_empty = preg_replace('/\s+/', '', $body); //Deltes all spaces 
      
		if($check_empty != "" && $check_empty_title != "") {


			//Current date and time
			$date_added = date("Y-m-d H:i:s");
			//Get username
			$added_by = $this->user_obj->getUsername();

			//If user is on own profile, user_to is 'none'
			// if($user_to == $added_by) {
			// 	$user_to = "none";
			// }

			//insert post 
			$query = mysqli_query($this->con, "INSERT INTO posts (id,title,body,img_file,date_creation,like_post,added_by,deleted) VALUES('','$title', '$body','$img','$date_added','0','$added_by','no')");
			$returned_id = mysqli_insert_id($this->con);

			//Insert notification 

			//Update post count for user 
			$num_posts = $this->user_obj->getNumPosts();
			$num_posts++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_posts='$num_posts' WHERE name='$added_by'");

		}
	}
    

    public function loadPosts() {

		// $page = $data['page']; 
		$userLoggedIn = $this->user_obj->getUsername();

		// if($page == 1) 
		// 	$start = 0;
		// else 
		// 	$start = ($page - 1) * $limit;

        
		$str = ""; //String to return 
		$data_query = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

		if(mysqli_num_rows($data_query) > 0) {


			$num_iterations = 0; //Number of results checked (not necasserily posted)
			$count = 1;

			while($row = mysqli_fetch_array($data_query)) {
				$id = $row['id'];
				$title = $row['title'];
				$body = $row['body'];
				$img_file = $row['img_file'];
				$date_time	= $row['date_creation'];
				$added_by = $row['added_by'];

					$user_details_query = mysqli_query($this->con, "SELECT name,profile_pic FROM users WHERE name='$added_by'");
					$user_row = mysqli_fetch_array($user_details_query);
					$name = $user_row['name'];
					$profile_pic = $user_row['profile_pic'];


					//Timeframe
					$date_time_now = date("Y-m-d H:i:s");
					$start_date = new DateTime($date_time); //Time of post
					$end_date = new DateTime($date_time_now); //Current time
					$interval = $start_date->diff($end_date); //Difference between dates 
					if($interval->y >= 1) {
						if($interval == 1)
							$time_message = $interval->y . " year ago"; //1 year ago
						else 
							$time_message = $interval->y . " years ago"; //1+ year ago
					}
					else if ($interval-> m >= 1) {
						if($interval->d == 0) {
							$days = " ago";
						}
						else if($interval->d == 1) {
							$days = $interval->d . " day ago";
						}
						else {
							$days = $interval->d . " days ago";
						}


						if($interval->m == 1) {
							$time_message = $interval->m . " month". $days;
						}
						else {
							$time_message = $interval->m . " months". $days;
						}

					}
					else if($interval->d >= 1) {
						if($interval->d == 1) {
							$time_message = "Yesterday";
						}
						else {
							$time_message = $interval->d . " days ago";
						}
					}
					else if($interval->h >= 1) {
						if($interval->h == 1) {
							$time_message = $interval->h . " hour ago";
						}
						else {
							$time_message = $interval->h . " hours ago";
						}
					}
					else if($interval->i >= 1) {
						if($interval->i == 1) {
							$time_message = $interval->i . " minute ago";
						}
						else {
							$time_message = $interval->i . " minutes ago";
						}
					}
					else {
						if($interval->s < 30) {
							$time_message = "Just now";
						}
						else {
							$time_message = $interval->s . " seconds ago";
						}
					}

				



					$str.=	"<div class='py-5'>
					         <h2>
							<a><img class='round_image mr-2' src='$profile_pic'></img>$title</a>
						</h2>
						<p class='lead'>
							by <a href='$added_by'>$added_by</a>
						</p>
						<p><span class='glyphicon glyphicon-time'></span> Posted on $time_message</p>
						<hr>
						<img class='post_img_equal' src='$img_file' alt=''>
						<hr>
						<p>$body</p>
						<a class='btn btn-primary' href='singlePost.php?id=$id'>Read More</a>
						</div>";
				

			} //End while loop

			// if($count > $limit) 
			// 	$str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
			// 				<input type='hidden' class='noMorePosts' value='false'>";
			// else 
			// 	$str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align: centre;'> No more posts to show! </p>";
		}

		echo $str;


	}


	public function singleUserPosts(){
		$userLoggedIn = $this->user_obj->getUsername();

		  $str = "";
		$posts_details_query = mysqli_query($this->con,"SELECT * FROM posts WHERE added_by='$userLoggedIn'");
         if(mysqli_num_rows($posts_details_query)>0){
           while($row = mysqli_fetch_array($posts_details_query)) {
                $id = $row['id'];
				$title = $row['title'];
				$body = $row['body'];
				$img_file = $row['img_file'];
				$date_time	= $row['date_creation'];
				$added_by = $row['added_by'];


				

                $str.=	"<div id='accordion'>
				<div class='card mb-1'>
					<div class='card-header' id='heading$id'>
						<h5 class='mb-0'>
							<a href='singlePost.php?id=$id' class='btn btn-link'>
								$title
							</a>
						</h5>
					</div>
					
				</div>                    
			</div>";
            }

		echo $str;
	}
	}



}

?>