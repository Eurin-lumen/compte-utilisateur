<?php 
// function of debug
function debug($variable){
    echo '<pre>' . print_r($variable, true). '</pre>';
}
// generation de token

function str_random($lenght){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle( str_repeat($alphabet, $lenght)), 0, $lenght);
}

// verification avant de se connecter a account

function logged_only(){
    if(session_start() == PHP_SESSION_NONE){
        session_start();
    } 
    if(isset($_SESSION['auth'])){
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à page ";
        header('Location: login.php');
        exit();
    }
}