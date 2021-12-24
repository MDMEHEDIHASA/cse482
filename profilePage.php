
<?php 
include("includes/header.php");
include("./includes/classes/User.php");
include("./includes/classes/Post.php");

if(isset($_GET['profile_name'])) {
	$username = $_GET['profile_name'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE name='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

}






if(isset($_POST['submit'])){

  $uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/img/profile_pic/";
		$imageName = $targetDir . uniqid() . basename($imageName);
		$imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

		if($_FILES['fileToUpload']['size'] > 10000000) {
			$errorMessage = "Sorry your file is too large";
			$uploadOk = 0;
		}

		if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg") {
			$errorMessage = "Sorry, only jpeg, jpg and png files are allowed";
			$uploadOk = 0;
		}

		if($uploadOk) {
			if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)) {
				//image uploaded okay
			}
			else {
				//image did not upload
				$uploadOk = 0;
			}
		}

	}

	if($uploadOk) {
		$userFile = new User($con, $userLoggedIn);
		$userFile->changeProfilePic($imageName);
	}
	else {
		echo "<p style='text-align:center;' class='mx-auto w-50 alert alert-danger'>
				$errorMessage
			</p>";
	}

}


?>

    <main>
        <div class="container py-md-5">
          <div class="row">
            <div class="col-md-6">
              <h3 class="display-3 lead mb-3">Posts</h3>
              <?php 
               if(!empty($username)){
                 $post = new Post($con,$username);
                 $post->singleUserPosts();
               }else{
                $post = new Post($con,$userQuery['name']);
                $post->singleUserPosts();
               }
              ?>
            </div>
            <div class="col-md-6 pl-5">
              <?php if(empty($username)){ ?>
              <p class="alert alert-danger">Name and email cannot be changed</p>
              <p class="alert alert-success">After Update Image you have to refresh skin.</p>
              <?php } ?>
                
             <?php if(!empty($username)){ ?>
              <p class="mb-2">
                <img class="round_image " src="./<?php echo $user_array['profile_pic']?>" />  <?php echo $user_array['name']?>
               </p>
               <br>
               <p class="alert alert-info">Total Post:<?php echo $user_array['num_posts'] ?></p>
               <form>
               <div class="form-group">
                        <label for="username-register" class="text-muted mb-1">
                          <small>Username</small>
                        </label>
                        <input id="name" name="name" class="form-control" type="text"  disabled
                        value="<?php echo $user_array['name'] ?>"
                        autocomplete="off" />
          
                 </div>  
                 <div class="form-group">
                        <label for="email-register" class="text-muted mb-1">
                          <small>Email</small>
                        </label>
                        <input id="email-register" name="email" class="form-control" type="text" disabled value="<?php echo $user_array["email"] ?>" />
                      </div>
                 </div>
              </form>
             <?php } else { ?>

              <p class="mb-2">
                <img class="round_image " src="./<?php echo $userQuery['profile_pic']?>" />  <?php echo $userQuery['name']?>
                <form action="profilePage.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                <label for="file">Update Img</label>
                <input type="file" name="fileToUpload" class="form-control-file" id="file">
                 <button  name="submit"  type="submit" class="mt-2 btn btn-small btn-primary">
                    Update
                  </button>
                </div>
                </form>
                
               </p>
               <br>
               <p class="alert alert-info">Total Post:<?php echo $userQuery['num_posts'] ?></p>
               <form>
               <div class="form-group">
                        <label for="username-register" class="text-muted mb-1">
                          <small>Username</small>
                        </label>
                        <input id="name" name="name" class="form-control" type="text"  disabled
                        value="<?php echo $userQuery['name'] ?>"
                        autocomplete="off" />
          
                 </div>  
                 <div class="form-group">
                        <label for="email-register" class="text-muted mb-1">
                          <small>Email</small>
                        </label>
                        <input id="email-register" name="email" class="form-control" type="text" disabled value="<?php echo $userQuery["email"] ?>" />
                      </div>
                 </div>
              </form>
            <?php } ?>
            
              
               
            </div>
          </div>
               
              
                
              
        
              
        </div>
    </main>
    <?php include("includes/footer.php");?>