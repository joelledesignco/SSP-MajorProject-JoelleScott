<?php
require_once("header.php");


$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = "SELECT * FROM users WHERE id = " . $user_id;
if($user_request = mysqli_query($conn, $user_query) ):
    while ($user_row = mysqli_fetch_array($user_request)) :

?>
            
<div class="container">
    <div class="row">
        <div class="col-8 mx-auto blurry-bg">
            <h2 class="m-5 pt-5">Update <?php echo $user_row["first_name"]?>'s Password</h2>
            <hr class="myhr">
            <form action="/actions/edit_user.php" method="post" class="mx-auto p-5">
                <?php
                include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                ?>
                <div class="form-group">
                    <label for="password">Current Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="hidden" name="user_id" value="<?php echo $user_row["id"] ?>"> 
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="new_password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" name="new_password2" class="form-control">
                </div>
                
                <?php
                if($_SESSION["user_id"] ==$user_id || $_SESSION["role"] ==1):
                    ?>
                    <div class="form-group mb-5">
                        <a onclick="history.go(-1);" href="#" class="text-link">X</a>
                        <button type="submit" tabindex="3" class="mybutton mx-auto" name="action" value="change_password">Update Password</button>
                    </div>
                    <?php
                endif;
                ?>
            </form>
        </div>
    </div>
</div>

<?php
    
    endwhile;

else :
    echo mysqli_error($conn);
endif;

require_once("footer.php");
?>