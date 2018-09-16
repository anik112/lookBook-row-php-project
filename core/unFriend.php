<?php 

require './database/dbConnect.php'; // require database function


// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// check request id is aviable and user id upto 0
if(isset($_REQUEST['friendId']) && $userId>0){

    $friendId=$_REQUEST['friendId']; // get friend id from url
    $location=$_REQUEST['loc']; // get sender location

    // prepare statement for delete data using friend id and user id
    $getData = $connect->prepare("DELETE FROM `frendslist` WHERE user_id=$userId && friends_id=$friendId;");
    $getData->execute() or die('Data not delete, please check data and connection.'); // data execute

    // echo 'data delete';

    // goto sender page
    header("Location: /$location");
}