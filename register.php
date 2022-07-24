<?php require 'inc/header.php'; ?>
<?php
// est ce que des données ont été posté ??

if (!empty($_POST)){
    // gestion d'erreur avec un tableau
    $errors = array();

    // verification username avec les expression régulière 

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z-0-9_]+$/', $_POST['username'])){
        $errors['username'] = "Votre pseudo n'est pas valide (alphanumérique)";

    }

    // verification  et validation email (format de l'email)

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Votre email n'est pas valide ";
    }
    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm'] ){
        $errors['password'] = "Votre mot de passe n'est pas valide";
    }

    debug($errors);

}

?>



<h1> S'inscrire</h1>

<form action="" method="POST">
    .<div class="container">
        <form>
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
                <label for="inputName" class="col-sm-1-12 col-form-label">Confirmer votre mot de passe:</label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe"  />
                </div> 
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Mot de passe :</label>
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
        </form>
    </div>
</form>











<?php require 'inc/footer.php'; ?>
