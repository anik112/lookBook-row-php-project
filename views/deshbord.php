
<?php

// call database page
require './database/dbConnect.php';

// call database function
require './function/databaseFunction.php';


// get all user data
$frindes=getAllDataFromTable($connect,'users');

// get current user id
$currentId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// get current user information
$getInfo=getAllDataFromTableUsingId($connect,'users',$currentId);

// get friend id from friendlist table
$myFrindes=getDataUsingColNameAndId($connect,'frendslist',$currentId,'user_id');

// get all data from posts table
$getData=getPostData($connect,$currentId);

/**
 * function name: getPostData
 * this function get post data from posts table 
 * using friend id from pivot table.
 * this function show specific post using friendslist table id
 * pivot table is frendslist.
 * 
 * @param connect   this param get connection from database.
 * @param user_id this param get user id number for find data.
 * 
 * @author Pranta paul <paulanik.wb@gmail.com>
 * @return Status
 */
  function getPostData($connect,$userId){
      // execute queries and get data in variable
      $sqlData = $connect->prepare("SELECT * FROM `posts` WHERE user_id IN
                                  (SELECT friends_id FROM frendslist WHERE user_id=$userId)
                                  ORDER BY id DESC;
                                  ");
      $sqlData->execute();

      // return data
      return $sqlData->fetchAll(PDO::FETCH_OBJ);
  }



// declare variable
$currentUserName=null;
$currentUserEmail=null;
$currentUserNumber=null;
$currentUserGander=null;
$currentUserHomeTown=null;
$currentUserAbout=null;
$count=0;

//  discribe data from a array
foreach ($getInfo as $info) {
  # code...
  $currentUserName=$info->user_name;
  $currentUserEmail=$info->email;
  $currentUserNumber=$info->mobile;
  $currentUserGander=$info->gender;
  $currentUserHomeTown=$info->home_town;
  $currentUserAbout=$info->about_you;
}



// if(isset($_POST['submit'])){
//     echo $_POST['comment'].'</br>';
//     echo $_POST['postId'].'</br>';
//     echo $_POST['userId'];
// }

?>



<!-- call header part -->
<?php
$pageName='Deshbord';
// echo $_SESSION['userId'];
require 'header.php';
?>


<!-- main container -->

<!-- <div class='container'> -->

<!-- show about information -->
<div class='row mx-5'>
    <div class='col-lg-3'>
      <div class='' id='about-info'>
      <div class='card my-5 px-2'>
        <div class='card-body'>
          <h5><strong>About:</strong></h5>
          <p><?=$currentUserAbout;?></p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class='row'>
            <div class='col-sm-2'><img src="../images/icon/street-name.png" alt="name" srcset=""></div>
            <div class='col-sm-10 px-3'><?=$currentUserName;?></div>
            </div>
          </li>
          <li class="list-group-item">
            <div class='row'>
            <div class='col-sm-2'><img src="../images/icon/mail.png" alt="mail" srcset=""></div>
            <div class='col-sm-10 px-3'><?=$currentUserEmail;?></div>
            </div>
          </li>
          <li class="list-group-item">
            <div class='row'>
            <div class='col-sm-2'><img src="../images/icon/phone-contact.png" alt="number" srcset=""></div>
            <div class='col-sm-10 px-3'><?=$currentUserNumber;?></div>
            </div>
          </li>
          <li class="list-group-item">
            <div class='row'>
            <div class='col-sm-2'><img src="../images/icon/gender.png" alt="gender" srcset=""></div>
            <div class='col-sm-10 px-3'><?=$currentUserGander;?></div>
            </div>
          </li>
          <li class="list-group-item">
            <div class='row'>
            <div class='col-sm-2'><img src="../images/icon/house.png" alt="name" srcset=""></div>
            <div class='col-sm-10 px-3'><?=$currentUserHomeTown;?></div>
            </div>
          </li>
        </ul>
      </div>
      </div>
    </div>

    <!-- show post information -->
   <div class='col-lg-5'>
    <?php foreach($getData as $data):?>
        <?php // foreach($myFrindes as $fnd): 
        // if($data->user_id == $fnd->friends_id):
        ?>

          <div class="card my-5">
            <h4 class="card-header bg-white">
              <!-- show post author name and img -->
              <img src="../images/cover/avatar.png" alt="img" srcset="" class='post-header-img'>
              <a href="profile?id=<?=$data->user_id;?>" class='text-primary'><strong><?=$data->user_name;?></strong></a>
            </h4>
            <!-- if image have in database then show image in post -->
            <?php if(strlen($data->imsge) > 1): ?>
              <img class="card-img-top img-thumbnail" src="<?=$data->imsge;?>" alt="Card image cap">
            <?php endif; ?>
            <div class="card-body">
              <!-- show post title -->
              <h4 class="card-title text-black"><?=$data->title;?></h4>
              <!-- show post content -->
              <p class="card-text my-4 text-secondary"><?=$data->content;?></p>
              <div class='row my-2 py-3 border-top border-muted'>

                <!-- like post option -->
                <div class='col-sm-2 text-center'>
                  <!-- show icon for like -->
                  <a href="love?postId=<?=$data->id;?>&loc=deshbord&friendId=<?=$data->user_id;?>" class='love-btn'><img src="../images/icon/love.png" alt="love" srcset=""></a>
                  <!-- show all likes -->
                  <div class='show-likes' id='view-likes<?=$data->id;?>' style='display: none;'>
                    <div class='sub-tab'>
                    <!-- botton for close this content -->
                    <button class='btn btn-outline-danger float-right' onclick="closeLike('view-likes<?=$data->id;?>')">X</button>
                    <div class='row py-2 border-bottom'>
                        <div class='col-sm-2'><h5>Image</h5></div>
                        <div class='col-sm-2'><h5>ID</h5></div>
                        <div class='col-sm-8'><h5>Name</h5></div>
                    </div>
                      <?php
                        $count=0; // count number how many like in this post
                        // get all like from database using post id
                        $getLike=getDataUsingOrderAndId($connect,'likes',$data->id,'post_id');
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
                  <!-- button for show liker information -->
                  <button class='likes-view' onclick="showLikes('view-likes<?=$data->id;?>')" id='likes-view'>[ <?=$count;?> ]</button>
                </div>
                <!-- show comment box -->
                <div class='col-sm-10'>
                  <!-- create from for wirite comment in database -->
                  <form action="writeComment" method="post">
                    <input id="comment" type="text" class="form-control" name="comment" placeholder="Write your comment...">
                    <input type="hidden" name="postId" value='<?php echo $data->id; ?>'>
                    <input type="hidden" name="friendId" value='<?php echo $data->user_id; ?>'>
                    <input type="hidden" name="loc" value='deshbord'>
                  </form>
                </div>
              </div>

              <!-- show all comment -->
              <div class='row'>
                <div class='col-sm-12'>
                  <!-- show comment -->
                  <?php 
                  $getComments=getDataUsingOrderAndId($connect,'comments',$data->id,'post_id');

                  foreach($getComments as $comment):
                  ?>
                  <div class='comment mt-2'>
                  <a href="profile?id=<?=$comment->user_id;?>"><strong class='text-priamry'><?=$comment->user_name;?></strong></a>
                  <p class='text-info'><?=$comment->content;?></p>
                  </div>
                  <?php endforeach;?>
                </div>
              </div>

            </div>
          </div>

        <?php
       // endif; 
       // endforeach;
        ?>
      <?php endforeach; ?>
   </div>

   <!-- show some friends -->
    <div class='col-lg-4'>        
        <div class='card mt-5 d-fnd-list' id='friend-l-d'>
                <div class='card-body'>
                <ul class="list-group list-group-flush">

                <!-- show data in html form -->
                <?php foreach($frindes as $frinde): // describe data & first loop?>

                    <?php 
                    // second foreach loop
                    foreach($myFrindes as $fnd){ // get single data from a object
                        if(($frinde->id == $fnd->friends_id) || ($frinde->id == $currentId)){ // check which friend attend in your friend list 
                            continue 2; // if statement is true then skip first froeach loop.
                        }
                    }
                    ?>
                    <li class="list-group-item py-1">
                        <div class='row'>
                            <div class='col-lg-6' style='height: 100px;'>
                              <img style='height: 100px; width: 100px; border-radius: 50%;'  src="<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>" alt="Card image cap">
                            </div>
                            <div class='col-lg-6'>
                              <a href="profile?id=<?=$frinde->id;?>"><h5 class='text-info my-0'><strong><?=$frinde->sur_name?></strong></h5></a>
                              <p class='text-info my-0' style='font-size: 10px;'><?=$frinde->email;?></p>
                              <p class='text-info my-0' style='font-size: 10px;'><?=$frinde->mobile;?></p>
                              <a href="addFriend?loc=deshbord&friendId=<?=$frinde->id;?>" class='btn btn-outline-primary mt-2 py-1' style='font-size: 12px;'>Add Friend</a>
                            </div>
                        </div>
                    </li>
                    <?php
                      $count++; // increment count variable
                      if($count==4){ // when count variable is 4 then
                        break; // break the loop
                      }
                    ?>
                <?php endforeach; ?>
                </ul>
                </div>
            </div>
          </div>
</div>
<!-- </div> -->

<!-- end main container -->

<!-- call footer part -->
<?php require 'footer.php';?>