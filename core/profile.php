<?php

require './database/dbConnect.php';
// require databaseFunction.php page
require './function/databaseFunction.php';


// declare variable for contain data
$id=0;
$sur_name=null;
$nik_name=null;
$mobile=null; 
$email=null;
$birthday=null;
$gender=null;
$current_city=null;
$home_town=null;
$interested_in=null;
$languages=null;
$relationship=null;
$about_you=null;
$user_image=null;
$user_name=null;
$password=null;
$posts=null;

// get user data from database
$getUserData=getAllDataFromTableUsingId($connect,'users',$userId);

// discribe array object 
foreach($getUserData as $user){
    // set data in variable
    $id=$user->id;
    $sur_name=$user->sur_name;
    $nik_name=$user->nick_name;
    $mobile=$user->mobile;
    $email=$user->email;
    $birthday=$user->birthday;
    $gender=$user->gender;
    $current_city=$user->current_city;
    $home_town=$user->home_town;
    $interested_in=$user->interested_in;
    $languages=$user->languages;
    $relationship=$user->relationship;
    $about_you=$user->about_you;
    $user_image=$user->image;
    $user_name=$user->user_name;
    $password=$user->password;
}


// make a function for get post data this user
function getAllPosts($connect,$userId){
    $getData = $connect->prepare("SELECT * FROM `posts` WHERE user_id=$userId ORDER BY id DESC;");
    $getData->execute();

    return $getData->fetchAll(PDO::FETCH_OBJ);
}
// get this user all post
$posts=getAllPosts($connect,$userId);