<?php 
$image='';
if(isset($_SESSION['image'])){
    $image=$_SESSION['image']; // get current user image.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageName; ?></title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
    <link rel="stylesheet" href="../public/style-link-sec.css">
</head>
<body>

<header class=''>
<div class='row my-3 mx-3'>
<div class='col-lg-4 text-center px-5 py-3'>
    <h4><Strong>LookBook</Strong><small>    Connect with your friends</small></h4>
</div>

<div class='col-lg-5 text-right'>
    <form action="search" method="get" class='py-3'>
            <div class="input-group">
            <input type="text" name='searchContent' class="form-control" placeholder="Search friend by email, name, number...">
                <div class="input-group-btn">
                    <input type="submit" name='submit' value="Search" class='btn btn-primary' style='border-top-left-radius: 0px; border-bottom-left-radius: 0px;'>
                </div>
            </div>
        </form> 
</div>

<div class='col-lg-3 text-right nav-img'>
    <a href="logout" class='btn btn-outline-info'>Logout</a>
    <a href="" class='btn btn-outline-info'>About</a>
    <img src='<?php if($image != null){
                        echo $image;
                    }else{
                        echo './images/avatar.png';
                    }?>' class='nav-bar-img border border-info p-1 ml-3' alt="profile pic" srcset="">
</div>


<!-- <div class='col-lg-1 text-right'>
asd
</div> -->
</div>
</header>

<div class='row mx-3 border-top border-bottom' id='myHeader'>
    <div class='col-lg-12 text-center'>
        <ul class='my-1'>
            <li class='mx-3'><a href="deshbord" class='text-info'><strong>HOME</strong></a></li>
            <li class='mx-3'><a href="profile" class='text-info'><strong>PROFILE</strong></a></li>
            <li class='mx-3'><a href="pubFriends" class='text-info'><strong>FRIENDS</strong></a></li>
            <li class='mx-3'><a href="posts" class='text-info'><strong>CREATE POST</strong></a></li>
            <li class='mx-3'><button onclick="showNotifi('notification-model')" class='link-btn'><strong>NOTIFICATION</strong></button></li>
            <li class='mx-3'><a href="gallery" class='text-info'><strong>GALLERY</strong></a></li>
            <li class='mx-3'><a href="friends" class='text-info'><strong>MY FRIENDS</strong></a></li>
            <li class='mx-3'><a href="" class='text-info'><strong>ACTIVE</strong></a></li>
        </ul>
    </div>
</div>


<!-- -------------------- show notification page in popup ------------------- -->

<?php
// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// get friend id from friendlist table
$notifications=getDataUsingOrderAndId($connect,'notification',$userId,'user_id');
?>

<div id='notification-model' class='notification-model' style="display: none;">
<div class='container'>
    <div class='card'>
        <div class='card-header bg-primary'>
            <h4 class='float-left text-light'>Notification</h4>
            <button class='btn btn-outline-light float-right' onclick="closeNotifi('notification-model')">X</button>
        </div>
        <div class='card-body'>
            <?php foreach($notifications as $notification): // get all notificatiion from database.?>

            <div class='card my-2'>
                <h5 class='card-header bg-info text-light py-1'>
                <?php

                    $friendRequestContent=null; // declare msg variable
                    $commentContent=null; // declare msg variable
                    $likeContent=null; // declare msg variable

                    // check if notification is friend request then
                    if($notification->content == 'friend_request'){
                        echo "You have new friend is $notification->friend_name."; // set notificarion header
                        // set notification massage
                        $friendRequestContent="<strong>$notification->friend_name</strong> is uor new friend. See her profile and reach her post and comment her post.";
                    }
                    // other check notification is comment then
                    elseif($notification->content == 'comment'){
                        echo "You have new comment from $notification->friend_name."; // set notification header
                        // set notification massage
                        $commentContent="<strong>$notification->friend_name</strong> id comment in your photo. See this comment and give her comment reply.";
                    }
                    // otherwise notification is like then
                    else{
                        echo "$notification->friend_name Love in your post."; // set notification header
                        // set notification massage
                        $likeContent="<strong>$notification->friend_name</strong> is new love in your post. See her activity.";
                    }
                ?>
                </h5>
                <div class='card-body py-1'>
                <p class='text-info'>
                <?php
                    // check notification massage is empty are not?
                    if(!empty($friendRequestContent)){
                        // is not empty then show massage
                        echo "<a href='profile?id=$notification->friend_id'>$friendRequestContent</a>";
                    }
                    // check notification massage is empty are not?
                    elseif(!empty($commentContent)){
                        // is not empty then show massage
                        echo "<a href='profile#$notification->post_id'>$commentContent</a>";
                    }
                    // check notification massage is empty are not?
                    else{
                        // is not empty then show massage
                        echo "<a href='profile#$notification->post_id'>$likeContent</a>";
                    }
                ?>
                </p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
</div>

<!-- -------------------- end notification page in popup ------------------- -->