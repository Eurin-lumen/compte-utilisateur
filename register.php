<?php require 'inc/header.php'; ?>




<h1> S'inscrire</h1>

<form action="" method="POST">
    .<div class="container">
        <form>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Pseudo:</label>
                <div class="col-sm-1-12">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Votre pseudo"  required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label"> Email:</label>
                <div class="col-sm-1-12">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Votre email"  required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Confirmer votre mot de passe:</label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Votre mot de passe"  required/>
                </div> 
            </div>
            <div class="form-group row">
                <label for="inputName" class="col-sm-1-12 col-form-label">Mot de passe :</label>
                <div class="col-sm-1-12">
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Votre mot de passe"  required/>
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
