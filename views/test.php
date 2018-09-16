<?php

// if(isset($_GET['submit'])){
//     echo 'submit</br>';
//     if(isset($_FILES['file'])){
//         print_r($_FILES['file']);
//     }
// }
?>

<!-- <form action="../views/test2.php" method="POST" enctype="multipart/form-data">
            <h4>Image: </h4><input type="file" name='file' id="">
            <input type="submit" name='submit' value="Change" class='btn btn-outline-primary'>
</form> -->


<?php
// if (isset ($name)) {
//     if (!empty($name)) {

//     $location = 'uploads/';

//     if  (move_uploaded_file($tmp_name, $location.$name)){
//         echo 'Uploaded';    
//         }

//         } else {
//           echo 'please choose a file';
//           }
//     }
// }

/*
<div class='card border-light mt-5'>
            <div class='card-header text-secondary'><h3>Friends...</h3></div>
        </div>
        <div class='row scroll-pp' id='custom-scroll'>
            <div class='col-lg-12'>
                <div class='d-frnd-list'>
                   // <?php foreach($frindes as $frinde):?>
                        <div class="card bg-primary my-2 mx-1 pro-card" style="width:170px;"> <!-- same width with image -->
                          <a href="profile?id=<?php //$frinde->id;?>">
                            <img class="card-img-top card-pro-img " src="<?php //($frinde->image!=null?$frinde->image:'./images/avatar.png');?>" alt="Card image cap">
                            <div class="card-body py-2" style='text-align: center;'>
                                <h4 class="card-title text-light"><?php //$frinde->sur_name;?></h4>
                            </div>
                          </a>
                        </div>
                    <?php // endforeach;?>
                </div>
            </div>
		</div>
		
		*/


// if(isset($_SESSION['image'])){$oldImage=$_SESSION['image'];} // set image from session.
// $oldImgName=substr($oldImage,10); // get orginal image name.

// $target_dir = "../images/"; // current image dir
// $OldTarget_dir = "../images/postImage/"; // set old image dir.

// if( rename( $OldTarget_dir.$oldImage , $oldImage)){
//     echo 'moved!';
//    } else {
//     echo 'failed';
//    }



?>

<!-- <form action="../views/test2.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"><br><br>
    <input type="submit" name="submit" value="Submit">
</form> -->


<!-- <table>
<tr>
<td>hello</td>
<td>hello</td>
</tr>
<tr>
<td>anik</td>
<td>anik</td>
</tr>

</table> -->


<?php
	$name = ''; $type = ''; $size = ''; $error = '';
	function compress_image($source_url, $destination_url, $quality) {

		$info = getimagesize($source_url);

    		if ($info['mime'] == 'image/jpeg')
                    $image = imagecreatefromjpeg($source_url);
                    

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($source_url);

   		elseif ($info['mime'] == 'image/png')
                    $image = imagecreatefrompng($source_url);
                    
            print_r($image);
            echo "</br>";

            imagejpeg($image, $destination_url, $quality);
            echo $destination_url.'</br>';
		return $destination_url;
	}

	if ($_POST) {

    		if ($_FILES["file"]["error"] > 0) {
        			$error = $_FILES["file"]["error"];
    		} 
    		else if (($_FILES["file"]["type"] == "image/gif") || 
			($_FILES["file"]["type"] == "image/jpeg") || 
			($_FILES["file"]["type"] == "image/png") || 
			($_FILES["file"]["type"] == "image/pjpeg")) {

        			$url = 'destination .jpg';

                    $filename = compress_image($_FILES["file"]["tmp_name"], $url, 80);
                    echo $filename;
        			$buffer = file_get_contents($url);

        	// 		/* Force download dialog... */
        	// 		header("Content-Type: application/force-download");
        	// 		header("Content-Type: application/octet-stream");
        	// 		header("Content-Type: application/download");

			// /* Don't allow caching... */
        	// 		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

        	// 		/* Set data type, size and filename */
        	// 		header("Content-Type: application/octet-stream");
        	// 		header("Content-Transfer-Encoding: binary");
        	// 		header("Content-Length: " . strlen($buffer));
        	// 		header("Content-Disposition: attachment; filename=$url");

        			/* Send our file... */
        			echo $buffer;
    		}else {
        			$error = "Uploaded image should be jpg or gif or png";
    		}
	}
