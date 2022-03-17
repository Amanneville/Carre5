# Projet Carre5

- Pas de budget hébergement : il va avoir son appli en localhost

## Interface

- Bootstrap partout

- Page d'accueil admin : CRUD => Create, Read, Update, Delete
  - C : formulaire d'ajout de produits avec upload d'images (l'upload d'images - en 2e)
  - R : Sur la page admin pour la liste globale (pas de pagination), page individuelle pour les produits - elle aura un bouton(pour l'édition + pour la suppression)
  - U : Une page formulaire similaire à l'ajout mais qui servira pour l'upload - petit bouton delete sur la page d'édition
  - D : Un bouton depuis la liste admin

## Fonctionnalités ?

- PHP/MySQL : ???
- Il faudra déterminer notre schéma de données.

### MLD

| user                                |
| ----------------------------------- |
| id (int) PRIMARY_KEY AUTO_INCREMENT |
| username (varchar 255) NOT_NULL     |
| password (varchar 512) NOT_NULL     |

---

| product                                     |
| ------------------------------------------- |
| product_id (int) PRIMARY_KEY AUTO_INCREMENT |
| name (varchar 255) NOT_NULL                 |
| description (text)                          |
| price (float) NOT_NULL                      |
| image (varchar 512)                         |
| dlc (date)                                  |
| category_id (?????)                         |

## Paradigme utilisé

- Procédural pur
- Alternative (fonctionnel)
- connexion en PDO

## Comment utiliser ce repository

# OK - Cloner le repository 
# OK - Créer une base de données contenant une table user et une table product selon le schéma MLD ci-dessus
- Créer un fichier dev.env.php dans le dossier app/includes/ contenant les constantes DATABASE, SERVER, USER,PASSWORD relatives à votre SGBD.
