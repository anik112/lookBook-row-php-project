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
$titles='My Profile';
// $image='../images/images(5).jpg';
// then require header part
$headerName='user';
$footerName='user';
require 'header.php';
?>

<div class='my-5 mx-5'>
<?php foreach($data as $singleData): ?>
<div class='row my-3'>
    <div class='col-lg-6 px-5'>
        <a href="profile?id=<?=$singleData->id;?>" style='color: black;'><h3><?php echo $singleData->sur_name;?></h3></a>
    </div>
    <div class='col-lg-3'>
        <?php echo $singleData->email;?>
    </div>
    <div class='col-lg-3'>
        <?php echo $singleData->mobile;?>
    </div>
</div>
<?php endforeach; ?>
</div>



<?php
// call footer part
require 'footer.php'; ?>