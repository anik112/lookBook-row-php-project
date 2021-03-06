<?php 

// check user id
if(isset($_GET['id']) > 0){
    // get user id from url
    $userId=$_GET['id'];
}else{
    $userId=$_SESSION['userId'];
}

// get current active id
$activeId=0;
if(isset($_SESSION['userId'])){$activeId=$_SESSION['userId'];}

// call profile page from core DIR
require './core/profile.php';


// get friend id from friendlist table
$myFrindes=getDataUsingColNameAndId($connect,'frendslist',$activeId,'user_id');

// get friend data from friend list
$frindes=getFriendsData($connect,$userId); 

// declare page titles and user image
$pageName='My Profile';
// then require header part
require 'header.php'; // require header file
?>


<!-- body container -->
<div class="bg-light p-3">
<div class='row bg-cover mb-5 mt-3 rounded' style="width: 80%;">
    <div class='col-lg-12 py-5 px-5 up-cover'>

        <div class='float-left px-5'>
        <!-- if profile pic no alviable then take defult pic -->
            <img class='pro-pic' src="
            <?php if($user_image != null){
                echo $user_image; // set image
            }else{
                echo './images/avatar.png'; // defult image
            }?>
            " alt="pro pic" srcset="">
        </div>
        <div class='float-left px-2 text-light'>
            <h1 class='mb-5'><?= $sur_name; // set name?></h1>
            <h3><?= $nik_name; // set nik name?></h3>
            <h3><?= $mobile; // set mobile number?></h3>
            <h3><?= $email; // set email?></h3>
        </div>

        <?php 
        
        ?>
        <!-- sub button for frind req, flw, update img -->
        <?php if($activeId != $userId):?>

            <?php 
            $tempV=null;

            foreach($myFrindes as $fnd){
                if($fnd->friends_id == $userId){
                    $tempV=true;
                    break;
                } else{
                    $tempV=false;
                }
            }
            ?>
            <?php if(!$tempV):?>
                <a href="addFriend?friendId=<?=$userId;?>&loc=profile" class='btn btn-primary float-right ml-2'>Add Friend</a>
                <a href="addFriend?friendId=<?=$userId;?>" class='btn btn-primary float-right ml-2'>Following</a>
            <?php endif; ?>
            <?php if($tempV):?>
                <a href="unFriend?loc=friends&friendId=<?=$userId;?>" class='btn btn-primary float-right ml-2'>Unfriend</a>
            <?php endif; ?>
        <?php endif; ?>
        <!-- check, if it is current user profile page -->
        <?php if($activeId == $userId): ?>
            <button type="submit" class='btn btn-primary float-right ml-2' onclick="changeImage()">Edit Profile Image</button>
        <?php endif; ?>
        <div class='card changePic'>
            <div class='card-header'>
                <h5>Image:<a href="" class='float-right' onclick="closeChangeImage()">X</a></h5>
            </div>
            <div class='card-body'>
                <!-- form for update user profile image -->
                <form action="../core/changeProfileImage.php" method="POST" enctype="multipart/form-data">
                    <div class='form-group'>
                        <input type="file" name='file' class="form-control" id="imageUp" lang="en">
                    </div>
                    <div class='form-group'>
                        <input type="submit" name='submit' value="Change" class='btn btn-outline-primary float-right'>
                    </div>
                </form>
            </div>
        </div>
        <script type='text/javascript'>
        // display change image panel.
        function changeImage(){
            document.getElementsByClassName('changePic')[0].style.display="block";
        }
        // hide image panel.
        function closeChangeImage(){
            document.getElementsByClassName('changePic')[0].style.display="none";
        }
        </script>
    </div>
</div>


</div>

