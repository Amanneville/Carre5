# Projet Gestion de produits : Carre5

Créer un catalogue de produits disponibles (ou pas) chez notre client.

## Quel interface ?

- Une interface simple à base de formulaires et de boutons.

- Un affichage type administrateur : Il peut voir l'ensemble de ses produits et avoir l'option sur chacun d'entre eux pour modifier/supprimer un produit, mais aussi un bouton pour ajouter un nouveau produit.

## Quelles fonctionnalités ?

- Ajouter des produits - Create

- Afficher des produits dans une liste, mais aussi pour en afficher un seul en détail - Read

- Modifier des produits existants - Update

- Supprimer des produits existants - Delete

- (?) Catégorisation des produits (?)

### Client ?

- Il est pas ouf, il a juste une idée il a rien donné d'autre
  - Pas d'icon
  - Pas d'identité visuelle
  - Pas de budget
  - Pas d'employé qui gère son appli (il est tout seul)

++ Il nous paye en visibilité







### Upload Image PHP

- Modif BDD = champ image (image par dégfaut)
- le FORM : enctype="multipart/form-data

## DANS LE FORM DE CREA PRODUIT -> addOffers.php

- intégrer dans le form html, le téléchargement du fichier image à la création d'un produit.

<div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control" type="file" id="formFile" name="image"
                accept="image/png, image/jpeg, image/jpg, image/gif">
        </div>

## traitement dans le \_post :

1. Initialisation de la variable
   $image = $\_FILES['image'];
2. conditions de validation (taille, extension, )