
<?php

$massage=[
    'email-w' => 'Sorry, this email already exists, Please try another.',
    'email-d' => 'Hello: This is not valid Email, so give correct Email.',
    'number-w' => 'Sorry, this number already exists, Please try another.',
    'number-d' => 'Hello: This is not valid Number, so give correct Number.',
    'username' => 'Sorry, this User Name already exists, Please try another.',
    'password' => 'Sorry, given two password is not same, Please try again.',
    'surname' => 'Sorry, give your name minimum 8 word.',
    'image-w' => 'File is not valid. format [.jpg,.jpeg,.png,.gif]</br>',
    'image-d' => 'Sorry, file not selected </br>'
];


$numberError;
$emailError;
$usernameError;
$surnameError;
$passwordError;
$imageError;


if(isset($_REQUEST['number'])){
    $numberError=$_REQUEST['number'];
}if(isset($_REQUEST['email'])){
    $emailError=$_REQUEST['email'];
}if(isset($_REQUEST['username'])){
    $usernameError=$_REQUEST['username'];
}if(isset($_REQUEST['password'])){
    $passwordError=$_REQUEST['password'];
}if(isset($_REQUEST['surname'])){
    $surnameError=$_REQUEST['surname'];
}if(isset($_REQUEST['image'])){
    $imageError=$_REQUEST['image'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regstration</title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    <div class='container'>
    <div class='title my-5'><h2>Regstration here</h2></div>
        <div class='row my-5 border-top'>
            <div class='col-lg-12 my-5'>
            <?php if(isset($_REQUEST['success']) == 'ok'): ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> your regstration successfull.
                </div>
            <?php endif; ?>
                <!-- get all data from users & send [ ./core/registration.php ] -->
                <form action="../core/registration.php" method="post" enctype="multipart/form-data" >
                    <div class='float-left'>
                        <div class='form-group'>
                            <?php if(!empty($surnameError)): ?>
                                <div class="alert alert-danger">
                                <strong>Danger!</strong> <?php echo $massage["$surnameError"];?>
                                </div>
                            <?php endif; ?>
                            <input type="text" name="surName" id="" class='form-control my-2' placeholder='Sur name' required>
                            <input type="text" name="nikName" id="" class='form-control my-2' placeholder='Nik name'>
                            <?php if(!empty($numberError)): ?>
                            <div class="alert alert-warning">
                            <strong>Warning!</strong> <?php echo $massage["$numberError"];?>
                            </div>
                            <?php endif; ?>
                            <input type="text" name="mobileNumber" id="" class='form-control my-2' placeholder='Mobile number' required>
                            <?php if(!empty($emailError)): ?>
                                <div class="alert alert-warning">
                                <strong>Warning!</strong> <?php echo $massage["$emailError"];?>
                                </div>
                            <?php endif; ?>
                            <input type="email" name="email" id="" class='form-control my-2' placeholder='@email.com' required>
                            <input type="date" name="dateOfBirth" id="" class='form-control my-2'>
                            <!-- gender -->
                            <h5>Gender:</h5><div class='my-3'></div>
                            <input type="radio" name="gender" value="male" class='mx-2' checked> Male
                            <input type="radio" name="gender" value="female " class='mx-2'> Female
                            <input type="radio" name="gender" value="other" class='mx-2'> Other
                            <!-- gender -->
                            <input type="text" name="currentCity" id="" class='form-control my-2' placeholder='Current city'>
                            <input type="text" name="homeTown" class='form-control my-2' placeholder='Home town'>
                            <!-- intersted in -->
                            <h5>Intersted In:</h5><div class='my-3'></div>
                            <input type="radio" name="interstedIn" value="male" class='mx-2' > Male
                            <input type="radio" name="interstedIn" value="female" class='mx-2' > Female
                            <input type="radio" name="interstedIn" value="other" class='mx-2' > Other
                            <input type="radio" name="interstedIn" value="none" class='mx-2' checked > None
                            <!-- language -->
                            <input type="text" name="language" class='form-control my-2' placeholder='Language'>
                        </div>
                    </div>
                    <div class='float-right'>
                        <div class='form-group'>
                            <!-- relation ship -->
                            <h5>Relation Ship:</h5><div class='my-3'></div>
                            <input type="radio" name="relationship" value="married" class='mx-2' > Married
                            <input type="radio" name="relationship" value="single " class='mx-2' checked> Single
                            <!-- relation ship -->
                            <textarea name="aboutYou" id="" cols="30" rows="5" class='form-control my-2' placeholder='About you [ max: 180 w ]'></textarea>
                            <!-- get image from user -->
                            <?php if(!empty($imageError)): ?>
                                <div class="alert alert-warning">
                                <strong>Warning!</strong> <?php echo $massage["$imageError"];?>
                                </div>
                            <?php endif; ?>
                            <div class="custom-file">
                                <input type="file" name='image' class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose Image file</label>
                            </div>
                            <!-- get user name -->
                            <?php if(!empty($usernameError)): ?>
                                <div class="alert alert-warning">
                                <strong>Warning!</strong> <?php echo $massage["$usernameError"];?>
                                </div>
                            <?php endif; ?>
                            <input type="text" name="userName" id="" class='form-control my-2' placeholder='User Name'>
                            <!-- get password -->
                            <?php if(!empty($passwordError)): ?>
                                <div class="alert alert-danger">
                                <strong>Danger!</strong> <?php echo $massage["$passwordError"];?>
                                </div>
                            <?php endif; ?>
                            <input type="password" name="password" id="" class='form-control my-2' placeholder='Password'>
                            <input type="password" name="retPassword" id="" class='form-control my-2' placeholder='Retype password'>
                        </div>
                        <div class='form-group'>
                            <input type="submit" name='submit' value="submit" class='btn btn-outline-primary px-5'>
                            <a href="/login" class='font-weight-bold text-info mx-3'>| login..?</a>
                        </div>
                    </div>      
                </form>
            </div>
        </div>
    </div>
</body>
</html>