?>
<html>
    	<head>
        		<title>Php code compress the image</title>
    	</head>
    	<body>

		<div class="message">
                    	<?php
                    		if($_POST){
                        		if ($error) {
                            		?>
                            		<label class="error"><?php echo $error; ?></label>
                        <?php
                            		}
                        	}
                    	?>
                	</div>
		<fieldset class="well">
            	    	<legend>Upload Image:</legend>                
			<form action="" name="myform" id="myform" method="post" enctype="multipart/form-data">
				<ul>
			            	<li>
						<label>Upload:</label>
			                                <input type="file" name="file" id="file"/>
					</li>
					<li>
						<input type="submit" name="submit" id="submit" class="submit btn-success"/>
					</li>
				</ul>
			</form>
		</fieldset>
	</body>
</html>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

<!-- header part -->
<header class='col-lg-12 bg-dark text-light clearfix px-5 py-5'>
  <!-- left side, for page name & others -->
  <div class='float-left'>
    <div class='card my-5 mx-5 bg-dark'>
      <div class='card-body bg-dark text-light'>
        <h1>Deshbord</h1>
        <h4>Statistics</h4>
      </div>
    </div>
  </div>
  <!-- right side, for nav bar & pro pic -->
  <div class='float-right'>
    <div class='row'>
      <div class='col-lg-12'>
        <nav class="navbar navbar-default float-right">
          <ul class='nav navbar-nav d-inline-block'>
          <li class=''><a href="deshbord" class='active text-light'><h4>Home</h4></a></li>
          <li><a href="profile" class='text-light'><h4>Profile</h4></a></li>
          <li><a href="pubFriends" class='text-light'><h4>Friends</h4></a></li>
          <li><a href="" class='text-light'><h4>Notifcation</h4></a></li>
          <li><a href="" class='text-light'><h4>Actvity</h4></a></li>
          <li><img src='<?php if($image != null){
                        echo $image;
                    }else{
                        echo './images/avatar.png';
                    }?>' alt="profile pic" srcset="" class="nav-bar-img"></li>
          </ul>
        </nav>
      </div>
  </div>
  <!-- this col for search bar -->
  <div class='row my-3'>
    <div class='col-lg-12 float-right'>
        <form action="search" method="get">
            <div class="input-group">
            <input type="text" name='searchContent' class="form-control" placeholder="Search friend by email, name, number...">
                <div class="input-group-btn">
                    <input type="submit" name='submit' value="Search" class='btn btn-primary' style='border-top-left-radius: 0px; border-bottom-left-radius: 0px;'>
                </div>
            </div>
        </form> 
    </div>
  </div>
  </div>
</header>
<!-- end header part -->



<?php if($headerName == 'user'):?>


<!-- header part for user panel -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$titles;?></title>
    <link rel="stylesheet" href="../public/bootstrap.min.css">
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>
    
<!-- nav bar -->
    <nav class='navbar navbar-default navbar-fixed-top top bg-dark  py-3 px-3'>
        <div class='float-left'>
            <div class='card my-3 mx-3 bg-dark'>
                <div class='card-body bg-dark text-light'>
                    <h4><?=$titles;?></h4>
                </div>
            </div>
        </div>
        <div class='float-right'>
            <a class='text-light mx-3' href="deshbord">Home</a>
            <a class='text-light mx-3' href="profile">Show Me</a>
            <a class='text-light mx-3' href="friends">Friends</a>
            <a class='text-light mx-3' href="posts">Create Post</a>
            <a class='text-light mx-3' href="gallery">Gallery</a>
            <a class='text-light mx-3' href="logout">Logout</a>
            <img src='<?php if($image != null){
                        echo $image;
                    }else{
                        echo './images/avatar.png';
                    }?>' alt="profile pic" srcset="" class="nav-bar-img">
        </div>
    </nav>

<?php endif; ?>




<?php if($footerName == 'user'): ?>
<!-- footer part -->
<div class='row mt-5'>
    <div class='col-lg-12'>
        <footer class='bg-dark text-light'>
        <div class='row'>
            <div class='col-lg-12 my-5 mx-5'>
            <h1>paulanik112@gmail.com</h1>
            </div>
        </div>
        </footer>
    </div>
</div>

<!-- footer -->
    <script src="../public/jquery-3.3.1.min.js"></script>
    <script src="../public/bootstrap.min.js"></script>
    <script src="../public/script.js"></script>
</body>
</html>
<?php endif; ?>


<?php if($footerName == 'public'): ?>