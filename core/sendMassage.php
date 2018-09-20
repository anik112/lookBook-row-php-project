<?php

// call database connection function
require './database/dbConnect.php';


// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;
// get user name from session
$userName=(isset($_SESSION['name']))?$_SESSION['name']:null;

if(isset($_POST['submit']) && $userId>0 && $userName!=null){

    $friendId=$_POST['friendId'];
    $massage=$_POST['massage'];

    // add comment in comments table.
    $insertMassage = $connect->prepare("INSERT INTO `massage`(`user_id`, `friends_id`,`friends_name`, `massage_date`, `massage_time`, `massage`)
    VALUES 
    ($friendId,$userId,'$userName',CURDATE(),CURTIME(),'$massage');");
    $insertMassage->execute() or die('Sorry data not insert.. massage'); // statement execute


}