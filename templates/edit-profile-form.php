<?php 
$error;
$success;

if (!isLoggedIn()){
	header('Location: index.php');
} 
	else 
{
	if (isset($_POST) && !empty($_POST)) {
		if (!empty($_POST['old_password'])){
				$old = verifPassword($_POST['id']);

				if (password_verify($_POST['old_password'], $old['password'])) {
					if ($_POST['new_password'] == $_POST['new_password_confirm'] && !empty($_POST['new_password']) && !empty($_POST['new_password_confirm'])){
						$_POST['password'] = $_POST['new_password'];
						unset($_POST['old_password']);	
						unset($_POST['new_password']);	
						unset($_POST['new_password_confirm']);	
						
 						if (updateProfile($_POST)){
							 $success = true;
						
						 } else {
							 $success = false;
						 }

					} else {
						$error[] = 'Les nouveaux mot de passe ne correspondent pas !';
					}
				}
		} else {
				$error[] = 'Votre mot de passe actuel est vide';
		}
	}
}

if (!empty($_GET['id']) && isset($_GET['id']) ){
	$user = getUser($_GET['id']);
}
?>

<div class="notification is-success">
	<p class="title">Edition de votre profile </p>
</div>

<main>
<div class="columns is-mobile is-centered">
  <div class="column is-half is-narrow">
				<?php if (isset($error) && !empty($error)) : ?>
						<div class="notification is-danger">
								<strong>Erreur</strong>
								<?php 
									foreach ($error as $value) {
										echo $value;
									}
								?> 
						</div>
				<?php endif; ?>
				<?php if (isset($success) && $success) : ?>
						<div class="notification is-info">
								<strong>Success</strong> Enregistrement réussi !
						</div>
				<?php endif; ?>
	<form action="" method="post">
		<div class="field">
			<label class="label">Nom</label>
			<div class="control has-icons-left">
				<input class="input" type="text" name="first_name" value="<?= $user['first_name'] ?>">
				<span class="icon is-small is-left">
					<i class="fa fa-user"></i>
				</span>
			</div>
		</div>

		<div class="field">
			<label class="label">Prénom</label>
			<div class="control has-icons-left">
				<input class="input" type="text" name="last_name" value="<?= $user['last_name'] ?>">
				<input type="hidden" name="id" value="<?= $user['id'] ?>">
				<span class="icon is-small is-left">
					<i class="fa fa-user"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">E-mail</label>
			<div class="control has-icons-left">
				<input class="input" type="email" name="email" value="<?= $user['email'] ?>">
				<span class="icon is-small is-left">
					<i class="fa fa-envelope-o"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Adresse</label>
			<div class="control">
					<textarea class="textarea"  name="address"   cols="60" rows="5"><?= $user['address'] ?>
					</textarea>
			</div>
		</div>
		<div class="field">
			<label class="label">Code postal</label>
			<div class="control has-icons-left">
				<input class="input" type="number" name="zipcode" value="<?= $user['zipcode'] ?>">
				<span class="icon is-small is-left">
					<i class="fa  fa-building-o"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Ville</label>
			<div class="control has-icons-left">
				<input class="input" type="text" name="city" value="<?= $user['city'] ?>">
				<span class="icon is-small is-left">
					<i class="fa  fa-building-o"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Téléphone</label>
			<div class="control has-icons-left">
				<input class="input" type="text" name="phone" value="<?= $user['phone'] ?>">
				<span class="icon is-small is-left">
					<i class="fa fa-phone"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Ancien mot de passe</label>
			<div class="control has-icons-left">
				<input class="input" type="password" name="old_password" value="admin">
				<span class="icon is-small is-left">
					<i class="fa fa-key"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Nouveau mot de passe</label>
			<div class="control has-icons-left">
				<input class="input" type="password" name="new_password" value="admin">
				<span class="icon is-small is-left">
					<i class="fa fa-key"></i>
				</span>
			</div>
		</div>
		<div class="field">
			<label class="label">Confirmation de mot de passe</label>
			<div class="control has-icons-left">
				<input class="input" type="password" name="new_password_confirm" value="admin">
				<span class="icon is-small is-left">
					<i class="fa fa-key"></i>
				</span>
			</div>
		</div>
		<div class="field">
				<button class="button is-info">
					<span class="icon is-small">
						<i class="fa fa-check"></i>
					</span>
					<span>Save</span>
				</button>
		</div>
	</form>
  </div>
</div>



</main>
