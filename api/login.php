<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // validate the inputs
    $email = trim(htmlspecialchars($_POST['email']));
    $password = $_POST['password'];
    // valdiate the email
    if (empty($email)) :
        $errors[] ="email is rquired";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
        $errors[] ="email must be valid";
    elseif (strlen($email) > 255) :
        $errors[] ="email must be less than 255 charcters";
    endif;

    // validate password
    if (empty($password)) :
        $errors[] ="password is rquired";
    elseif (!is_string($password)) :
        $errors[] ="password must be string";
    elseif (strlen($password) > 100) :
        $errors[] ="password must be less than 100 charcters";
    endif;

    // if success
    if (empty($errors)) :
        $query = "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==1):
            $user=mysqli_fetch_assoc($result);
            $islogin=password_verify($password,$user['password']);
            if($islogin):
                header("token:$user[api_token]");
                $msg="the user loged success";
                echo $msg;
            else:errorRendring(401, "credintials not correct");
            endif;
        else:errorRendring(401, "credintials not correct");

        endif;
    else:
        $errorsJson = json_encode($errors);
        echo $errorsJson;
    endif;
else :
    errorRendring(405, "method not allowed");
endif;
