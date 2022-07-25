<?php
require_once 'inc/functions.php';                                                                 
reconnect_from_cookie();
if(isset($_SESSION['auth'])){
    header('Location: account.php');
        exit();
}
if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
    require_once 'inc/db.php';                                                      // AND confirm_at IS NOT NULL
    $req = $pdo->prepare("SELECT * FROM users WHERE ( username = :username OR email = :username)");
    $req->execute(['username' => $_POST['username']]);
    $user  = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = " Vous etes maintenant connecté ";
        if($_POST['remember']){
            $remember_token = str_random(250);
            $pdo->prepare("UPDATE  users SET remember_token= ?  WHERE id = ? ")->execute([$remember_token, $user->id]);
            // garder dans les cookiess
            setcookie('remember', $user->id. '=='. $remember_token. sha1($user->id. 'ratonlaveurs'). time() + 60*60*24*7);
        }
        
        
    }
    else{
        $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect";
    }
}



?>
<?php require 'inc/header.php'; ?>
<h1> Se connecter </h1>
<form action="" method="POST">
    <div class="container">
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Pseudo ou Email:</label>
                <div class="col-sm-1-12">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Votre pseudo"  />
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Mot de passe: <a href="forget.php">(j'ai oublié mon mot de passe)</a> </label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe"  />
                </div> 
            </div>
            .<div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="remember" id="" value="1" checked>
                Se souvenir de moi
              </label>
            </div>
            
             <br>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"> Se connecter </button>
                </div>
            </div>
    
    </div>
</form>






 


<?php require 'inc/footer.php'; ?>
