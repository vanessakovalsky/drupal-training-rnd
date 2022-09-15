Exercice 6 : Ajouter des informations aux vues

Cet exercice a pour objectifs :
* d'ajouter un champ aire à la vue pour calculer l'aire de chaque bateau



## Ajouter un champ aire

* Pour ajouter un champ au champ disponible dans vue, il est nécessaire de déclarer un champ pour la forme d'un plugin (comme pour le bloc).
* Pour cela nous utilisons de nouveau la console pour générer la structure :
```
vendor/bin/drupal generate:plugin:views:field 
```
* Il est alors possible de définir plusieurs champs à la fois en répondant yes à la question Do you want to add another field
* Il est possible dans le fichier généré de définir différentes options pour notre champ de vue.
* Dans notre cas, nous remplaçons seulement la fonction de rendu (render):
```
  /**
   * {@inheritdoc}
   */
  public function render(ResultRow $values) {
    // Return a random text, here you can include your custom logic.
    // Include any namespace required to call the method required to generate
    // the desired output.
    $longueur = $values->_entity->field_longueur->value;
    $largeur = $values->_entity->field_largeur->value;
    $aire = $longueur * $largeur;
    return $aire;
  }
```
* Vous pouvez maintenant (une fois le cache vidé) utilisé ce nouveau champs sur votre vue pour ajouter l'aire à chaque bateau dans votre grille.

## Pour aller plus loin

* Dans votre fonction de rendu, appeler un service que vous créer et qui calcule l'air à partir de la longueur et de la largeur.
* Utiliser également ce service dans le bloc affiché sur les noeuds de bateau

-> Félicitation vous savez maintenant déclarer des nouveaux champs aux vues.
