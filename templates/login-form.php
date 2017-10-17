<main id="login" class="container">
	<form class="form-horizontal col-sm-8 col-sm-offset-2" action="" method="post">
		<?php if(isset($message) && $message != "") : ?>

		<?php endif; ?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="email">Email</label>
			<div class="col-sm-10">
                <input
    				type="text"
    				class="form-control"
    				id="email"
    				name="email"
    				value="<?= (isset($_POST["email"]))?$_POST["email"]:"" ?>"
    				placeholder="email">
            </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="password">Mot de passe</label>
			<div class="col-sm-10">
                <input
    				type="password"
    				class="form-control"
    				id="password"
    				name="password"
    				value="<?= (isset($_POST["password"]))?$_POST["password"]:"" ?>"
    				placeholder ="password">
            </div>
		</div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button  class="btn btn-default" type="submit" name="login">connexion</button>
            </div>
        </div>
	</form>
</main>
