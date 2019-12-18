<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/conn.php");

session_start();
$errors = [];

//update user

if(isset($_POST["action"]) && $_POST["action"] == "update" ) :

    // echo '<pre>';
    // print_r($_POST);
    // print_r($_FILES);
    // exit;


    if( isset($_SESSION["user_id"]) && ($_SESSION["user_id"] == $_POST["user_id"] || $_SESSION["role"] == 1) ) {
        $user_id = $_POST["user_id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $city = $_POST["city"];
        $province_id = (isset($_POST["province_id"]) ) ? $_POST["province_id"] : 0;
        $profile_pic_id = NULL;
        $country = $_POST["country"];
        $bio = htmlspecialchars($_POST["bio"], ENT_QUOTES);

        //if profile pic is set and no errors
        if( isset($_FILES["profile_pic"]) && $_FILES["profile_pic"]["error"] == 0){
            if(
                ($_FILES["profile_pic"]["type"] == "image/jpeg" || 
                $_FILES["profile_pic"]["type"] == "image/jpg" ||
                $_FILES["profile_pic"]["type"] == "image/png") &&
                $_FILES["profile_pic"]["size"] < 20000000
            ) {
    
                $file_name = $_SERVER["DOCUMENT_ROOT"] . "/uploads/" . $_FILES["profile_pic"]["name"]; 
                if( !file_exists( $file_name)) {
                    if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $file_name)) {
                        $insert_image_query = "INSERT INTO images (url, owner_id) VALUES ('".str_replace($_SERVER["DOCUMENT_ROOT"], "", $file_name)."', $user_id)";
                        if( mysqli_query($conn, $insert_image_query)) {
                            $profile_pic_id = mysqli_insert_id($conn);
                        }
                    } 
                        
                } else {
                    $errors[] = "File already exists";
                }

            } else {
                $errors[] = "Incorrect File Type";
            }
        }

        if(($first_name == '' || $last_name == '') && !empty($errors)) {
            $errors[] = 'Fields cannot be empty';
        } else {

            $update_query = "UPDATE users 
                            SET first_name = '$first_name', 
                                last_name = '$last_name',
                                email = '$email',
                                city = '$city',
                                province_id = $province_id,
                                country = '$country',
                                bio = '$bio'";
            $update_query .=    ($profile_pic_id != NULL) ? ",profile_pic_id = $profile_pic_id" : "";
            $update_query .=    " WHERE id = $user_id";

            if(mysqli_query($conn, $update_query)) {
                $query = http_build_query( array("success" => array("Profile Update")) );
                header("Location: http://" . $_SERVER["SERVER_NAME"] . "/profile.php?user_id=" . $user_id . "&success=User+Updated" );
            } else {
                $errors[] = mysqli_error($conn);
            }
        }
        
    } else {
        $errors[] = "You do not have permission to do that.";
    }

elseif( isset($_POST["action"]) && $_POST["action"] == "delete") :
    $user_id = $_POST["user_id"];
    $delete_query = "DELETE FROM users WHERE id = $user_id";
    $select_query = "SELECT * FROM users WHERE id = $user_id";
    if($user_result = mysqli_query($conn, $select_query)) {
        while($user_row = mysqli_fetch_array($user_result)) {
            if($user_row["role"] != 1) {
                if(mysqli_query($conn, $delete_query)) {
                    if ($user_row["id"] == $_SESSION["user_id"]) {
                        session_destroy();
                        header("Location: http://" . $_SERVER["SERVER_NAME"]);
                    } else {
                        header("Location: http://" . $_SERVER["SERVER_NAME"] . "/members.php");
                    }
                    
                } else {
                    $errors[] = mysqli_error($conn);
                }
            } else {
                $errors[] = "Cannot Delete Super Admin";
            }
        }
    } else {
        $errors[] = "User does not exist:" . mysqli_error($conn);
    }
    
elseif( isset($_POST["action"]) && $_POST["action"] == "change_password") :
    $user_id = $_POST["user_id"];
    $current_password = md5($_POST["password"]);
    $new_password = md5($_POST["new_password"]);
    $new_password2 = md5($_POST["new_password2"]);
    $select_query = "   SELECT * FROM users 
                        WHERE id = $user_id AND password = '$current_password' ";
    $select_result = mysqli_query($conn, $select_query);
    if(mysqli_num_rows($select_result) > 0 ) {
        if($new_password == $new_password2){
            $update_query = "UPDATE users SET password = '$new_password' WHERE id = $user_id";
            if(mysqli_query($conn, $update_query)){
                header("Location: http://" . $_SERVER["SERVER_NAME"] . "/profile.php?success=Password+Reset");
            } else
                $errors[] = "Current password is incorrect" . mysqli_error($conn);
        } else {
            $errors[] = "New Passwords do not match";
        }
    } else {
        $errors[] = "Current password is incorrect" . mysqli_error($conn);
    }
endif;

if( !empty($errors) ) {
    $query = http_build_query( array("errors" => $errors) );
    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?user_id=" . $user_id . "&" . $query);
}

?>

