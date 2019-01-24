<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $database = "solid";

    $connection_String = mysqli_connect($host,$user,$pass,$database);

    $clicked_on_username = $_COOKIE["default_clicked_on_username"];
    echo "$clicked_on_username";

    $sender = $_COOKIE["user_first_name"];
    $receiver =  $_COOKIE["default_clicked_on_username"];
    $chat_log_query ="UPDATE posts SET status = '1' WHERE msg_sender ='$receiver' and sender = '$sender' and receiver = '$receiver' ";
    $executing_chat_log_query = mysqli_query($connection_String,$chat_log_query);

?>
