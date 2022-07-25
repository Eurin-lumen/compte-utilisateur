<?php 
// connexion automatique 
if(isset($_COOKIE['remember'])){
    require_once 'inc/db.php';
    $remember_token = $_COOKIE['remember'];
    $parts  = explode('/', $remember_token);
    $user_id = $parts[0];
    $req = $pdo->prepare("SELECT * FROM users WHERE id =?");
    $req->execute([$user_id]);
    $user = $req->fetch();
    if($user)
    {
       $expected =  $user_id. '=='. $user->remember_token. sha1($user_id. 'ratonlaveurs');
       if($expected == $remember_token){
        //action automatique de connection
        session_start();
        $_SESSION['auth'] = $user;
        header('Location:account.php');

      
       }

    }

}
session_destroy();
setcookie('remember', NULL , -1);
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "Vous etes maintenant déconnecter ";

header('Location:login.php');