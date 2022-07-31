<?php
// verification post

if(isset($_GET['id']) && isset($_GET['token'])){
    require 'inc/db.php';
    require 'inc/functions.php';
    $req = $pdo->prepare("SELECT * FROM users  WHERE id = ? AND reset_token = ? AND reset_at > DATE_SUB(NOW(),INTERVAL 30 MINUTE)");
    $req->execute([$_get['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare("UPDATE users SET password = ?, reset_at = NULL, reset_token= NULL")->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = "Votre mot de passe fut réinitialisé avec succès";
                // connecté l'utilisateur 
                $_SESSION['auth']  = $user; 
                header('Location:account.php');

            }
        }
        

    }else{
        session_start();
        $_SESSION['flash']['danger'] = "ce token n'est pas valide";

        header('Location : login.php');
        exit();
    }

}else{
    header('Location:login.php');
    exit();
}


?>
<?php require 'inc/header.php'; ?>
<h1> Reinitialisation du mot de passe </h1>
<form action="" method="POST">
    <div class="container">
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Nouveau Mot de passe: </label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder=" Nouveau mot de passe"  />
                </div> 
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Confirmation du Mot de passe:  </label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Confirmation de votre mot de passe"  />
                </div> 
            </div>
            
             <br>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Reinitialiser mon mot de passe </button>
                </div>
            </div>
    
    </div>
</form>






 


<?php require 'inc/footer.php'; ?>
