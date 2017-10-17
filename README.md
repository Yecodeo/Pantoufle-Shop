
# Challenge Full Back-office

## Objectifs
Bon, vous avez maintenant officiellement suffisament d'outils pour développer un petit site dynamique (relativement) complet, avec compte client et le back office qui va avec.  
Pour l'instant, ce back-office existe, son accès est sécurisé mais c'est un bébé!
Il faut le faire grandir, donner au patron de Pantouf'land les outils qui l'aideront à couvrir la terre de ses chaussons.
Alors c'est parti!  


## Instructions

Ce challenge est faisable en équipe, ou peut être pris comme un projet d'entraînement, à faire seul, très complet puisqu'il vous permet de revoir tout ce qu'on a fait jusqu'ici.  
Beaucoup de choses à faire, donc, mais vous pouvez partager, et/ou étaler dans le temps.  

Si ça vous paraît insurmontable, concentrez vous sur "finir la page admin" et essayez de rendre fonctionnels les boutons d'admin des produits l'un après l'autre.  

Voilà ce qui reste à faire sur ce gros bébé:  
- D'abord, développer le plugin de paiement des commandes avec PayPal (... mais non je blague. Enfin sauf si vous êtes d'attaque.)    

#### Finir la page admin
   - un sous-menu admin (Produits, Clients, Commandes)
   - afficher la liste des produits sous forme d'un tableau.
   - y insérer les boutons qui seront utilisés pour la partie suivante:

#### Administration des produits:
Ce volet est assez costaud. Les tâches 3 et 4 doivent de préférence être réalisées ensembles, mais il y a du travail pour 2 personnes ici.
  1. un bouton "consulter" qui emmène sur la page de présentation d'un produit. Puis un bouton "modifier ce produit" qui doit être accessible *seulement aux admins* sur la page de présentation du produit, et mener vers le form de modification, cf. 3.
  2. bouton "supprimer"  
  3. Un bouton "créer un produit" (en dehors du tableau de produits)
  4. bouton "modifier" pour lequel on réutilisera le même formulaire que pour le 3. (ce sont les mêmes données à saisir...)
     écrire le script de traitement de ces modifications (allez consulter la modification d'un profil client... Ca y ressemble en tout cas)

  BONUS. quelles modifications faut-il apporter aux données et au code pour afficher les 3 derniers produits créés, dans le dashboard admin ?


#### Administration des utilisateurs:
  1. consulter la liste des clients
  2. ajouter un admin

#### Administration des commandes:
1. consulter la liste des commandes
2. On souhaite pouvoir enregistrer la date de validation d'une commande et pouvoir marquer son état:
   - validée (enregistrée par le client)
   - en préparation (indiqué par l'admin)
   - terminée (indiqué par l'admin)  

Modifiez la base de données, et l'affichage des commandes pour le client, et pour l'admin (qui voudra pouvoir consulter les "commandes en cours" ou les "commandes terminées" par exemple)

#### Front dev - révisions
1. Bootstrap this!  
- Basez vous sur le modèle de dashboard proposé en challenge Bootstrap la semaine dernière (cf le dossier /elements) pour proposer un design responsive du back-office.
- proposez plutôt un menu déroulant pour les fonctionnalités d'authentification (login/logout, mon compte)

2. Validate this!  
Vous avez appris à vérifier à l'aide de jQuery la saisie de champs dans le formulaire avant sa soumission, pendant la saisie.  
Pour que l'inscription soit la plus fluide possible, aidez vos futurs clients à s'inscrire sur votre site en vérifiant le formulaire d'inscription pendant que le visiteur le remplit.  
Rappel des contraintes:  
  - le nom et le prenom doivent faire au moins 3 caractères de long
  - l'email saisi doit être valide
  - le mot de passe doit faire au moins 8 caractères, et la confirmation doit être identique au mot de passe
