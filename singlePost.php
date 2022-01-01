<?php include("./includes/classes/User.php") ?>
<?php include("./includes/classes/Post.php") ?>

<?php include("includes/header.php")?>

  <?php 
  $postId = $_GET['id'];
  $singlepost = mysqli_query($con, "SELECT * FROM posts WHERE id=$postId");
  $getSinglePostValue = mysqli_fetch_array($singlepost);
  $usernameforComment = $userQuery['name'];
  
  if(!empty($_POST['textbody'])){
    $post_body = $_POST['textbody'];
    $post_body = mysqli_escape_string($con,$post_body);
    $date_time_now = date('Y-m-d H:i:s');
    $insert_post = mysqli_query($con,"INSERT INTO comments VALUES('','$usernameforComment','$post_body','$date_time_now','$postId')");
  }
   //delete post 
   if(isset($_POST['deleteSubmit'])){
    $deletePost = mysqli_query($con, "DELETE  FROM posts WHERE id=$postId");
    header("Location:profilePage.php");
    exit();
  }
  ?>




    <main>
        <div class="container py-md-5">
           
        <div class="my-4">
            <img src="<?php echo $getSinglePostValue['img_file'] ?>"   class="post_img_equal" alt=""> 
            <div class="float-right d-none  d-lg-block">
            <?php include("includes/sidbar.php")?>
            </div>
            <div class="float-none"></div>
         </div>
         
         
        <div class="row">
            <div class="col-md-12">
              
                <h2 class="display-5"><?php echo $getSinglePostValue['title'] ?></h2>
                <form class='d-inline' action='editPost.php?id=<?php echo $postId;?>' method='post'>
                <button name="submit" class="btn btn-primary <?php if($userQuery['name'] != $getSinglePostValue['added_by']) echo 'd-none';   ?> ">
                  <?php if($userQuery['name'] == $getSinglePostValue['added_by']){ echo 'Edit Post';}   ?>
                </button>
                </form>
                
                <form class='d-inline' action='singlePost.php?id=<?php echo $postId;?>' method='post'>
                <button name="deleteSubmit" 
                class="btn btn-primary <?php if($userQuery['name'] != $getSinglePostValue['added_by']) echo 'd-none';?>"
                onclick='return checkDelete()'
                >
                  <?php if($userQuery['name'] == $getSinglePostValue['added_by']){ echo 'Delete Post';}   ?>
                </button>
                </form>
                
                <p class="text-primary ml-1 ">Posted on <?php echo $getSinglePostValue['date_creation']?></p>
                <p class="lead"><?php echo $getSinglePostValue['body'] ?></p>
            </div>
            
        </div>
        <hr>
        <div class="row">
            <h2 class="alert alert-info">Comments</h2>
            <div class="col-md-12">
              <?php
              $str = "";
               $data_query = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$postId' ORDER BY id DESC");
               if(mysqli_num_rows($data_query) === 0) { ?>
               <p class="alert alert-primary w-50">No comment Yet. Be the first One by submitting comment.</p>
               

                <?php }else{
                  while($row = mysqli_fetch_array($data_query)) {
                    $post_id = $row['post_id'];
                    $posted_by = $row['posted_by'];
                    $post_body = $row['post_body'];
                    $date_added = $row['date_added'];
                    
                    $str .= "<strong class='lead font-weight-bold'>$posted_by</strong>
                    <small>$date_added</small>
                    <br>
                    <p class='lead '>$post_body</p>
                    <hr>";
                  }
                  echo $str;
                } ?>
                 
               
              
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="<?php if($userQuery['paid']==='no'){ echo "paidAmout.php";}else{ echo "singlePost.php?id=$postId";}?>" 
                method="post">
                    <div class="form-group">
                      <label for="post-body" class="h5 lead text-info  mb-1 d-block">
                        Write your comment here
                      </label>
                      <textarea name="textbody" rows="4" cols="1"  class="form-control my-2" type="text" placeholder="Type your comment"></textarea>
                    </div>
                    <?php if($userQuery['paid'] ===  'no'){?>
                    
                    <script
                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="pk_test_51HhGcuIcgvz2PzTpXenxpxxL2UqPn8ankYA7Mt8KS3WXfy0GFd22DeegXdSyPtXWQFokHPktRzYHd1PKc2OoSvVZ00Ugct5EgT"
                    data-amount=<?php echo 200*10?>
                    data-name="<?php echo $userQuery['name']?>"
                    data-description="For comment you have to pay price."
                    data-image="<?php echo $userQuery['profile_pic'] ?>"
                    data-currency="usd"
                    data-locale="auto"
                    >
                    </script>
                    <?php }else{ ?>
                      <button class="btn btn-outline-dark" name="submit" type="submit">Submit</button>
                    <?php } ?>
                  </form>
            </div>
        </div>
    </main>
    <?php include("includes/footer.php");?>

    <script type='text/javascript'>
      function checkDelete(){
        return confirm('Are you sure you want to delete this post?')
      }
    </script>