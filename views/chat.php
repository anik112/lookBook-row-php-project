<?php

require './database/dbConnect.php';
require './function/databaseFunction.php';

// get user id from session
$userId=(isset($_SESSION['userId']))?$_SESSION['userId']:0;

// get friend data from friend list
$frindes=getFriendsData($connect,$userId);

$pageName='Active Friends';
require 'header.php';
?>

<div class='row'>

<div class='col-lg-4'>
    <?php foreach($frindes as $friend): ?>
    <a href="chatTemp?friendId=<?=$friend->id;?>"><?=$friend->sur_name;?></a>
    <?php endforeach; ?>
</div>


<div class='col-lg-8'>
<?php require 'chatTemp.php' ?>
</div>

</div>

<?php require 'footer.php' ?>