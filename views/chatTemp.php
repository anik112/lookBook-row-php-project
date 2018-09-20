
<?php

$friend_id=0;

if(isset($_REQUEST['friendId'])){
    $friend_id=$_REQUEST['friendId'];
}

?>

<form action="massage" method="post">
    <div class='input-group'>
    <textarea name="massage" id="" cols="30" rows="10" class='form-control'></textarea>
    <input type="submit" value="Send" name='submit' class='btn btn-outline-primary'>
    <input type="hidden" name="friendId" value=<?=$friend_id;?>>
    </div>
</form>