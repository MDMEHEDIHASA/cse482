
<?php 
include("./includes/header.php");
 include("./includes/classes/User.php");
include("./includes/classes/Post.php");



if(isset($_POST['submit'])){

  $uploadOk = 1;
	$imageName = $_FILES['fileToUpload']['name'];
	$errorMessage = "";

	if($imageName != "") {
		$targetDir = "assets/img/posts/";
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
		$post = new Post($con, $userLoggedIn);
		$post->submitPost($_POST['title'],$_POST['body'], $imageName,'none');
		header('Location:index.php');
		exit();
	}
	else {
		echo "<p style='text-align:center;' class='mx-auto w-50 alert alert-danger'>
				$errorMessage
			</p>";
	}

}

















?>

    <!-- main section -->
    <main>
        <div class="container  py-md-5">
          <img src="<?php echo $userQuery['profile_pic'] ?>" class="round_image" alt="">
          <h5 class="display-5 d-inline"><?php echo $userQuery['name'] ?></h5>
          <form action="createPost.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="post-title" class="text-muted mb-1">
                <small>Title</small>
              </label>
               <input type="text" name="title" class="form-control form-control-lg"  placeholder="">
            </div>
            <div class="form-group">
            
              <label for="fileToUpload">Choose Img</label>
              <input type="file" name="fileToUpload" class="form-control-file" id="fileToUpload">
            </div>
            <div class="form-group">
              <label for="post-body" class="text-muted mb-1 d-block">
                Body Content
              </label>
              <textarea name="body" rows="10" cols="2"  class="form-control" type="text"></textarea>
            </div>
            <button class="btn mb-2 btn-primary btn-lg" name="submit" type="submit">Save Post</button>
          </form>
          
          </div>
    </main>
    <?php include('./includes/footer.php');?>