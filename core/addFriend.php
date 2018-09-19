<?php 


require './database/dbConnect.php'; // require database function

// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;
$userName=(isset($_SESSION['name']))?$_SESSION['name']:null;
$content='friend_request';


// echo $userId;

// if friend id exists and user id upto 0
// then get friend id and statement execute.
if(isset($_REQUEST['friendId']) && $userId > 0 && $userName!=null){

    $friendId=$_REQUEST['friendId']; // get friend id from request url.
    $location=$_REQUEST['loc'];

    // add friend in friendList.
    $insertFriend = $connect->prepare("INSERT INTO `frendslist` (`user_id`, `friends_id`) 
    VALUES
    ($userId,$friendId);");
    $insertFriend->execute() or die('Sorry data not insert.. friend'); // statement execute

    // add notification in notification list.
    $insertNotification = $connect->prepare("INSERT INTO `notification` (`friend_id`,`user_id`,`friend_name`,`content`) 
    VALUES
    ($userId,$friendId,'$userName','$content');");
    $insertNotification->execute() or die('Sorry data not insert.. friend_request'); // statement execute

    // goto friends page
    header("Location: /$location");
}