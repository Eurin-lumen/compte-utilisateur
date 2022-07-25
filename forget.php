<?php
if(!empty($_POST) && !empty($_POST['email']) ){
    require_once 'inc/db.php';
    require_once 'inc/functions.php';                             // AND confirm_at IS NOT NULL
    $req = $pdo->prepare("SELECT * FROM users WHERE  email = ? ");
    $req->execute([ $_POST['email']]);
    $user  = $req->fetch();
    if($user){
        session_start();
        $reset_token = str_random(60);
        $pdo->prepare("UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?")->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = " les instructions du rappelle de mot de passe vous ont été envoyé par email ";
        mail($_POST['email'], "Réinitialisation de votre mot de passe", "Afin de reinitialisé votre mot de passe , Merci de cliquer sur ce lien \n\n http://localhost/user-account/reset.php?id={$user->id}&token=$reset_token");

        header('Location: login.php');
        exit();
    }
    else{
        $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cette email ";
    }
}


?>


<?php require 'inc/header.php'; ?>
<h1> Mot de passe oublié </h1>
<form action="" method="POST">
    <div class="container">
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Email:</label>
                <div class="col-sm-1-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre email"  />
                </div>
            </div>
            
             <br>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"> Se connecter </button>
                </div>
            </div>
    
    </div>
</form>