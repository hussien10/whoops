<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method

if ($_SERVER["REQUEST_METHOD"] == "POST") :
    // validate the inputs
    $profile_pic=$_POST['profile_pic'];
    $id=$_POST["id"];
    
    if(isset($profile_pic)):
        $query = "UPDATE users SET profile_pic='$profile_pic' WHERE api_token='$id'";
        $result=mysqli_query($conn, $query);
        if($result):
            $success = json_encode("the profile pic updated successfully");
            echo $success;
        else:
            errorRendring(500,"failed to update profile pic");
        endif;
       
    endif;

else :
    errorRendring(405, "method not allowed");
endif;
