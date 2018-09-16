<?php

if(isset($_POST['submit'])){
    // echo 'submit </br>';
    // if(isset($_FILES['file']['name'])){
    //     echo $_FILES['file']['name'];
    // }

    $target_dir = "../images/"; 

    echo $target_dir.rand(1,100).basename($_FILES['file']['name']);
}


// if(isset($_POST['submit'])){

//     print_r($_FILES['file']);
//     echo '</br>';

//     $name = $_FILES["file"]["name"];
//     //$size = $_FILES['file']['size']
//     //$type = $_FILES['file']['type']
//     echo $name.'</br>';
    
//     $tmp_name = $_FILES['file']['tmp_name'];
    
//     echo $tmp_name.'</br>';
    
//     $error = $_FILES['file']['error'];
    
//     echo $error;
//     }