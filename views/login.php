
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
    $getData = $connect->prepare("SELECT id,sur_name,password,image FROM `tb_user_info` WHERE user_name='$userName';");
    $getData->execute(); //query execute.
    $allData=$getData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.
    // print_r($allData);


    // get single data fom array.
    foreach($allData as $data){
        $databasePassword = $data->password; // get password which come from database.
        $userId = $data->id;
        $name = $data->sur_name;
        $image= $data->image;
        echo $databasePassword;
        echo $userId;
        echo $name;
        echo $image;
    }

    // check user password and database password are same
    if($databasePassword == $passCode){
        session_start(); // Start the session.
        $_SESSION['userId']=$userId; // set sesson variable user Id.
        $_SESSION['name']=$name; // set sessin variable user name.
        $_SESSION['image']=$image; // set session variable user profile image.


        echo $userId;
        // write quriey for get data from database.
        $getActiveStatus = $connect->prepare("SELECT * FROM tb_active_status WHERE user_id='$userId';");
        $getActiveStatus->execute(); //query execute.
        $activeStatus=$getActiveStatus->fetchAll(PDO::FETCH_OBJ); // petch data in a array.

        // check active satatus if active sattus alrady create then update status.
        // otherwise create a new sattus.
        if($activeStatus == null){
            // add active status in database
            $insertActiveStatus = $connect->prepare("INSERT INTO `tb_active_status`(`user_id`, `last_activity_date`, `last_activity_time`, `login_status`)
            VALUES ($userId,CURDATE(),CURTIME(),true);");
            $insertActiveStatus->execute() or die('Sorry data not insert.. ative status insert'); // statement execute
        }else{
            // update active status in database
            $updateActiveStatus = $connect->prepare("UPDATE `tb_active_status` SET 
            `last_activity_date`=CURDATE(),
            `last_activity_time`=CURTIME(),
            `login_status`=true
            WHERE user_id=$userId");
            $updateActiveStatus->execute() or die('Sorry data not insert.. ative status update'); // statement execute
        }

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
        <link rel="stylesheet" href="../public/style-link-sec.css">
    </head>


    <body class="bg-light">
        <div class="container m-5">
                <div class="row" style="">
                    <div class="col-sm-4 bg-black"> 
                        <div class="card p-3 rounded">
                            <div class="card-header bg-info border-white border text-center rounded">
                                <h3 class="text-white"><h1 class="text-white">LookBook</h1></h3>
                            </div>
                            <div class="card-body pt-3 pb-3 px-2 py-2 bg-white">
                                <form action="" method="post" class="from border-bottom" style="">
                                    <div class="form-group">
                                    <input type="text" name="userName" id="" class="form-control mb-2" placeholder="User Name" aria-describedby="helpId">
                                    <input type="password" name="userPassword" id="" class="form-control mb-2" placeholder="Password" aria-describedby="helpId">
                                    <input type="submit" name='submit' value="Login" class='btn btn-primary mb-2 mt-4' style="width: 100%;">
                                    </div>
                                </form>

                                <div class="row mt-2">
                                    <div class="col text-center m-0">
                                        <button class="btn btn-success" style="width: 100%;">Sing Up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </body>
<!---
<body class='con-login'>
    <div class='login-box my-5 mx-5' style='text-align: center;'>
    <div class='title text-light'><h1><Strong>Look</Strong><small>Book</small></h1></div>
        <div class='row mx-2 my-2'>
            <div class='col-lg-12'>
            <img class='my-3' src="../images/cover/avatar.png" alt="top image">

                <?php if(!empty($error)): ?>
                <div class="alert alert-warning">
                    <strong>Warning!</strong> <?php echo $error; ?>
                </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class='form-group'>
                        <input type="text" name="userName" id="" class='form-control my-2' placeholder='User name'>
                        <input type="password" name="userPassword" id="" class='form-control my-2' placeholder='Password'>
                        <input type="submit" name='submit' value="Login" class='btn btn-outline-light px-5 my-3'>
                        <a href="registration" class='text-white'><h5>Regstration now</h5></a>
                    </div>
                </form>
            </div>
            <div class='col-lg-3'></div>
        </div>
    </div>
</body>
                -->
</html>