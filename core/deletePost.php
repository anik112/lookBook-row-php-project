<?php 

require './database/dbConnect.php';
require './function/databaseFunction.php';

if(isset($_REQUEST['postId'])){

    $postId=$_REQUEST['postId'];

    $deleteData=deleteAllDataUsingId($connect,'posts',$postId);

    if($deleteData){
        // goto posts page
        header("Location: /posts?success");
    }else{
        // goto posts page
        header("Location: /posts?error=i");
    }

}

