# Exercice 4 - Gestion des Assets

Cet exercice a pour objectif :
* de vous faire définir la structure de vos feuilles de styles en respectant l'architecture SMACSS
* d'associer vos feuilles de styles à votre thème pour pouvoir les utiliser

## Définition de l'architecture des feuilles de styles
* Définir l'architecture des feuilles de styles de votre thèmes 
* Créer l'arborescence et les fichiers correspondants 
* Définir quelques règles CSS pour rendre le rendu propre et agréable à l'oeil.

## Déclaration des fichiers en tant que bibliothèque de votre thème
* Dans le fichier montheme.libraries.yaml, dans la section global, il est nécessaire de déclarer les différents fichier, comme dans l'exemple ci-dessous (à adapter en fonction de votre architecture de fichiers)
```
global:
  js:
    js/demotheme.js: {}
  css:
    base:
      css/base/elements.css: {}
    component:
      css/components/block.css: {}
      css/components/breadcrumb.css: {}
      css/components/field.css: {}
      css/components/form.css: {}
      css/components/header.css: {}
      css/components/menu.css: {}
      css/components/messages.css: {}
      css/components/node.css: {}
      css/components/sidebar.css: {}
      css/components/table.css: {}
      css/components/tabs.css: {}
      css/components/buttons.css: {}
    layout:
      css/layouts/layout.css: {}
    theme:
      css/theme/print.css: { media: print }
```    
* N'oublier pas d'inclure dans vos templates les fichiers CSS dont vous avez besoin avec la fonction attach_library
```
{{ attach_library('classy/node') }}
```

## Import de la librairie et création du fichier JS 
* A partir de l'url, https://nnattawat.github.io/flip/ installer la librairie, dans vendor/flip 
* Créer un script js dans le theme dans montheme/js/ . Celui contient :
```js
(function ($, Drupal) {
    'use strict';
    $(document).ready(function(){
        $('.block-flipblock').flip();
    });
    } (jQuery, Drupal));  
```
* Ce script doit permettre le comportement des flipbox (afficher la description au survol de la souris)

## Déclaration de la librairie et utilisation dans un template
* Il est nécessaire de déclarer le fichier JS sous forme d'une librairie dans les librairies du thème.
* Ajouter dans le fichier montheme.librarires.yml les lignes suivantes :
```yml
flipblock:
  js:
    vendor/flip/jquery.flip.min.js: {}
    js/flip.js: {}
  dependencies:
    - core/jquery
```
* Créer un fichier template dans templates/block/block--flip.block.html.twig avec le code suivant :
```html
{%
  set classes = [
    'block',
    'block-' ~ configuration.provider|clean_class,
    'block-' ~ plugin_id|clean_class,
    'col-3',
    'block-flipblock',
  ]
%}
{{ attach_library('demotheme/flipblock') }}
<div{{ attributes.addClass(classes) }}>
  {{ title_prefix }}
  {% if label %}
    <h2{{ title_attributes }}>{{ label }}</h2>
  {% endif %}
  {{ title_suffix }}
  {% block content %}
    <div class="front">
      {{content.field_icone_flib}}
    </div>
    <div class="back">
      {{ content.body }}
    </div>
  {% endblock %}
</div>
```
