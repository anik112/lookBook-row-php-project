
<?php 

// get url and trim url
$url = trim( parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/' );

session_start(); // Start the session.

// set all routes
$routes = [
    'deshbord' => './views/deshbord.php',
    'login' => './views/login.php',
    'logout' => './views/logout.php',
    'profile' => './views/profile.php',
    'friends' => './views/friendsList.php',
    'posts' => './views/createPost.php',
    'createTable' => './database/createTable.php',
    'registration' => './views/registration.php',
    'functiontest' => './function/testFunction.php',
    'pubFriends' => './views/friendsList.php',
    'gallery' => './views/myGallery.php',
    'search' => './views/search.php',
    'changeImage' => './core/changeProfileImage.php',
    'test' => './views/test.php',
    'deletePost' => './core/deletePost.php',
    'addFriend' => './core/addFriend.php',
    'unFriend' => './core/unFriend.php',
    'writeComment' => './core/writeComment.php',
    'love' => './core/addLove.php',
    'notification' => './views/notification.php',
    'active' => './views/chat.php',
    'massage' => './core/sendMassage.php',
    'chatTemp' => './views/chatTemp.php'
];

 
$basedPage='./views/login.php';

// echo $url;

if($url == null){
    require $basedPage;
}else{
    if(isset($_SESSION['userId']) > 0 || $url == 'registration'){
        // check request url have in this routes
        if(array_key_exists($url, $routes)){
            require $routes[$url];
        }else{
            require '404error.html'; // otherwise call 404 page
        }
    }else{
        require "$basedPage"; // otherwise call based page
    }
}

if(!empty($_GET['url'])){
    $requestURL=$_GET['url'];
}

?>