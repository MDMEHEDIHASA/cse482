
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
                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>
                

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <!-- <footer class="border-top text-center small text-muted py-3">
            <p class="m-0">Copyright &copy; 2021 <a href="/" class="text-muted">Blog</a>. All rights reserved.</p>
        </footer> -->

    </div>
    

<!-- 
</body>

</html> -->
<?php include('./includes/footer.php');?>