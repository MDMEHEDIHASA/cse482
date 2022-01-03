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





if(isset($_POST['chatSubmit'])){
  if(!empty($_POST['chatInput'])){
    
    $userChatName=$userQuery['name'];
    $message = strip_tags($_POST['chatInput']);
    $message = mysqli_escape_string($con,$message);
    
    $dateTime = date('H:i:s');
    $chatDB = mysqli_query($con, "INSERT INTO chat VALUES('','$message','$userChatName','$dateTime')");
    
    
  }
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
    <script type="text/javascript">
  function chatFunction(){
    const chatIcon = document.querySelector('.chat-wrapper');
    if (chatIcon.style.display === "none") {
    chatIcon.style.display = "inline-flex";
  } else {
    chatIcon.style.display = "none";
  }
    // console.log(chatIcon);
  }
</script>

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
             
              <form class="form-inline my-2 my-lg-0"   name="search_form">
              
               <input class="form-control mr-sm-2" type="text" id="search_text_input"  placeholder="Search People " aria-label="Search" autocomplete="off">

             
              </form>
              
              
              </div>
              <span class="text-white mr-2 px-2 header-chat-icon" onclick='return chatFunction()' title="Chat" data-toggle="tooltip" data-placement="bottom"><i class="fas fa-comment"></i></span>
                <img class="header_img"  src="<?php echo $userQuery['profile_pic'] ?>"></img>
                <a href="includes/handlers/logout.php" type="submit" class="ml-auto btn  btn-success">
                  Sign out
                </a>
            </div>           
      </nav>
      
    </header>
    <div id="search_results">
                
    </div>
<!-- chat feature begins -->
<div id="chat-wrapper" class="chat-wrapper  shadow border-top border-left border-right chat--visible">
    <div class="chat-title-bar">Chat</div>
    <div id="chat" class="chat-log">
      <?php
         
         $chatAll = mysqli_query($con,"SELECT * from chat");
          if(mysqli_num_rows($chatAll) > 0) {
            while($row = mysqli_fetch_array($chatAll)) {
              $chatMessageShow = $row['message'];
              $chatMessageUserName = $row['submitted_by']; 
              $chatTime = $row['time'];
              ?>
              
      <?php 
      if($userQuery['name'] == $chatMessageUserName){?>
      <div class="chat-self">
        <div class="chat-message">
          
          <div class="chat-message-inner">
            <?php echo $chatMessageShow;?>
            
          </div>
        </div>
        <img class="chat-avatar avatar-tiny" src="<?php echo $userQuery['profile_pic'];?>">
      </div>
      <?php }?>
      
    
      <?php 
      if($userQuery['name'] != $chatMessageUserName){?>
      <div class="chat-other">
        <a href="#" class="chat-with-other">
        <div class="chat-message"><div class="chat-message-inner">
          <a  href="<?php echo $chatMessageUserName?>"><strong class='text-info'><?php echo $chatMessageUserName;?></strong></a>
          <?php echo $chatMessageShow; ?>
        </div></div>
      </div>
      <?php }?>
      
      





            <?php }
          }
          
      ?>
      
      
    </div>
    
    <form id="chatForm" action='index.php'  class="chat-form border-top" method='post'>
      <input type="text" class="chat-field" name="chatInput" id="chatField" placeholder="Type a message…" autocomplete="off">
      <button type='submit' name='chatSubmit' class='d-inline'><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </form>
  </div>
  <!-- chat feature ends -->