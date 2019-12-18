<?php
require_once("header.php");

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = " SELECT users.*
                FROM users";
      
if($user_request = mysqli_query($conn, $user_query) ):
    while ($user_row = mysqli_fetch_array($user_request)) :

        if($user_row["role"] == 1){
            echo "super admin";

        } else {
            echo "regular user";
        }
?>


<div class="container">
    <ul>
        <li><?php echo $user_row["first_name"]; ?> was created <?=date("l", strtotime($user_row["date_created"]))?> and is a <?php echo $user_row["role"];?></li>
    </ul>
</div>

<?php

endwhile;

else :
    echo mysqli_error($conn);
endif;

require_once("footer.php");
?>