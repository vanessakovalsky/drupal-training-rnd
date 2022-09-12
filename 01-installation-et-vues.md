# Exercice 1 - Configurer l'environnement de travail et créer ses premières vues

## Pré-requis

- Avoir un Drupal 9 installé 
- Récupérer dans ce dépôt git le dossier d9-boatmanagement et le mettre dans le dossiers modules/custom (à créer) de son site Drupal
- Activer le module d9-boatmanagement
- Installer et activer le module devel et devel_generate 
- Utiliser la commande devel:generate avec drush pour générer 50 ports (termes de taxonomie), des utilisateurs (10) et 50 noeuds de type Boat 
- A l'aide de composer installer Drupal Console :
```
composer require drupal/console:~1.0 \
--prefer-dist \
--optimize-autoloader \
--sort-packages \
--no-update

composer update
```

## Création des vues 

### Créer une vue qui liste les ports

* * Dans l'interface aller dans Structure > Views (Vues en français)
* Créer une vue affichant des termes de taxonomies du vocabulaire Ports, avec un affichage page de type grille.
* On devra y voir l'image associé à chaque ports, et un lien ramenant vers la page qui liste les bateaux associés à ce port (pages générée automatiquement par Drupal)
* Définir cette page comme page d'accueil de Drupal dans la configuration du site.

### Créer une vue listant mes bateaux sous la forme d'une page avec l'URL /mes-bateaux
* Dans l'interface aller dans Structure > Views (Vues en français)
* Créer une vue affichant des noeuds de type bateaux, avec un affichage page de type grille.
* Utiliser les relations et les filtres contextuels pour afficher uniquement les bateaux dont l'utilisateur connecté est propriétaire
* Définir une url pour cette page et l'ajouter dans le menu principal.
* Créer un autre utilisateur et le définir comme propriétaire de certains bateaux.
* Se connecter avec ce nouvel utilisateur et vérifier que la vue affiche bien que les bateaux dont l'utilisateur est propriétaire
