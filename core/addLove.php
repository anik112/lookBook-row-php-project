<?php


require './database/dbConnect.php'; // require database connection
require './function/databaseFunction.php'; // require database function

// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;
$userName=(isset($_SESSION['name']))?$_SESSION['name']:null;


// if friend id exists and user id upto 0
// then get friend id and statement execute.
if(isset($_REQUEST['postId']) && $userId > 0 && $userName!=null){

    $postId=$_REQUEST['postId']; // get post id from url
    $location=$_REQUEST['loc']; // get page location from url
    $alreadyLike=false; // set already like this post
    $friendId=$_REQUEST['friendId']; // get friend id
    $notiContent='like'; // set notification content

    // get like information in this post
    $getLike=getDataUsingOrderAndId($connect,'likes',$postId,'post_id');

    // get single data from obj
    foreach($getLike as $like){
        // if current user already like this post
        if($like->user_id == $userId){
            $alreadyLike=true; // make true already like
        }
    }
    // check current already like this post if like then no execute code in this block
    if(!$alreadyLike){
        // add friend in friendList.
        $insertLike = $connect->prepare("INSERT INTO `likes` (`post_id`, `user_id`, `user_name`) 
        VALUES
        ($postId,$userId,'$userName');");
        $insertLike->execute() or die('Sorry data not insert.. Love'); // statement execute

        // add like notification
        $insertNotification = $connect->prepare("INSERT INTO `notification` (`friend_id`,`user_id`,`post_id`,`friend_name`,`content`) 
        VALUES
        ($userId,$friendId,$postId,'$userName','$notiContent');");
        $insertNotification->execute() or die('Sorry data not insert.. comment-notification'); // statement execute
    }

    // goto friends page
    header("Location: /$location");
}