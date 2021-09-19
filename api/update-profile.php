<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // validate the inputs
    $username = trim(htmlspecialchars($_POST['username']));
    $email = trim(htmlspecialchars($_POST['email']));
    $id=$_POST["id"];
    $errors=[];
    // valdiate the user name
    if (empty($username)) :
        $errors[] = "username is rquired";
    elseif (!is_string($username)) :
        $errors[] ="username must be string";
    elseif (strlen($username) > 255) :
        $errors[] ="username must be less than 255 charcters";
    endif;
    // valdiate the email
    if (empty($email)) :
        $errors[] ="email is rquired";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $errors[] ="email must be valid";
    elseif (strlen($email) > 255) :
        $errors[] ="email must be less than 255 charcters";
    endif;

    if (empty($errors)) :
        if(!empty($id)):
            $query = "UPDATE users SET username='$username',email='$email' WHERE api_token='$id'";
        $result=mysqli_query($conn, $query);
        if($result):
            $success = json_encode("the user updated successfully");
            echo $success;
        else:
            errorRendring(500,"failed to update profile data");
        endif;
    else:
        errorRendring(404,"user not found");
        endif;
    else:
        $errorsJson = json_encode($errors);
        echo $errorsJson;
       
    endif;

else :
    errorRendring(405, "method not allowed");
endif;
