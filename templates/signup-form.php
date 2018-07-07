<?php
/**
 * page d'inscription
 * @author afjnik hassan
 */
?>

<div>
<div class="notification is-primary">
    <p class="title"> Inscription </p>
</div>

<div class="columns is-mobile is-centered">
  <div class="column is-half is-narrow">
    <form action="">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
              <input class="input"
                     type="text"
                     name="firstName"
                     placeholder="e.g Alex Smith"
                     value="<?= (isset($_POST["firstName"])) ? $_POST["firstName"] : "" ?>"
              >
            </div>
        </div>
        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
              <input class="input"
                 type="text"
                 placeholder="e.g. alexsmith@gmail.com"
                 name="lastName"
                 value="<?= (isset($_POST["lastName"]))?$_POST["lastName"]:"" ?>"
               >
            </div>
        </div>
        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
                <input
                   class="input"
                   type="email"
                   placeholder="e.g. alexsmith@gmail.com"
                   name="email"
                   value="<?= (isset($_POST["email"]))?$_POST["email"]:"" ?>"
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
                <input
                   class="input"
                   type="password"
                   placeholder="e.g. alexsmith@gmail.com"
                   name="password"
                   value="<?= (isset($_POST["password"]))?$_POST["password"]:"" ?>"
                >
            </div>
        </div>
        <div class="field">
            <label class="label">Prénom</label>
            <div class="control">
                <input
                  class="input"
                  type="password"
                  placeholder="e.g. alexsmith@gmail.com"
                  name="confirmPassword"
                  value="<?= (isset($_POST["confirmPassword"]))?$_POST["confirmPassword"]:"" ?>"
                 >
            </div>
        </div>
    </form>
  </div>
</div>
</div>
