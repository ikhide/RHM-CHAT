<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "solid";

    $connection_string = mysqli_connect($host,$user,$password,$database)or die(mysqli_error());
    $sender = $_COOKIE["user_first_name"];
    $receiver = $_COOKIE["default_clicked_on_username"];

    // delete chat
    if($_POST['key'] == "deleteChat"){
        $chatId = $_POST['id'];
        $get_files = "DELETE FROM posts WHERE id='$chatId' ";
        $execute_get_files = mysqli_query($connection_string,$get_files);
    }

    // count chat
    if($_POST['key'] == "countChat"){
        $chat_log_query = "SELECT COUNT(msg) FROM posts WHERE sender = '$sender' and receiver = '$receiver' ";
        $executing_chat_log_query = mysqli_query($connection_string,$chat_log_query);

        while($count = mysqli_fetch_array($executing_chat_log_query)){
            echo $count[0];
        }
    }

    // send chat message
    if($_POST['key'] == "sendMessage"){
        
        $msg = $_POST['msg'];
        
        $sql = "insert into posts(msg,msg_sender,sender,receiver) values('$msg','$sender','$sender','$receiver')";
        $run = mysqli_query($connection_string,$sql);
        
        $sql2 = "insert into posts(msg,msg_sender,sender,receiver) values('$msg','$sender','$receiver','$sender')";
        $run = mysqli_query($connection_string,$sql2);
    }

    // delete upload
    if($_POST['key'] == "deleteUpload"){
        
        $my_file = $_POST["file_name"];

        $get_files = "DELETE FROM private_uploads WHERE File='$my_file' ";
        $execute_get_files = mysqli_query($connection_string,$get_files);

        unlink('uploads/'.$my_file);
    }

?>
