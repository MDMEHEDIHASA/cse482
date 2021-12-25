<?php
require('config/config.php');
// session_destroy();

if(isset($_SESSION['name'])){
    $userLoggedIn = $_SESSION['name'];
    $user_name_query = mysqli_query($con, "SELECT * FROM users where  name ='$userLoggedIn' ");
    $userQuery = mysqli_fetch_array($user_name_query);
}else{
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogging Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- <script src="../../assets/js/demo.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js" integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/substyle.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<header class="bg-dark mb-3">
        <nav class="container navbar navbar-expand-lg navbar-dark bg-dark">
          <a class="navbar-brand text-white my-1" href="./index.php">Blog</a> 
          <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse text-white navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav text-white mr-auto">
                  <li class="nav-item">
                      <a class="nav-link text-white" href="./profilePage.php">Profile</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white" href="./createPost.php">Create Post</a>
                  </li>
              </ul>
              <div class="search">
              <!-- <a href="search-visible.php" class="text-white mr-2 header-search-icon" title="Search" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-search"></i></a> -->
              <form class="form-inline my-2 my-lg-0"   name="search_form">
              
               <input class="form-control mr-sm-2" type="text" id="search_text_input"  placeholder="Search People " aria-label="Search" autocomplete="off">

              <!-- <button name="button_holder" class="btn btn-success button_holder my-2 my-sm-0" type="submit">Search</button> -->
              </form>
              
              <!-- <div class="search_results_footer_empty">
              </div> -->
              </div>
              
                <!-- <a class="nav-link text-white"><?php echo $userQuery['name'] ?></a> -->
                <a href="includes/handlers/logout.php" type="submit" class="ml-auto btn  btn-success">
                  Sign out
                </a>
            </div>           
      </nav>
      
    </header>
    <div id="search_results" style="margin:0 600px; position:relative;left:114px">
                
    </div>
