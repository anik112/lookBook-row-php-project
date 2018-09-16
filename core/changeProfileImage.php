<?php

session_start();
// require database file.
require '../database/dbConnect.php';

/**
 * function name: updateProfileImage
 * This function update user profile image.
 * @param connect   this param get connection from database.
 * @param user_id this param get user id number for find data.
 * @param userId this param get user id .
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
function updateProfileImage($connect,$userId,$newpicture){
    // execute queries and get data in variable
    $getData = $connect->prepare("UPDATE `users` SET `image`='$newpicture' WHERE id=$userId;");
    $getData->execute() or die("Data not insert. Please try again profile image.");

}

/**
 * function name: updateGalleryImage
 * This function insert image in post.
 * @param connect   this param get connection from database.
 * @param image this param get user image.
 * @param userId this param get user id .
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
function updatePostFile($connect,$userId,$userName,$image){
    $statement=$connect->prepare("INSERT INTO `posts`(`user_id`,`user_name`,`imsge`) VALUES ($userId,'$userName','$image');");
    $statement->execute()  or die("Data not insert. Please try again update post.");
}


/**
 * function name: updateGalleryImage
 * This function update image in gallery.
 * @param connect   this param get connection from database.
 * @param oldPic this param get user old image.
 * @param userId this param get user id .
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
function updateGalleryImage($connect,$userId,$oldPic){
    // // add image in gallery.
    $insertImageData = $connect->prepare("INSERT INTO `usersgallery`
    (`user_id`, `images`) 
    VALUES
    ($userId,'$oldPic');");
    $insertImageData->execute() or die("Data not insert. Please try again update gallery."); // statement execute

}

// check user submit his form.
if(isset($_POST['submit'])){
    

    $userid=''; // for current user id
    $imageName=''; // for current user image name
    $userName=''; // for current user name
    $oldImage=''; // for user old image name
    if(isset($_SESSION['userId'])){$userid=$_SESSION['userId'];} // set user id.
    if(isset($_SESSION['name'])){$userName=$_SESSION['name'];} // set user name.
    if(isset($_SESSION['image'])){$oldImage=$_SESSION['image'];} // set image from session.


    // $oldImgName=substr($oldImage,10); // get orginal image name.

    // check if image is selected
    if(isset(($_FILES['file']['size'])) > 0){

        $target_dir = "../images/"; // current image dir
        $target_file = $target_dir . basename($_FILES['file']['name']); // set file name.
        // echo $target_file.'</br>';

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){
            $imageName=$target_dir.rand(1,100).$_FILES['file']['name']; // get image name with dir
            // echo $imageName.'</br>';
        }else{
            echo 'file is not valid. format [.jpg,.jpeg,.png,.gif]</br>';
        }
    }else{
        echo 'sorry, file not selected </br>';
    }



    // if have any image
    if(strlen($imageName) > 1){
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],$imageName); // move image in located dir
        updateProfileImage($connect,$userid,$imageName); // upload data in user database
        updateGalleryImage($connect,$userid,$imageName); // upload data in user gallery database
        updatePostFile($connect,$userid,$userName,$imageName); // upload data in user post database
        $_SESSION['image']=$imageName; // update session image status for get update
    }

    // go to back page.
    header("Location: /profile");


}