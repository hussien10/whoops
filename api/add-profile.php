<?php
// open connection
require("includes/connect.php");
require_once("includes/functions.php");
// check the request method
if ($_SERVER["REQUEST_METHOD"] == "POST") :

    $profilePic = $_POST["profile_pic"];
    $id = $_POST["api_token"];
    if (!empty($profilePic)) :
        $query = "UPDATE users SET profile_pic='$profilePic' WHERE api_token='$id'";
        $result = mysqli_query($conn, $query);
        if ($result) :
            $success = json_encode("the pic added successfully");
            echo $success;
        else:
            errorRendring(500,"failed to add pic");
        endif;

    endif;
else :
    errorRendring(405, "method not allowed");
endif;
