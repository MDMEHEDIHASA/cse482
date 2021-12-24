<?php  
require('config/config.php');
require('includes/form_handler/register_handler.php');

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    <header class="bg-dark mb-5">
        <nav class="container navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand text-white my-1" href="#">Blog</a>            
        </nav>
    </header>
    <!-- main section -->
    <main>
        <div class="container py-md-5">
            <div class="row align-items-center">
                <div class="col-lg-7 py-3 py-md-5">
                    <h1 class="display-3">Remember Writing?</h1>
                    <p class="lead text-muted">Are you sick of short tweets and impersonal &ldquo;shared&rdquo; posts that are reminiscent of the late 90&rsquo;s email forwards? We believe getting back to actually writing is the key to enjoying the internet again.</p>
                </div>
                <div class="col-lg-5  pb-3 py-lg-5">
                    <form action="register.php" method="post">
                      <div class="form-group">
                        <label for="username-register" class="text-muted mb-1">
                          <small>Username</small>
                        </label>
                        <input id="name" name="name" class="form-control" type="text" placeholder="Pick a username" required 
                        value="<?php if(isset($_SESSION['name'])) {echo $_SESSION['name'];} ?>"
                        autocomplete="off" />
                        <?php if(in_array("Your  name must be between 3 and 25 characters<br>",$error_array)):  ?> <p class="alert alert-danger">Your  name must be between 3 and 25 characters</p> <?php endif; ?>
                      </div>    
                     <div class="form-group">
                        <label for="email-register" class="text-muted mb-1">
                          <small>Email</small>
                        </label>
                        <input id="email-register" name="email" class="form-control" type="text" placeholder="you@example.com" required
                        value="<?php if(isset($_SESSION['email'])) {echo $_SESSION['email'];} ?>"
                        autocomplete="off" />
                        <?php if(in_array("Email already in use<br>",$error_array)):  ?> <p class="alert alert-danger">Email already in use</p> <?php endif; ?>
                        <?php if(in_array("Invalid email format<br>",$error_array)):  ?> <p class="alert alert-danger">Invalid email format</p> <?php endif; ?>

                        </div>
                      <div class="form-group">
                        <label for="password-register" class="text-muted mb-1">
                          <small>Password</small>
                        </label>
                        <input id="password-register" name="password" class="form-control" type="password" required placeholder="Create a password" />
                        <?php if(in_array("Your password must be betwen 5 and 30 characters<br>",$error_array)):  ?> <p class="alert alert-danger">Your password must be betwen 5 and 30 characters</p> <?php endif; ?>
                        <?php if(in_array("Your password can only contain english characters or numbers<br>",$error_array)):  ?> <p class="alert alert-danger">Your password can only contain english characters or numbers</p> <?php endif; ?>
                      </div>
                      <div class="form-group">
                        <label for="password-register" class="text-muted mb-1">
                          <small>Confirm Password</small>
                        </label>
                        <input id="password-register" name="confirmpassword" class="form-control" type="password"  required placeholder="Confirm password" />
                        <?php if(in_array("Your passwords do not match<br>",$error_array)):  ?> <p class="alert alert-danger">Your passwords do not match</p> <?php endif; ?>
                      </div>
                      <button  name="submit" href="./login.html" type="submit" class="py-3 my-4 btn btn-lg btn-success btn-block">
                        Sign up for Happy Posting
                      </button>
                        <p class="lead text-muted mb-2" href="#">Aleready Have a Account?<a href="./login.php">Login here</a></p>
                         <?php if(in_array("You're all set! Goahead and login!<br>",$error_array)):  ?> 
                         <?php header("location: ./login.php");exit();?> <?php endif; ?>
                    </form>
                  </div>
            </div>
        </div>
        
    </main>
    <?php include('./includes/footer.php');?>