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
              <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
                </form>
                <a href="includes/handlers/logout.php" type="submit" class="ml-auto btn  btn-success">
                  Sign out
                </a>
            </div>           
      </nav>
    </header>