# Exercice 3 - Création d'un thème et de templates

Cette série d'exercices a pour objectif de nous faire créer les différents templates nécessaire à notre site.
Pour cela nous utiliserons les maquettes présentes ici : https://app.moqups.com/yNkQ7nytUR/view/page/aa9df7b72  

Cet exercice a pour objectif :
* d'activer le debug
* de créer son premier thème


##  Activer le debug de Twig : 
* Dans sites/default copier le fichier default.services.yml en services.yml
* Dans le fichier services.yml faites les modifications suivante dans la config twig : 

```yml
debug: true
auto_reload: true
cache: false
```

* /!\ cela désactive uniquement le cache de twig mais certains fichiers reste mis en cache par drupal.
* Pour désactiver le cache de drupal complètement : 
* * Dans sites copier le fichier example.settings.local, coller le dans le web/sites/default/ et renommer la copie en settings.local
* * Dans ce fichier, décommenter les lignes suivantes :
```php
$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null'; 
```

** Dans le settings.php décommenter les lignes suivantes :

```php
if (file_exists($app_root . '/' . $site_path . '/settings.local.php')) {
  include $app_root . '/' . $site_path . '/settings.local.php';
}
```
* Penser à  vider le cache dans l'interface ou avec la console (drupal cr)

## Créer votre premier thème

* Avec l'aide de la console, générer un thème qui s'appuie sur le thème parent Classy
```sh
vendor/bin/drupal generate:theme
```
* /!\ Lors de la génération laisser 8.X pour la version du coeur.
* Une fois la génération terminée, rajouter dans le fichier demotheme.info.yml la ligne suivante en dessous de la ligne core 
```yml
core_version_requirement: ^8 || ^9
```
* Modifier les regions du thèmes présents dans le montheme.info.yml pour ne laisser que les région suivante :
* * Header
* * Content
* * Sidebar
* * Footer
* * Menu
* * Breadcrumb


* Avec l'aide du debugguer de twig pour trouver le template utiliser,
trouver le template de la page qui déclare les régions, dupliquer le dans votre 
dossier template de votre thème et supprimer les régions inutiles

## Créer un template pour la page d'accueil et la vue
* A l'aide du debuggueur, trouver les fichiers de template à créer et leur contenu de base pour 
* * la page d'accueil
* * la vue Mes bateaux 
* Créer ses fichiers et définirs les templates associés pour correspondre à la maquette