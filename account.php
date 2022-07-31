<?php
require 'inc/functions.php';
// pour la bonne cause logged_only n'est pas appele
//logged_only(); garder un oeil sur les session aussi

if(!empty($_POST)){


    if($_POST['password']!= $_POST['password_confirm']){
        $_SESSION['flash']['danger'] =  " les mots de passe ne correspondent pas";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        require_once 'inc/db.php';

    $req = $pdo->prepare("UPDATE users SET password = ?");
    $req->execute(['password']);
    $_SESSION['flash']['success'] =  " Votre mot de passe à bien été mise à jour";





    }
}
require 'inc/header.php'; 



?>
<h1>Votre compte</h1>

<h3>Bonjour <?= $_SESSION['auth']->username; ?> </h3>

 <form action="" method="POST">
    .<div class="container">
        <form>
            <div class="form-group row">
                <label for="password" class="col-sm-1-12 col-form-label">Changer de mot de passe </label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder=" Changer votre mot de passe">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-1-12 col-form-label">Confirmation du mot de passe </label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder=" Confirmation de mot de passe">
                </div>
            </div>
          
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Changer mon mot de passe </button>
                </div>
            </div>
        </form>
    </div>
 </form>



<?php require 'inc/footer.php'; ?>
