# Exercice 5 - Routing

Cet exercice a pour objectifs :
* d'utiliser le hook uninstall
* de créer un controleur
* d'associer une route au controleur

## Création de module

* Pour créer le module avec drush :
```
drush gen module
```
* Avec la console
```
drupal generate:module
```

## Utilisation d'un hook

* Ajouter un fichier .module au module crée 
* Dans ce module, nous allons ajouter un hook uninstall pour supprimer la config : le code pour supprimer de la config est celui la : 
```
function monmodule_uninstall(){
    /** TODO remplacer automated_cron.settings par le * nom de la config et répéter la ligne autant de 
    * fois que de fichiers de configuration à supprimer
    */
  \Drupal::service('config.factory')->getEditable('automated_cron.settings')->delete();
}
```
* Désactiver le module, la config devrait alors être supprimée

## Déclarer un controleur et sa route 
* Générer un controleur et la route associée :

* * avec la console :

```
drupal generate:controller
```

* * Avec drush

```
drush generate controller
```
* Répondre aux questions
* Aller voir les fichiers générés.
* Qu'est ce qui devrait s'afficher et sur quel chemin ?
* Vérifier dans le navigateur que le message prévu s'affiche bien 

-> Félicitations, vous savez créer un controlleur et sa route 
