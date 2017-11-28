<main>

<div class="columns  is-centered">
  <div class="column is-qaurter is-narrow">
    <p class="bd-notification is-info">
	<?php if(isset($message) && $message != "") : ?>
		<div class="notification is-danger">
			<strong>Erreur</strong> <?= $message ?>
		</div>
	<?php endif; ?>
	<form action="login.php" method="post">
		<div class="field">
		<p class="control has-icons-left has-icons-right">
			<input class="input" name="email" type="email" placeholder="Email" value="<?= (isset($_POST["email"])) ? $_POST["email"]: "" ?>">
			<span class="icon is-small is-left">
			<i class="fa fa-envelope"></i>
			</span>
 
		</p>
		</div>
		<div class="field">
		<p class="control has-icons-left">
			<input class="input" name="password" type="password" placeholder="Password" value="<?= (isset($_POST["password"])) ? $_POST["password"] : "" ?>"
>
			<span class="icon is-small is-left">
			<i class="fa fa-lock"></i>
			</span>
		</p>
		</div>
		<div class="field">
		<p class="control ">
			<button class="button is-success " name="login">
				connexion
			</button>
		</p>
		</div>
	</form>
    </p>
  </div>
</div>



</main>
