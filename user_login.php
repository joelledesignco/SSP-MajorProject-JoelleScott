<?php
require_once("header.php");
?>


<section>
    <div class="container">
        <?php
        echo '<div class="col-12">';
        if(isset($_SESSION["user_id"])) :
            $user_query = "SELECT * FROM users WHERE id = " . $_SESSION["$user_id"];
            if($user_request = mysqli_query($conn, $user_query) ) {
                while ($user_row = mysqli_fetch_array($user_request)) {
                    echo "<h2>Welcome Back " . $user_row["first_name"] ." ". $user_row["last_name"] . "</h2>";
                }
            }
        ?>
            <form action="/actions/login.php" method="post">
                <button type="submit" name="action" value="logout" class="btn btn-warning">Logout</button>
            </form>
        <?php
        else : 
        ?>

        <form action="/actions/login.php" method="post" class="col-6 mx-auto blurry-bg p-5 mt-5">
            <div class="row p-5 mx-auto">
                <div class="col">
                    <a href="/user_login.php" class="on px-4 login-link pb-2">Login</a>
                </div>
                <div class="col">
                    <a href="/signup.php" class="px-4 login-link pb-2">Signup</a>
                </div>  
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mt-5">
                <p>
                    <button type="submit" name="action" value="login" class="mybutton mx-auto">Login</button>
                </p>
            </div>
        </form>
        <?php
        endif;
        echo '</div>';
        ?>
    </div>
</section>

<?php

require_once("footer.php");

?>