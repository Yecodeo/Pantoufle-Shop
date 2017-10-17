<main id="signup" class="container">
	<h2>Inscription</h2>
    <div class="row">
    	<form id="signup-form" class="col-sm-6 col-sm-offset-3 form-horizontal" action="" method="post">
    	    <div class="alert <?= (!empty($errors))?"alert-danger":"" ?>">
    	        <?php foreach ($errors as $error) : ?>
    	            <p><?= $error ?></p>
    	        <?php endforeach; ?>
    	    </div>
    		<!-- firstname, lastname, email, password, confirmpassword -->
    		<div class="form-group">
    			<label class="control-label" for="firstName">Prénom</label>
    			<input
                    type="text"
                    id="firstName"
                    class="form-control"
                    name="firstName"
                    value="<?= (isset($_POST["firstName"]))?$_POST["firstName"]:"" ?>"
                    placeholder="votre prenom">
    		</div>
    		<div class="form-group">
    			<label class="control-label" for="lastName">Nom</label>
    			<input
                    type="text"
                    id="lastName"
                    class="form-control"
                    name="lastName"
                    value="<?= (isset($_POST["lastName"]))?$_POST["lastName"]:"" ?>"
                    placeholder="votre nom de famille">
    		</div>
    		<div class="form-group">
    			<label class="control-label" for="email">Email</label>
    			<input
                    type="text"
                    id="email"
                    class="form-control"
                    name="email"
                    value="<?= (isset($_POST["email"]))?$_POST["email"]:"" ?>"
                    placeholder="votre adresse mail valide">
    		</div>
    		<div class="form-group">
    			<label class="control-label" for="password">Mot de passe</label>
    			<input
                    type="password"
                    id="password"
                    class="form-control"
                    name="password"
                    value="<?= (isset($_POST["password"]))?$_POST["password"]:"" ?>"
                    placeholder ="8 caractères min">
    		</div>
    		<div class="form-group">
    			<label class="control-label" for="confirmPassword">Confirmer</label>
    			<input
                    type="password"
                    id="confirmPassword"
                    class="form-control"
                    name="confirmPassword"
                    value="<?= (isset($_POST["confirmPassword"]))?$_POST["confirmPassword"]:"" ?>"
                    placeholder ="confirmez le mot de passe">
    		</div>
    	    <button class="pull-right" type="submit" name="signup">Je m'inscris</button>
    	</form>
    </div>
</main>
