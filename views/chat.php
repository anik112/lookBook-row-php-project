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
    <button onclick="showMassages(<?=$friend->id;?>)"><?=$friend->sur_name;?></button>
    <?php endforeach; ?>
</div>


<div class='col-lg-8'>

<div id='show-user'>

</div>


<form action="massage" method="post">
    <div class='input-group'>
    <textarea name="massage" id="" cols="30" rows="10" class='form-control'></textarea>
    <input type="submit" value="Send" name='submit' class='btn btn-outline-primary'>
    <input type="hidden" name="friendId" value=<?=$friend_id;?>>
    </div>
</form>
</div>

</div>

<?php require 'footer.php' ?>