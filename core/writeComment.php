<?php

require './database/dbConnect.php'; // require database function

// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;
// get user name from session
$userName=(isset($_SESSION['name']))?$_SESSION['name']:null;

if(isset($_POST['comment']) && $userId>0 && $userName!=null){

    $postId=$_POST['postId']; // get post id 
    $content=$_POST['comment']; // get comment
    $location=$_POST['loc']; // get seander page location

    // add comment in comments table.
    $insertComment = $connect->prepare("INSERT INTO `comments` (`post_id`, `user_id`,`user_name`,`content`) 
    VALUES
    ($postId,$userId,'$userName','$content');");
    $insertComment->execute() or die('Sorry data not insert.. comment'); // statement execute

    // goto friends page
    header("Location: /$location");

}
