<?php 

require './database/dbConnect.php';

if(isset($_GET['submit'])){

    $searchItem=$_GET['searchContent'];
    
    $exe=$connect->prepare(" SELECT * FROM `users` WHERE sur_name LIKE '%$searchItem%' OR email LIKE '%$searchItem%' OR mobile LIKE '%$searchItem%';") or die('Have some PROBLEM..');
    $exe->execute();
    
    $data = $exe->fetchAll(PDO::FETCH_OBJ);
    
    if(empty($data)){
        $msg= 'Sorry could not FIND data';
    }
}

// declare page titles and user image
$pageName='Search Friends';
// then require header part
require 'header.php';
?>

<div class='my-5 mx-5'>
<?php foreach($data as $singleData): ?>
<div class='row my-3 border-bottom'>
    <div class='col-lg-1' style='margin: 0px; padding: 0px;'>
    <img class='search-pro-img' src="
            <?php if(($singleData->image) != null){
                echo $singleData->image; // set image
            }else{
                echo './images/avatar.png'; // defult image
            }?>
            " alt='profile image' srcset="">
    </div>
    <div class='col-lg-5'>
        <a href="profile?id=<?=$singleData->id;?>" style='color: black;'>
            <h3 class='mt-4'><?php echo $singleData->sur_name;?></h3>
        </a>
    </div>
    <div class='col-lg-3'>
        <p class='mt-4'><?php echo $singleData->email;?></p>
    </div>
    <div class='col-lg-3'>
        <p class='mt-4'><?php echo $singleData->mobile;?></p>
    </div>
</div>
<?php endforeach; ?>
</div>



<?php
// call footer part
require 'footer.php'; ?>