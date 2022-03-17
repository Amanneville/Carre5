# Marche à suivre du projet

https://www.meistertask.com/app/project/tf34fhWU/carre5

- C'est un projet de gestion de catalogue sans stocks

## Mise en place

- Définir les besoins du client/projet/consommateurs
- Définir une marche à suivre pour le projet
- On a mis en place une base de données simple
  - MySQL
## OK - Etablir la connexion entre la BDD et l'application
<!-- db.php & env.php -->
  - PDO : PHP Data Objects

## UX

Dans un but de proposer une expérience utilisateur optimale, on va mettre en place un suivi des erreurs rigoureux. Il y aura à chaque étape des messages d'informations sur les processus rencontrés.
Ceci inclut :

- Des messages d'erreur (quand c'est le cas)
- Des messages de confirmation
- Des messages d'avertissement

Ces messages seront mis en place via un système de redirection avec des requêtes GET contenant l'objet des messages.

## CRUD

Un CRUD est un principe de programmation qui concerne la manipulation de données à travers plusieurs actions : La création, la lecture, la modification et la suppression. Dans notre projet nous réalisons un CRUD simple sur des produits avec un upload d'images.
D'une manière générale lorsque nous allons manipuler les produits sur la BDD via des requêtes POST, nous utiliserons deux fichiers : un fichier principal qui permet de formuler la manipulation à mettre en place, et un second fichier qui va exécuter la manipulation définie dans le premier fichier. Ces fichiers s'appelleront de la même façon à l'exception que le second fichier ajoutera un \_post à son nom (avant l'extension .php bien entendu).

- C - Create
  > Pour la création on passe par deux étapes majeures :
  > Le formulaire et le processing du formulaire.
  - Le formulaire situé sur la page 'add-products.php' a besoin de :
    1. Une balise form `<form></form>` avec une méthode et une action. Dans le cas d'un upload de fichiers, il nécessite aussi un enctype.
    2. Des input nommés (avec des name) afin que PHP puisse les identifier lors de la requête.
    3. Un moyen de soumission du formulaire (button ou input de type submit).
  - Processing du formulaire 'situé sur la page add-products_post.php'. :
    1. Vérification de la validité des informations du formulaire. (Les champs requis sont-ils remplis ? Sont-ils logiquement valides ?(date de réservation antidatée par exemple ?))
    2. Ajout de sécurité pour le lien formulaire-base de données. (Assainissement des variables lors de leur déclaration (htmlspecialchars()), Préparation des requêtes SQL avec PDO, <strike>Mise en place de token CSRF</strike>)
    3. Ajout des informations dans la base de données.(Execution de notre requête SQL d'insert (INSERT INTO xxx(yyy) VALUES zzz))
- R - Read

  > Ici pas de manipulation des produits, seulement de l'affichage.
  > La lecture concerne l'affichage des données présentes dans la base de données.
  > Cette étape passe généralement par deux pages : Une page qui permet l'affichage de tous/plusieurs éléments, une page qui permet l'affichage d'un seul élément.

  - La lecture de tous les éléments se fera sur la page d'accueil (index.php)
    La page sera segmentée en deux parties représentées par un fragment de page.

    1.  La requête SQL s'effectue sur le fragment de page \_view-products.php et assigne la récupération à un tableau associatif (array). Le fragment de page permet de ne pas mélanger logique et affichage pur.

    2.  L'affichage des données se fait directement sur index.php avec une boucle `foreach()`.

  - La lecture des éléments individuels se fait via un lien depuis la page d'index. Elle suivra le pattern suivant : Il existe une page product.php qui contient une mise en page de produit, auquel on ajouter les valeurs du produit récupéré en base de données grâce à l'id transmis dans l'URL. La page en elle-même est aussi segmentée en deux parties représentées par un fragment de page.

    1.  La requête SQL s'effectue sur le fragment de page \_view-single.php et assigne la récupération à un tableau associatif (array). Le fragment de page permet de ne pas mélanger logique et affichage pur. On utilisera une requête préparée cette fois étant donné qu'il y a une variable transmise à la BDD pour la requête.

    2.  L'affichage des données se fait directement sur product.php.

- U - Update

  > L'update consiste en un mélange entre l'affichage et l'ajout puisqu'il s'agit de modifier des informations depuis l'affichage d'un élément existant. On partira de l'affichage individuel pour le modifier en formulaire.

  - On duplique la page d'affichage product.php pour créer la page edit-products.php et on procède en deux étapes :

    - On modifie la page d'affichage afin qu'elle devienne un formulaire. Tous les champs h3,p et autres deviennent des input avec un type leur correspondant(à l'exception de la description qui devient un textarea). Les valeurs affichées se déplacent dans l'attribut value (à l'exception de la description qui reste à l'intérieur de la balise `<textarea></textarea>`). Le bouton servant de lien vers la modification devient un bouton de submit et on rajoute un champ input caché `<input type='hidden'/>` dont la value contient l'id. Vérifier que tous les champs possèdent un name.
    - Processing du formulaire situé sur edit-products_post.php: Même logique que le Create à quelques exceptions près :
      1. Vérification de la validité des informations du formulaire. (Les champs requis sont-ils remplis ? Sont-ils logiquement valides ?(date de réservation antidatée par exemple ?) **A-ton souhaité modifier l'image ?(Si oui, supprimer l'ancienne et ajouter la nouvelle, si non conserver l'ancienne, si l'on a souhaité la supprimer entièrement alors définir sur une image par défaut)**).
      2. Ajout de sécurité pour le lien formulaire-base de données. (Assainissement des variables lors de leur déclaration (htmlspecialchars()), Préparation des requêtes SQL avec PDO, <strike>Mise en place de token CSRF</strike>, **Vérification de la concordance entre l'id de l'input caché et l'id de l'URL de la page précédente**)
      3. **Modification des informations dans la base de données.(Execution de notre requête SQL d'update (UPDATE xxx SET y=z, a=b, c=d)**




## Cheminement du projet
1. Setup du projet (front)
2. Réalisation du DB en SQL
3. Mis en place une connexion à la BDD (includes/db.php)
4. Configuré des variables d'environnement
5. Mise en place de l'inscription user -- Nous sommes ici--
6. Mise en place de la connexion user : Vérifier que l'username existe et récupérer ses infos(requête préparée avec un fetch à la fin) -> Comparer le mot de passe obtenu dans la ligne de la BDD avec celui tapé dans le formulaire (fonction password_verify()) -> si c'est valide : créer une variable de session avec le username à l'intérieur
7. Création de produits 
## pas de doublon, sur le nom de produit
8. Affichage des produits
9. Affichage d'un produit unique
10. Modification d'un produit
11. Suppression d'un produit
12. Factorisation/Améliorations

## Propositions d'améliorations
- Créer un système de catégories pour les produits
- Mettre en place un système de gestion de stocks
- Soigner l'UX/UI (Messages d'erreur pour les utilisateurs)
- En se basant sur le projet ledger, réaliser un export CSV de tous les produits présents dans la BDD
- Transformer les opérations CRUD en fonctions
- Mettre en place un système d'imputation des modifications ("C'est l'utilisateur xxx qui a modifié le fichier dernièrement")
- Déployer le projet en ligne avec AlwaysData ouWebHost
