<?php
require_once("conn.php");

?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="/css/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <title>Hello, world!</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-white"><i class="fas fa-bars"></i></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0 mx-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/hikes.php">Hikes</a>
                    </li>
                    <li class="main-logo-center">
                        <a class="navbar-brand" href="http://<?php echo $_SERVER['SERVER_NAME'];?>">
                            <img id="main-logo" src="/images/logo-white.png" alt="">
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="/articles.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact.php">Contact</a>
                    </li> 
                </ul>
            </div>
        </div>

        <?php
        if(isset($_SESSION["user_id"])) :  //Check if user is logged in
        ?>
        <ul>
            <li class="nav-item dropdown" style="list-style: none">
                <a class="p-5" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none">
                    <i class="fas fa-user-circle" id="user-circle"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/profile.php">My Profile</a>
                    <a class="dropdown-item" href="#my-blog">My Posts</a>
                    <a class="dropdown-item" href="/add_post.php">Add Post</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/actions/login.php?action=logout">Logout</a>
                </div>
            </li>
        </ul>

        <?php
        else:  //if user is not logged in
        ?> 

        <a href="/user_login.php">
            <button id="login-btn" type="submit" name="action" value="signup" class="mybutton">Login</button>
        </a>

        <?php
        endif;
        ?>

    </nav>

