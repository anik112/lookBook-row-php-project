<?php

require '../database/dbConnect.php';
require '../function/databaseFunction.php';

echo 'from registration in core';

$error=null;


// check if user form submit
if(isset($_POST['submit'])){

    // get old data from database
    $getOldData=getAllDataFromTable($connect,'users');

    // get all informaton from user form
    $userId=0;
    $surName=$_POST['surName'];
    $nikName=$_POST['nikName'];
    $mobileNumber=$_POST['mobileNumber'];
    $email=$_POST['email'];
    $dateOfBirth=$_POST['dateOfBirth'];
    $gender=$_POST['gender'];
    $currentCity=$_POST['currentCity'];
    $homeTown=$_POST['homeTown'];
    $interstedIn=$_POST['interstedIn'];
    $language=$_POST['language'];
    $relatonShip=$_POST['relationship'];
    $aboutYou=$_POST['aboutYou'];
    $userName=$_POST['userName'];
    $password=$_POST['password'];
    $rePassword=$_POST['retPassword'];

    $emailFilter = "/[a-zA-Z0-9_-.+]+@[a-zA-Z0-9-]+.[a-zA-Z]+/";
    $requestURL="Location: /registration?";

    foreach($getOldData as $data){
        if($mobileNumber == $data->mobile){
            $error[0]='number-w';
        }if($email == $data->email){
            $error[1]='email-w';
        }if($userName == $data->user_name){
            $error[2]='username';
        }
    }
    if(strlen($surName) <= 8){
        $error[3]='surname';
    }/*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error[5]='email-d';
    }*/if($password != $rePassword){
        $error[6]='password';
    }if(strlen($mobileNumber) > 11 || strlen($mobileNumber) < 11){
        $error[4]='number-d';
    }


    if(!empty($error)){
        if(!empty($error[0])){
            $requestURL .= "number=$error[0]";
        }if(!empty($error[1])){
            $requestURL .= "&email=$error[1]";
        }if(!empty($error[2])){
            $requestURL .= "&username=$error[2]";
        }if(!empty($error[3])){
            $requestURL .= "&surname=$error[3]";
        }if(!empty($error[4])){
            $requestURL .= "&number=$error[4]";
        }if(!empty($error[5])){
            $requestURL .= "&email=$error[5]";
        }if(!empty($error[6])){
            $requestURL .= "&password=$error[6]";
        }
        header("$requestURL");
    }else{

        // print_r($_FILES['image']);
        // $check = getimagesize($_FILES["image"]["tmp_name"]); // get image size
        // echo $check.'</br>';

        // check if image selected
        if(($_FILES["image"]["size"]) > 0){

            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES['image']['name']);
            echo $target_file;

            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");

            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                $imageName=$target_dir.$_FILES['image']['name']; // get image name with dir
            }else{
                $rePassword .= '*420#'; // reset password for not insert data.
                $error[7]='image-w';
                if(!empty($error[7])){
                    $requestURL .= "&image=$error[7]";
                }
                header("$requestURL");
            }

            // $image = $_FILES['image']['tmp_name']; // get image
            // $imgContent = addslashes(file_get_contents($image)); // convart image into bainary file
            // echo '</br>from file, image </br>';
        }else{
            $error[7]='image-d';
                if(!empty($error[7])){
                    $requestURL .= "&image=$error[7]";
                }
            header("$requestURL");
        }

        // check first password and retype password are same
        if($password == $rePassword){
            // data insart in database
            $insertDataInUsersTable = $connect->prepare("INSERT INTO `users`
            (`sur_name`, `nick_name`, `mobile`, `email`, `birthday`, `gender`, `current_city`, `home_town`, `interested_in`, `languages`, `relationship`, `about_you`,`image`, `user_name`, `password`) 
            VALUES
            ('$surName','$nikName','$mobileNumber','$email','$dateOfBirth','$gender','$currentCity','$homeTown','$interstedIn','$language','$relatonShip','$aboutYou','$imageName','$userName','$password');");
        
            $insertDataInUsersTable->execute(); // statement execute

            // sql qui: SELECT id FROM users ORDER BY id DESC LIMIT 1
            $getUserId=$connect->prepare("SELECT `id` FROM `users` WHERE mobile=$mobileNumber;");
            $getUserId->execute(); // statement execute

            $users=$getUserId->fetchAll(PDO::FETCH_OBJ); // get data from database.

            // describe data
            foreach($users as $user){
                $userId=$user->id; // get user data
                //echo $userId.'</br>';
            }

            // // add image in gallery.
            $insertImageData = $connect->prepare("INSERT INTO `usersgallery`
            (`user_id`, `images`) 
            VALUES
            ($userId,'$imageName');");
            $insertImageData->execute(); // statement execute

            // // Upload file
            move_uploaded_file($_FILES['image']['tmp_name'],$imageName);
            
            header("Location: /registration?success=ok");
        }
    }

}else{
    // else require user registration
    //require './views/registration.php';
}