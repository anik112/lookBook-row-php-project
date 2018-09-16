<?php 

// get url and trim url
$fndUrl = trim( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/' );


require './database/dbConnect.php';
require './function/databaseFunction.php';


// declare variable
$frindes=null;
$myFriends=null;

// get user id
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

if($fndUrl == 'pubFriends'){ // if url request for public friends
    // declare page titles and user image
    $pageName='All Frindes';

    // get all user form database
    $frindes=getAllDataFromTable($connect,'users');
    $myFriends=getDataUsingColNameAndId($connect,'frendslist',$userId,'user_id');

} else if($fndUrl == 'friends'){ // if url request for my friends
    // declare page titles and user image
    $pageName='My Frindes';

    // get friend data from friend list
    $frindes=getFriendsData($connect,$userId);
}

// then require header part
require 'header.php';
?>

<div class='row my-5 mx-2'>

        <!-- first frined list -->
        <div class='col-lg-3'>
        <!-- get single data from a friend object -->
        <!-- first foreach loop -->
        <?php foreach($frindes as $frinde):?>
            <?php if(($fndUrl=='pubFriends')){  // if url for public friend then check who user add in your friend list
                // second foreach loop
                foreach($myFriends as $fnd){ // get single data from a object
                    // check which friend attend in your friend list 
                    // or check database user id is equal login user id
                    if(($frinde->id == $fnd->friends_id) || ($frinde->id == $userId)){ 
                        continue 2; // if statement is true then skip first froeach loop.
                    }
                }
            }
            ?>
            <div class='card my-1'>
            <button class='bg-info' style='border: none; padding: 0px;' 
            onclick="showTempProfile(<?=$frinde->id;?>,'<?=$frinde->sur_name;?>','<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>',
                                    '<?=$frinde->mobile;?>','<?=$frinde->gender;?>','<?=$frinde->birthday;?>','<?=$frinde->email;?>');">
               <div class='card-body'>
                    <div class='row'>
                        <div class='col-sm-2'> 
                            <img class="card-pro-pic" src="<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>" alt="Card image cap">
                        </div>
                        <div class='col-sm-10 text-left pl-5'>
                        <h5 class="card-title my-3 text-white"><?=$frinde->sur_name;?> [ <?=$frinde->nick_name;?> ]</h5>
                        </div>
                    </div>
               </div>
            </button>
            </div>
        <?php endforeach;?>
        </div>

        <!-- temp profile view -->
        <div class='col-lg-6'>
            <div class='card text-center p-3' id='temp-p-d' style='display: none;'>

                <div id='text-center my-5'><img src="" alt="profile image" id='img-t' class='card-pro-imgs'></div>

                <ul class="list-group list-group-flush my-5">
                    <li class="list-group-item">
                        <div class='row'>
                        <div class='col-sm-2'><img src="../images/icon/street-name.png" alt="name" srcset=""></div>
                        <strong class='col-sm-10 px-3 text-left' id='surName'></strong>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='row'>
                        <div class='col-sm-2'><img src="../images/icon/mail.png" alt="mail" srcset=""></div>
                        <strong class='col-sm-10 px-3 text-left' id='email'></strong>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='row'>
                        <div class='col-sm-2'><img src="../images/icon/phone-contact.png" alt="number" srcset=""></div>
                        <strong class='col-sm-10 px-3 text-left' id='mobile'></strong>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='row'>
                        <div class='col-sm-2'><img src="../images/icon/gender.png" alt="gender" srcset=""></div>
                        <strong class='col-sm-10 px-3 text-left' id='gender'></strong>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class='row'>
                        <div class='col-sm-2'><img src="../images/icon/birthday-reminder.png" alt="date of birth" srcset=""></div>
                        <strong class='col-sm-10 px-3 text-left' id='dateOfBirth'></strong>
                        </div>
                    </li>
                </ul>
                <a href="" id='pro-link' class='btn btn-primary px-5 py-2 mx-1 my-2'>Profile</a>
                <!-- if url request for public friend then show add friend button -->
                <?php if($fndUrl=='pubFriends'): ?>
                <a href="" id='add-link' class='btn btn-primary px-5 py-2 mx-1'>Add Friend</a>
                <?php endif; ?>
                <!-- if url request for won friends then show unfriend button -->
                <?php if($fndUrl=='friends'): ?>
                <a href="" id='delete-link' class='btn btn-primary px-5 py-2 mx-1'>Unfriend</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- second friend list -->
        <div class='col-lg-3'>
            <?php foreach($frindes as $frinde):?>
            <div class='card my-1'>
            <button class='bg-info' style='border: none; padding: 0px;' 
            onclick="showTempProfile(<?=$frinde->id;?>,'<?=$frinde->sur_name;?>','<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>',
                                    '<?=$frinde->mobile;?>','<?=$frinde->gender;?>','<?=$frinde->birthday;?>','<?=$frinde->email;?>');">
               <div class='card-body'>
                    <div class='row'>
                        <div class='col-sm-2'> 
                            <img class="card-pro-pic" src="<?=($frinde->image!=null?$frinde->image:'./images/avatar.png');?>" alt="Card image cap">
                        </div>
                        <div class='col-sm-10 text-left pl-5'>
                        <h5 class="card-title my-3 text-white"><?=$frinde->sur_name;?> [ <?=$frinde->nick_name;?> ]</h5>
                        </div>
                    </div>
               </div>
            </button>
            </div>
            <?php endforeach;?>
        </div>

</div>

<!-- call footer part -->
<?php require 'footer.php'; ?>