<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // validate the inputs
    $passwithouthashing=$_POST['password'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    $id=$_POST["id"];
    $errors=[];
    // valdiate the password
    if (empty($passwithouthashing)) :
        echo $passwithouthashing;
        $errors[] = "password is rquired";
    elseif (!is_string($password)) :
        $errors[] ="password must be string";
    elseif (strlen($password) > 100) :
        $errors[] ="password must be less than 100 charcters";
    endif;
    

    if (empty($errors)) :
        if(!empty($id)):
        $query = "UPDATE users SET password='$password' WHERE api_token='$id'";
        $result=mysqli_query($conn, $query);
        if($result):
            $success = json_encode("the password updated successfully");
            echo $success;
        else:
            errorRendring(500,"failed to update password");
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
