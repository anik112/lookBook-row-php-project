<?php

require './database/dbConnect.php'; // require database connection
require './function/databaseFunction.php'; // require database function

// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// get friend id from friendlist table
$notifications=getDataUsingColNameAndId($connect,'notification',$userId,'user_id');

$pageName='Notification';
require 'header.php'; // call hearder part.
?>

<?php foreach($notifications as $notification):?>
<div class='card'>
    <h5 class='card-header'>
    <?php
    if($notification->content == 'friend_request'){
        echo "You have new friend is $notification->friend_name.";
    }elseif($notification->content == 'comment'){
        echo "You have new comment from $notification->friend_name.";
    }else{
        echo "$notification->friend_name Love in your post.";
    }
    ?>
    </h5>
    <div class='card-body'></div>
</div>
<?php endforeach;?>

<?php require 'footer.php';// call footer part. ?>