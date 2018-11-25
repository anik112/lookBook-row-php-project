
<!-- call header part -->
<?php


// call database page
require './database/dbConnect.php';

// call database function
require './function/databaseFunction.php';

$pageName='Deshbord';
// echo $_SESSION['userId'];
require 'header.php';
?>

<div>
    <img src="../images/temp/maintenance-2422173_1920.png" alt="" srcset="" style="width: 100%;height: 100%;"/>
</div>

<!-- call footer part -->
<?php require 'footer.php';?>