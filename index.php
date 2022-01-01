
    <?php include("./includes/header.php") ?>
    <?php include("./includes/classes/User.php") ?>
    <?php include("./includes/classes/Post.php") ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">   
                <?php
                $post = new Post($con,$userLoggedIn);
                $post->loadPosts();
                ?>
            </div>
             
            <?php include("./includes/sidbar.php") ?>

            
            
           
        </div>
        <!-- /.row -->

        <hr>



    </div>
    

<?php include('./includes/footer.php');?>