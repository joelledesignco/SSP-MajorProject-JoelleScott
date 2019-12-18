<?php
require_once("header.php");


$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];
$user_query = "     SELECT users.* , images.url AS profile_pic
                    FROM users 
                    LEFT JOIN images 
                    ON users.profile_pic_id = images.id 
                    WHERE users.id = " . $user_id;

if($user_request = mysqli_query($conn, $user_query) ):
    while ($user_row = mysqli_fetch_array($user_request)) :
?>

<div class="container pt-5">
    <h1 class="mt-5 text-center">Edit <?php echo $user_row["first_name"]?>'s Profile</h1>
    <hr class="myhr mx-auto">
    <div class="row pt-5">
        <div class="col-9 blurry-bg mx-auto py-5">
            <form action="/actions/edit_user.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="<?=$user_id?>">
                <div class="form-row">
                    <div class="col-4 pink-bg2 text-white px-4">
                        <div class="my-5 pt-4">
                            <h5 class="text-center">Add Featured Image</h5>
                            <hr class="myhr2 mx-auto">     
                            <img src="<?php echo $user_row["profile_pic"]?>" alt="" class="w-100 my-2">
                            <input type="file" name="profile_pic" id="profile_pic" class="my-3 p-2" style="width: 100%;">
                        </div>
                    </div>
                    <div class="col-8 post-details">
                        <div class="form-group mt-4">
                        <?php
                        if($_SESSION["user_id"] ==$user_id || $_SESSION["role"] ==1):
                        ?>
                            <div class="text-right">
                                <a class="pw-link" href="/reset_password.php">Change Password</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" tabindex="1" name="first_name" class="form-control" value="<?php echo $user_row["first_name"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" tabindex="2" name="last_name" class="form-control" value="<?php echo $user_row["last_name"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" tabindex="1" name="email" class="form-control" value="<?php echo $user_row["email"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" tabindex="1" name="city" class="form-control" value="<?php echo $user_row["city"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="province">Province</label>
                            <select name="province_id" class="form-control">
                                <?php
                                $province_query = "SELECT * FROM provinces";
                                if($province_results = mysqli_query($conn, $province_query)) :
                                    echo "<option disabled ";
                                    if(!$user_row["province_id"]) echo "selected";
                                    echo ">Province</option>";
                                    while($province = mysqli_fetch_array($province_results)):
                                        ?>

                                        <option value="<?=$province["id"];?>" <?php 
                                            if($province["id"] == $user_row["province_id"]) echo " selected";
                                        ?>><?=$province["name"];?></option>
                
                                        <?php
                                    endwhile;
                                else:
                                    echo mysqli_error($conn);
                                endif;
                                ?>     

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" tabindex="1" name="country" class="form-control" value="<?php echo $user_row["country"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Bio</label>
                            <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="5" value="<?php echo $user_row["bio"]; ?>"></textarea>
                        </div>

                        <div class="form-row"> 
                            <div class="col mb-5">
                                <button type="submit" class="mybutton4 mx-auto" name="action" value="delete">Delete Account</button>
                            </div>
                            <div class="col mb-5">
                                <button type="submit" tabindex="3" class="mybutton mx-auto" name="action" value="update">Update Account</button>
                            </div>
                        <?php
                        endif;
                        ?>
                        </div>
                    </div>
                </div>
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