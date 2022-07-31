<?php
require 'inc/functions.php';
require_once 'inc/db.php';
// est ce que des données ont été posté ??

if (!empty($_POST)){
    // gestion d'erreur avec un tableau
    $errors = array();
    
    // verification username avec les expression régulière 
    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";
    }else{
        // est ce que un utilisateur existe en avance ? dans la base de donnée
        $req = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $req->execute([$_POST['username']]);
        //fetch permet de récupérer le premier enrégistrement 
        $user = $req->fetch();
        if($user){
            $errors['username'] = "Votre pseudo existe déjà"; 
        }    
    }

    // verification  et validation email (format de l'email)
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email n'est pas valide ";
    }else{
        // est ce que l'email  existe en avance ? dans la base de donnée
        $req = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $req->execute([$_POST['email']]);
        //fetch permet de récupérer le premier enrégistrement 
        $user = $req->fetch();
        if($user){
            $errors['email'] = "Votre email existe déjà"; 
        }
        
    }
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'] ){
        $errors['password'] = "Votre mot de passe n'est pas valide";
    }

    if(empty($errors)){
        // Requete préparer 
        $req = $pdo->prepare("INSERT INTO users SET username = ?, email = ? , password = ?, confirmation_token = ?");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);
        $req->execute([$_POST['username'],$_POST['email'],$password,$token]);
        $user_id = $pdo->lastInsertId();
        mail($_POST['email'], "Confirmation de votre compte", "Afin de valider votre compte, Merci de cliquer sur ce lien \n\n http://localhost/user-account/confirm.php?id=$user_id&token=$token");
        $_SESSION['flash']['success'] = "Un email de confirmation vou a été envoyé pour valider votre compte";
        header('Location:login.php');
        exit();
        
    }

//   debug($errors);

}

?>

<?php require 'inc/header.php'; ?>

<h1> S'inscrire</h1>
<?php if(!empty($errors)):?>
 <div class="alert alert-danger">
    <p>Vous n'avez pas rempli le formulaire correctement </p>
    <ul>
        <?php foreach($errors as $error):?>
            <li><?= $error; ?></li>
        <?php endforeach ?> 
    </ul>
 </div>

<?php endif ?>

<form action="" method="POST">
    <div class="container">
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Pseudo:</label>
                <div class="col-sm-1-12">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Votre pseudo"  />
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label"> Email:</label>
                <div class="col-sm-1-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre email"  />
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Mot mot de passe:</label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe"  />
                </div> 
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Confirmer votre mot de passe :</label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Votre mot de passe"  />
                </div>
            </div>
             <br>
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Je m'inscris</button>
                </div>
            </div>
    
    </div>
</form>











<?php require 'inc/footer.php'; ?>
