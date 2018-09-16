<?php

require '../function/databaseFunction.php'; // require database function file
require '../database/dbConnect.php'; // require databse connect file


// check if post submit
if(isset($_POST['submit'])){

    $imageName=''; // declare variable for get image name.
    $userid=$_POST['userId']; // set user id.
    $userName=$_POST['userName']; // set user name.
    $title=$_POST['title']; // get post title.
    $contant=$_POST['contant']; // get post contant.


    // check if image is selected
    if(isset($_FILES["image"]["size"]) > 0 && $_FILES["image"]["error"] == 0){

        $target_dir = "../images/postImage/"; // set image dir.
        $target_file = $target_dir . basename($_FILES['image']['name']); // set file name.
        // echo $target_file;

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $imageName=$target_dir.$_FILES['image']['name']; // get image name with dir
        }else{
            // send error in post page.
            header("Location: /posts?error=f");
        }

    }else{
        // send error in posts page.
        header("Location: /posts?error=w");
    }


    if(!empty($title)){
        // add data in post table
        $statement=$connect->prepare("INSERT INTO `posts` (`user_id`, `user_name`, `title`, `content`, `imsge`) 
        VALUES ($userid,'$userName','$title','$contant','$imageName');");
        $statement->execute()  or die("Data not insert. Please try again.");

        // add image in gallery.
        $insertImageData = $connect->prepare("INSERT INTO `usersgallery` (`user_id`, `images`) 
        VALUES
        ($userid,'$imageName');");
        $insertImageData->execute() or die('Sorry data not insert.. image'); // statement execute

        // check if file name up to 1
        if(strlen($imageName) > 1){
            // Upload file
            move_uploaded_file($_FILES['image']['tmp_name'],$imageName);
        }
        // goto posts page
        header("Location: /posts");
    }

    

    // echo $_FILES['image']['tmp_name'].'</br>';
    // print_r($_FILES["image"]);

}