<!-- main contant box -->
<div class='mx-3'>
    <!-- main contant -->
    <div class='row'>
    <!-- show about me.  my all information -->
        <div class='col-lg-3'>

            <div class='card px-2'>
                <div class='card-body'>
                <h5><strong>About Me:</strong></h5>
                <p><?=$about_you;?></p>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/account.png" alt="name" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$sur_name.' [ '.$nik_name.' ]'; $sur_name=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/mail.png" alt="mail" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$email; $email=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/phone-contact.png" alt="number" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$mobile; $mobile=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/gender.png" alt="gender" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$gender; $gender=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/birthday-reminder.png" alt="date Of birth" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$birthday; $birthday=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/location.png" alt="current city" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$current_city; $current_city=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/house.png" alt="home town" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$home_town; $home_town=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/point-of-interest.png" alt="interest" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$interested_in; $interested_in=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/language.png" alt="language" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$languages; $languages=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/care.png" alt="relationship" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$relationship; $relationship=null;?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class='row'>
                    <div class='col-sm-2'><img src="../images/icon/street-name.png" alt="user name" srcset=""></div>
                    <div class='col-sm-10 px-3'><?=$user_name; $user_name=null;?></div>
                    </div>
                </li>
                </ul>
            </div>
        </div>

        <div class='col-lg-5' id='custom-scroll'>
            <!-- check, there have any post -->
            <?php if(empty($posts)){echo '<h3 class="text-warning"> ----  No post in available: create post ---- </h3>';}?>
                <!-- discribe all data -->
                <?php foreach($posts as $post): ?>

                <?php 
                // get comment from comment table
                $getComments=getDataUsingOrderAndId($connect,'comments',$post->id,'post_id');
                ?>

                <div class='card mb-5 border-white'  style='background: rgb(31, 58, 69);' id="<?php echo $post->id; // set post id for calling?>">
                

                    <!-- show post image in popup -->
                    <!-- The Modal -->
                    <div id="myModal" class="modal">
                        <!-- The Close Button -->
                        <span class="close">&times;</span>
                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img">
                        <!-- Modal Caption (Image Text) -->
                        <div id="caption"></div>
                    </div> 
                    
                
                    <h5 class='card-header text-light'><?=$post->title;?></h5>
                    <?php if(strlen($post->imsge) > 1): ?>
                    <div class='text-center m-3'>
                    <img class="card-img-top" id='myImg' onclick='showImg("<?=$post->imsge;?>")' style='max-height: 714px; width: 476px;' src="<?=$post->imsge;?>" alt="Card image cap">
                    </div>
                    <?php endif; ?>

                    
                    <div class='card-body text-light px-3'>

                        <!-- show all likes -->
                        <div class='show-likes' id='view-likes<?=$post->id;?>' style='display: none;'>
                            <div class='sub-tab'>
                            <!-- botton for close this content -->
                            <button class='btn btn-outline-danger float-right' onclick="closeLike('view-likes<?=$post->id;?>')">X</button>
                            <div class='row py-2 border-bottom'>
                                <div class='col-sm-2'><h5>Image</h5></div>
                                <div class='col-sm-2'><h5>ID</h5></div>
                                <div class='col-sm-8'><h5>Name</h5></div>
                            </div>
                            <?php
                                $count=0; // count number how many like in this post
                                // get all like from database using post id
                                $getLike=getDataUsingOrderAndId($connect,'likes',$post->id,'post_id');
                                // loop for get single data from object
                                foreach($getLike as $like):
                                $count++; // count likes
                            ?>
                            <!-- show liker name, img, and id -->
                            <div class='row my-2 py-2 border-bottom'>
                                <div class='col-sm-2'><img class='pro-img-in-likes' src="../images/cover/avatar.png" alt="pro img" srcset=""></div>
                                <div class='col-sm-2'><?=$like->user_id;?></div>
                                <div class='col-sm-8'><a href="profile?id=<?=$like->user_id;?>"><?=$like->user_name;?></a></div>
                            </div>
                            <?php endforeach; ?>
                            </div>
                        </div>

                        <p><?=$post->content;?></p>
                        <button class='btn btn-info' onclick="showLikes('view-likes<?=$post->id;?>')">Like ( <?=$count;?> )</button>
                        <button class='btn btn-info comment-button'>Comment ( <?php echo sizeof($getComments);?> )</button>

                        <div class='row mt-3 comment-box'>
                            <div class='col-sm-12'>
                            <!-- show comment -->
                            <?php
                            foreach($getComments as $comment):
                            ?>
                                <div class='comment mt-2'>
                                <a href="profile?id=<?=$comment->user_id;?>"><strong class='text-white'><?=$comment->user_name;?></strong></a>
                                <p class='text-white'><?=$comment->content;?></p>
                                </div>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
        </div>

        <div class='col-lg-4'>
            <div class='row scroll-pp' id='custom-scroll'>
                <div class='col-lg-12'>
                    <div class='card border-light' >
                        <h4 class='card-header bg-light'><strong>Public Post</strong></h4>
                        <div class='card-body'>
                            <ul class="list-group list-group-flush">
                                <!-- show data in html form -->
                                <?php foreach($posts as $post): // describe data?>
                                <?php if(!empty($post->title)): // check have title int his post ?>
                                    <li class="list-group-item">
                                    <!-- write post one by one -->
                                        <div class='row'>
                                            <div class='col-lg-12'>
                                            <a href="#<?php echo $post->id; // create link for go to post?>"><h5><?=$post->title; // set post id?></h5></a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- show my friend -->
            <div class='card border-light mt-5'>
                <div class='card-header bg-light'><h4><strong>Friends...</strong></h4></div>
            </div>
            <div class='row' id='custom-scroll'>
                <div class='col-lg-12'>
                    <div class='d-frnd-list'>
                        <?php foreach($frindes as $frinde):?>
                            <div class="card bg-white my-2 mx-1 pro-card text-center" style="width:170px;"> <!-- same width with image -->
                            <a href="profile?id=<?=$frinde->id;?>">
                            <img class="card-img-top card-pro-img pt-1" src="<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>" alt="Card image cap">
                            <div class="card-body py-2" style='text-align: center;'>
                                <h4 class="card-title text-primary "><?=$frinde->sur_name;?></h4>
                            </div>
                            </a>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
// call footer part
require 'footer.php'; ?>