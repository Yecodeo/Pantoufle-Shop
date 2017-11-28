<div>
<div class="notification is-primary">
    <p class="title"> Inscription </p>
</div>

<div class="columns is-mobile is-centered">
  <div class="column is-half is-narrow">
      <?php if (!empty($errors) && isset($errors)) : ?>
          <div class="notification is-danger">
              <?php
                foreach ($errors as $value){
                    echo $value . '</br>';
                }
              ?>
          </div>
      <?php endif ?>

    <form action="" method="post">
        <div class="field">
            <label class="label">Nom</label>
            <div class="control">
                <input class="input" 
                       type="text" 
                       name="firstName" 
                       placeholder="e.g Smith"
                       value="<?= (isset($_POST["firstName"])) ? $_POST["firstName"] : "" ?>">
            </div>
        </div>

        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
                <input class="input" 
                       type="text" 
                       placeholder="e.g Alex"
                       name="lastName"
                       value="<?= (isset($_POST["lastName"]))?$_POST["lastName"]:"" ?>"
                       >
            </div>
        </div>
        <div class="field">
            <label class="label">E-mail</label>
            <div class="control">
                <input class="input" 
                       type="email" 
                       placeholder="e.g. alexsmith@gmail.com"
                       name="email"
                       value="<?= (isset($_POST["email"]))?$_POST["email"]:"" ?>"
                       >
            </div>
        </div>
        <div class="field">
            <label class="label">Mot de passe</label>
            <div class="control">
                <input class="input" 
                       type="password" 
                       placeholder=""
                       name="password"
                       value="<?= (isset($_POST["password"]))?$_POST["password"]:"" ?>"
                       >
            </div>
        </div>
        <div class="field">
            <label class="label">Confirmation de mot de passe</label>
            <div class="control">
                <input class="input" 
                       type="password" 
                       placeholder=""
                       name="confirmPassword"
                       value="<?= (isset($_POST["confirmPassword"]))?$_POST["confirmPassword"]:"" ?>"
                       >
            </div>
        </div>
    <div class="field">
        <div class="control">
            <button class="button is-primary" name="signup">Je m'inscris</button>
        </div>
    </div>
    </form>
  </div>
</div>
</div>
