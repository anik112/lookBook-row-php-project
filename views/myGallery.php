<?php

require './database/dbConnect.php';
require './function/databaseFunction.php';

$userId=$_SESSION['userId'];
$titles='Gallery';

$imageId=0;
$images='';

$images=getDataUsingOrderAndId($connect,'usersgallery',$userId,'user_id');

$headerName='user';
$footerName='user';
require './views/header.php';
?>

<div class='container'>
<?php
    if($images == null){
    echo "<div style='text-align: center;'><h3 style='color: coral;'>SORRY, No image available for this user.</h3></div>";
    }
?>
<div class='d-frnd-list my-5'>
    <?php foreach($images as $image):?>
        <!-- <div class="card my-5 mx-2" style="width: 18rem;">
            <img class="card-img-top card-pro-img" src="<?php // echo $image->images;?>" alt="Card image cap">
        </div> -->
        <div>
            <!-- Trigger the Modal -->
            <img id="myImg" src="<?php echo $image->images;?>" alt='images..' style="width:100%;max-width:400px;max-height:400px">
            <!-- The Modal -->
            <div id="myModal" class="modal">
            <!-- The Close Button -->
            <span class="close">&times;</span>
            <!-- Modal Content (The Image) -->
            <img class="modal-content" id="img0<?php echo $imageId++;?>">
            <!-- Modal Caption (Image Text) -->
            <div id="caption"></div>
            </div> 
        </div>
    <?php endforeach;?>
</div>
</div>

<?php require './views/footer.php'; ?>