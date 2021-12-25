<?php include("includes/header.php")?>


<?php
$postId = $_GET['id'];
$editPost = mysqli_query($con, "SELECT * FROM posts WHERE id=$postId");
$editPostValue = mysqli_fetch_array($editPost);
$editPostValueTitle = $editPostValue['title'];
$editPostValueBody = $editPostValue['body'];

if(isset($_POST['submit'])){
    if(!empty($_POST['title']) && !empty($_POST['body'])){
        $title = $_POST['title'];
        $body = $_POST['body'];
    }
    
    if(!empty($title) && !empty($body)){
        if(($title != $editPostValue['title']) && ($body != $editPostValue['body'])){
            $update_query = mysqli_query($con, "UPDATE posts SET title='$title',body='$body' WHERE id='$postId'");
            header("Location:singlePost.php?id=$postId");

        }else{
           echo '<script>
              alert("Nothing to Change");
           </script>'; 
        }
    }
}


?>


<main>
<div class="container py-md-5 container--narrow">

 <a class="btn btn-dark btn-log" href="singlePost.php?id=<?php echo $postId;?>">Back to post previous page</a>
    <form class="mt-3" action="editPost.php?id=<?php echo $postId?>" method="post">
      <div class="form-group">
        <label for="post-title" class="text-muted mb-1"><small>Title</small></label>
        <input required name="title" value="<?php echo $editPostValue['title']; ?>" id="post-title" class="form-control form-control-lg form-control-title" type="text" placeholder="" autocomplete="off">
      </div>

      <div class="form-group">
        <label for="post-body" class="text-muted mb-1"><small>Body Content</small></label>
        <textarea required rows="10" cols="2"  name="body" id="post-body" class="body-content tall-textarea form-control" type="text"><?php echo $editPostValue['body']; ?> </textarea>
      </div>
      

      <button name='submit' class="btn btn-primary">Save Updates</button>
    </form>
  </div>
</main>

<?php include("includes/footer.php");?>