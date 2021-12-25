<?php
require('config/config.php');
require('includes/form_handler/login_handler.php');
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <header class="bg-dark mb-5">
        <nav class="container navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand text-white my-1" href="#">Blog</a>            
        </nav>
    </header>
    <main>
        <div class="container py-md-5">
            <form action="login.php"  class="w-50 mx-auto" method="post">
            <?php if(in_array("Email or password was incorrect<br>",$error_array)):  ?> <p class="alert alert-danger">Email or password was incorrect</p> <?php endif; ?>
                    <div class="form-group">
                        <label for="email-register" class="text-muted mb-1">
                          <small>Email</small>
                        </label>
                        <input id="email-register" name="email" class="form-control" type="text" placeholder="you@example.com" autocomplete="off"
                        value="<?php if(isset($_COOKIE["email"])){ echo $_COOKIE["email"];} ?>" 
                        />
                      </div>
                      <div class="form-group">
                        <label for="password-register" class="text-muted mb-1">
                          <small>Password</small>
                        </label>
                        <input id="password-register" name="password" class="form-control" type="password" placeholder="Type your password" 
                        value="<?php if(isset($_COOKIE["password"])){ echo $_COOKIE["password"];} ?>"
                        />
                      </div>
                      <div class="form-group">
                        <input type="checkbox" name="remember" <?php if(isset($_COOKIE["email"])){ echo 'checked';} ?>/>
                        <label for="remember-me">Remember Me</label>
                      </div>
                      <button name="submit" type="submit" class="py-3 my-4 btn btn-lg btn-success btn-block">
                        Sign In
                      </button>
                      <p class="lead text-muted mb-2" >Don't Have a Account?<a href="./register.php">Register here</a></p>
            </form>
        </div>
    </main>
   <?php include('./includes/footer.php');?>