<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>shop'O'clock</title>
        <link rel="stylesheet" href="css/reset.css" />
        <!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
        <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'/> -->

        <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway:200,400,600" rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
      </head>
    <body>
<div class="container">
    <header class="navbar is-info">
        <div class="navbar-start">
            <a class="navbar-item" href="index.php">
                <h3 class="title is-3 has-text-white"> Pantouf'land </h3>
            </a>
        </div>
  
    <div class="navbar-end">

    <?php if(isLoggedIn()) : ?>
        <div class="navbar-item">
            <div class="tags has-addons">
                <span class="tag">Bienvenue</span>
                <span class="tag is-warning"><?= ucfirst(getUserFirstname()) ?> <?= (isAdmin()) ? "[Admin]" : "" ?></span>
            </div>
        </div>
        <a class="navbar-item" href="cart.php" >
            <span class="icon">
                <i class="fa fa-shopping-basket"></i>
            </span>
            <span>Mon panier &nbsp
            <?php if(getTotalitem() > 0 ) : ?>
                <span class="icon">
                    <i class=" tag">
                        <?php echo getTotalitem(); ?>
                    </i>
                </span>
            <?php endif; ?>
            </span>
      
        </a>
        
        <a class="navbar-item" href="account.php">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp Mon compte
        </a>
        <a class="navbar-item" href="logout.php">
            <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp Me déconnecter
        </a>
        <?php else : ?>
        <a class="navbar-item" href="signup.php">
            <i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp M'inscrire
        </a>
        <a class="navbar-item" href="login.php">
             <i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp Me connecter
        </a>
 
        <?php endif; ?>

 

        <div class="navbar-item has-dropdown is-hoverable">
    
            <?php if(isAdmin()) : ?>
                <a class="navbar-link">
                <i class="fa fa-shield" aria-hidden="true"></i>&nbsp back-office
                </a>
                <div class="navbar-dropdown">
                    <a href="admin.php?pg=produits" class="navbar-item">
                        <span class="icon"><i class="fa fa-product-hunt" aria-hidden="true"></i></span>
                        <span>Produits</span>
                    </a>
                    <a href="admin.php?pg=client" class="navbar-item">
                    <span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                        <span>Clients</span> 
                    </a>
                    <a href="admin.php?pg=commandes" class="navbar-item">
                    <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                        <span>Commandes</span> 
                    </a>
                    <hr class="navbar-divider">
                </div>
             <?php endif; ?>
      </div>
     </div>
  </header>
    <div class="content">
