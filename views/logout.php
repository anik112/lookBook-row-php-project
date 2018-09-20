<?php 

// requier database connection file
require './database/dbConnect.php';
// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// if session id exists then update active satatus
if($userId>0){
    // update active status in database
    $updateActiveStatus = $connect->prepare("UPDATE `active_status` SET 
    `last_activity_date`=CURDATE(),
    `last_activity_time`=CURTIME(),
    `login_status`=false
    WHERE user_id=$userId");
    $updateActiveStatus->execute() or die('Sorry data not insert.. ative status update'); // statement execute
}



// remove all session variables
session_unset();

// destroy the session
session_destroy(); 


header("Location: /login"); // set url in go to deshbord.


?>