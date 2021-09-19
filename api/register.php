<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // validate the inputs

    $username = trim(htmlspecialchars($_POST["username"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $password=$_POST["password"];
    $hasedPassword=password_hash($password,PASSWORD_DEFAULT);
    $api_token=uniqid();
    $errors = [];
    // valdiate the user name
    if (!isset($username) and $username == "") :
        $errors[] = "username is rquired";
    elseif (!is_string($username)) :
         $errors[] = "username must be string";
    elseif (strlen($username) > 255) :
         $errors[] = "username must be less than 255 charcters";
    endif;
    // valdiate the email
    if (!isset($email) and $email == "") :
         $errors[] = "email is rquired";
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) :
         $errors[] = "email must be valid";
    elseif (strlen($email) > 255) :
         $errors[] = "email must be less than 255 charcters";
    endif;
    // validate password
    if (!isset($password) and $password == "") :
         $errors[] = "password is rquired";
    elseif (!is_string($password)) :
         $errors[] = "password must be string";
    elseif (strlen($password) > 100) :
         $errors[] = "password must be less than 100 charcters";
    endif;
    
    // if success
    if (empty($errors)) :
        $query = "INSERT INTO users (username,email,password,api_token) VALUES ('$username','$email','$hasedPassword','$api_token')";
        $result=mysqli_query($conn, $query);
        if($result):
            header("token:$api_token");
        $success = json_encode("the user created successfully");
        echo $success;
        else:
            errorRendring(500,"failed to signup");
        endif;
    else:
        $errorsJson = json_encode($errors);
        echo $errorsJson;
       
    endif;
else :
    errorRendring(405, "method not allowed");
endif;