<?php

require_once( $_SERVER["DOCUMENT_ROOT"] . "/conn.php");

$errors = [];

//if the button action was login
if( isset($_POST["action"]) && $_POST["action"] == "login" ) :
    //get users email & password
    //connect to users table
    //check if user exists and password matches
    //if not send error
    //if correct, login and go to index

    if( 
        (isset($_POST["email"]) && $_POST["email"] != "" ) &&
        (isset($_POST["password"]) && $_POST["password"] != "" )
    ){
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $query_users = "SELECT * 
                        FROM users 
                        WHERE email = '".$email."' AND password = '".$password."' 
                        LIMIT 1";

        $user_result = mysqli_query($conn, $query_users);
        if( mysqli_num_rows($user_result) > 0 ) {
            //user found

            //Get all users rows from the database
            while($user = mysqli_fetch_array($user_result)){
                session_destroy(); //destroy current session
                session_start(); //start fresh session

                $_SESSION["email"] = $user["email"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"];

                header("Location: http://" . $_SERVER["SERVER_NAME"] );

            }
            
        } else {
            $errors[] = "Incorrect Email or Password";
        }

    } else {
        $errors[] = "Please Fill Out Username & Password";
    }


    //if action is signup
elseif( isset($_POST["action"]) && $_POST["action"] == "signup" ) :

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $password2 = md5($_POST["password2"]);
    $city = $_POST["city"];
    $province_id = ( isset($_POST["province"]) ) ? $_POST["province"] : 0;
    $agree_terms = $_POST["agree_terms"];
    $date_created = date("Y-m-d H:i:s");

    if($password == $password2 && strlen($password) > 7){
        if( isset($_POST["agree_terms"]) ) {
            if($email != "" && $first_name != "" && $last_name != ""){

                $new_user_query = "INSERT INTO users (  email, 
                                                        password, 
                                                        role, 
                                                        first_name, 
                                                        last_name,
                                                        province_id,
                                                        city,
                                                        date_created) 

                                            VALUES (    '$email', 
                                                        '$password', 
                                                        2, 
                                                        '$first_name', 
                                                        '$last_name',
                                                        $province_id,
                                                        '$city',
                                                        '$date_created'
                                                        )";
                
                if( !mysqli_query($conn, $new_user_query) ) {
                    echo mysqli_error($conn);
                } else { //log user in and go to home page
                    $user_id = mysqli_insert_id($conn);

                    session_destroy();
                    session_start();

                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["role"] = 2;
                    $_SESSION["email"] = $email;

                    header("Location: http://". $_SERVER["SERVER_NAME"]);
                   
                }

            } else {
                $errors[] = "Please fill out the required fields";
            }

        } else {
            $errors[] = "You must agree to our terms";
        }
    } else {
        $errors[] = "Passwords do not match";
    }

    //if logout button clicked
elseif( isset($_REQUEST["action"]) && $_REQUEST["action"] == "logout" ) :
    session_destroy();
    header("Location: http://" . $_SERVER["SERVER_NAME"]);
endif;

if( !empty($errors) ) {
    $query = http_build_query( array("errors" => $errors) );
    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?" . $query);
}
?>


