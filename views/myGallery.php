<?php

require './database/dbConnect.php';
require './function/databaseFunction.php';

$userId=$_SESSION['userId'];

$imageId=0;
$images='';

$images=getDataUsingOrderAndId($connect,'usersgallery',$userId,'user_id');

$pageName='Gallery';
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
        <div class='my-2 mx-1' id='img-show'>
            <!-- Trigger the Modal -->
            <img id='myImg' onclick='showImg("<?php echo $image->images;?>")' src="<?php echo $image->images;?>" alt='images..' style="width:200px;height:200px">
        </div>
    <?php endforeach;?>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- The Close Button -->
        <span class="close">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div> 
</div>
</div>

<?php require './views/footer.php'; ?>