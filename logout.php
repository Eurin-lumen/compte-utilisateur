<?php 
session_destroy();
unset($_SESSION['auth']);
$_SESSION['flash']['sucess'] = "Vous etes maintenant déconnecter ";

header('Location:login.php');