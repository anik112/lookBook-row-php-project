<?php 

$id=0; // declare id variable
$name=''; // declare name variable
// if session exists
if(isset($_SESSION['userId'])){
    $id=$_SESSION['userId']; // get user id.
    $name=$_SESSION['name']; // get user name.
}


require './function/databaseFunction.php'; // require databaseFunction file
require './database/dbConnect.php'; // require database connect file
// declare page titles and user image
$pageName='Create Post';
require 'header.php';
?>

<!-- page main part -->
<div class='container'>
    <div class='row my-5'>
        <div class='col-lg-12'>
            <div class='card'>
                <!-- create post panel -->
                <div class="card-header"><h1>Create Post</h1></div>
                <div class='card-body'>
                    <!-- send data -->
                    <form action="../core/createPost.php" method="post" enctype="multipart/form-data">
                        <div class='form-group form-group-lg my-5 mx-5'>
                            <!-- get title from user -->
                            <input type="text" name="title" id="" class='form-control my-2' placeholder='Type post title' required>
                            <!-- check have any file error -->
                            <?php if(isset($_REQUEST['error'])){
                                if($_REQUEST['error'] == 'w'){
                                    echo    '<div class="alert alert-warning">'.
                                            "<strong>Warning!</strong> Sorry, this file dasn't support Check file and file size".
                                            '</div>';
                                }elseif($_REQUEST['error'] == 'f'){
                                    echo    '<div class="alert alert-warning">'.
                                            "<strong>Warning!</strong> Sorry, this file dasn't support. Check file with this format [.jpg,.jpeg,.png,.gif]".
                                            '</div>';
                                }
                            } ?>
                            
                            <!-- get image from user -->
                            <div class="custom-file my-2">
                                <input type="file" name='image'  class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" lang="en">
                                <label class="custom-file-label file-inp-z" for="inputGroupFile01">Choose Image file [ MAX: 2MB ]</label>
                            </div>
                            <!-- get user feeling from user -->
                            <textarea name="contant" id="contant" cols="30" rows="5" class='form-control my-2' placeholder='Write your feelings...'></textarea>
                            <!-- send user id and user name -->
                            <input type="text" name='userId' value='<?php echo $id;?>' style='display: none;'>
                            <input type="text" name='userName' value='<?php echo $name;?>' style='display: none;'>
                            <!-- submit data location: "../core/createPost.php" -->
                            <input type="submit" value="Public" name='submit' class='btn btn-outline-primary my-3  px-5'>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <div class='row'>
        <?php
        // get data from posts table, using user id
        $getposts=getDataUsingOrderAndId($connect,'posts',$id,'user_id');

        ?>
        <!-- show this user posts -->
        <div class='col-lg-12'>
        <?php 
        if(isset($_REQUEST['error']) == 'i'){
            echo    '<div class="alert alert-danger">'.
                    "<strong>Warning!</strong> Sorry, this file dasn't delete. Try again.".
                    '</div>';
        }elseif(isset($_REQUEST['success'])){
            echo    '<div class="alert alert-success">'.
                    "<strong>Success!</strong> Post, is deleted.".
                    '</div>';
        }
        ?>
            <div class='card'>
                <div class='card-body'>
                <ul class="list-group list-group-flush">
                <!-- show data in html form -->
                <?php foreach($getposts as $post): // describe data?>
                    <li class="list-group-item">
                        <div class='row'>
                            <div class='col-lg-1'>
                                <?=$post->id; // set post id?>
                            </div>
                            <div class='col-lg-4'>
                                <?=$post->title; // set post title?>
                            </div>
                            <div class='col-lg-6'>
                                <!-- using substr function for get e sub sring from big string -->
                                <?=substr($post->content,0,50); // set post content?>
                            </div>
                            <div class='col-lg-1'>
                                <a href="deletePost?postId=<?= $post->id;?>" class='btn btn-danger'>Delete</a>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- call footer part -->
<?php require 'footer.php'; ?>