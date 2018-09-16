
<?php

require './database/dbConnect.php';

if(isset($_POST['submit'])){


    $userName=$_POST['userName'];  // get username from user.
    $passCode=$_POST['userPassword'];   // get passcode from user.
    //  echo $passCode.'</br>';
    $databasePassword=null; // database user password.
    $userId=null; // declare user id.
    $name=null; // declare name variable.
    $image=null; // declare image variable..

    $error=null; // declare null error.

    // write quriey for get data from database.
    $getData = $connect->prepare("SELECT id,sur_name,password,image FROM users WHERE user_name='$userName';");
    $getData->execute(); //query execute.
    $allData=$getData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.
    // print_r($allData);

    // get single data fom array.
    foreach($allData as $data){
        $databasePassword = $data->password; // get password which come from database.
        $userId = $data->id;
        $name = $data->sur_name;
        $image= $data->image;
        //  echo $databasePassword;
        //echo $userId;
    }

    // check user password and database password are same
    if($databasePassword == $passCode){
        session_start(); // Start the session.
        $_SESSION['userId']=$userId; // set sesson variable user Id.
        $_SESSION['name']=$name; // set sessin variable user name.
        $_SESSION['image']=$image; // set session variable user profile image.
        header("Location: /deshbord"); // set url in go to deshbord.
    }else{
        $error='sorry your password is incorrect. please try more.';
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <div class='container' style='text-align: center;'>
    <div class='title my-3'><h1>Login Here</h1></div>
        <div class='row my-3'>
            <div class='col-lg-3'></div>
            <div class='col-lg-6'>

            <div class='top-image my-5'><img src="../images/icon/user-solid.svg" alt="top image"></div>

                <?php if(!empty($error)): ?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> <?php echo $error; ?>
                </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class='form-group'>
                        <input type="text" name="userName" id="" class='form-control my-2' placeholder='User name'>
                        <input type="password" name="userPassword" id="" class='form-control my-2' placeholder='Password'>
                        <input type="submit" name='submit' value="Login" class='btn btn-outline-primary px-5 my-3'>
                        <a href="registration"><h5>Regstration now...</h5></a>
                    </div>
                </form>
            </div>
            <div class='col-lg-3'></div>
        </div>
    </div>
</body>
</html>