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
            <li class='mx-3'><a href="notification" class='text-info'><strong>NOTIFICATION</strong></a></li>
            <li class='mx-3'><a href="gallery" class='text-info'><strong>GALLERY</strong></a></li>
            <li class='mx-3'><a href="friends" class='text-info'><strong>MY FRIENDS</strong></a></li>
        </ul>
    </div>
</div>