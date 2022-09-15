<?php

namespace Drupal\boatmanagement\Form;

use Drupal\file\Entity\File;
use Drupal\node\Entity\Node;
use Drupal\Core\Form\FormBase;
use Drupal\taxonomy\Entity\Term;
use Drupal\Console\Bootstrap\Drupal;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ImportBateauForm.
 */
class ImportBateauForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'import_bateau_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $validators = array(
      'file_validate_extensions' => array('csv'),
      'file_validate_size' => array('2Mo'),
    );
    
    $form['fichier_importer'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Fichier à importer'),
      '#weight' => '0',
      '#upload_validators' => $validators,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $file_id = $form_state->getValue('fichier_importer');
    $file = File::load($file_id[0]);
    $uri = $file->getFileUri();
    $line_max = 1000;
    $handle = @fopen($uri, "r");
    // start count of imports for this upload
    $send_counter = 0;
    while ($row = fgetcsv($handle, $line_max, ',')) {
      if ($send_counter != 0) {
          // $row is an array of elements in each row
          // e.g. if the first column is the email address of the user, try something like
          $row_data = explode(';', $row[0]);
          $boat = Node::create([
        'uid' => 1,
        'revision' => 0,
        'status' => true,
        'promote' => 0,
        'created' => time(),
        'langcode' => 'fr',
        'type' => 'boat'
      ]);
          $boat->setTitle($row_data[0]);
          $boat->set('field_longueur', $row_data[1]);
          $boat->set('field_largeur', $row_data[2]);
          $boat->set('field_hauteur', $row_data[3]);
          //$boat->set('field_prix', $row_data[4]);
          //On vérifie si le terme de taxonomie existe
          if (!empty($row_data[5])) {
              $port = $row_data[5];
              $term = \Drupal::service('entity_type.manager')->getStorage('taxonomy_term')->loadByProperties(['name' => $port, 'vid' => 'port_d_attache']);
              if (isset($term) && !empty($term)) {
                  //On rattache le terme au champs du bateau
                  $port_attache = reset($term)->id();
              } else {
                  //On cree le terme de taxo
                  $port_nouveau_terme = Term::create([
                  'name' => $port,
                  'vid' => 'port_d_attachement',
                  ]);
                $port_nouveau_terme->save();
                $port_attache = $port_nouveau_terme->id();
              }
              $boat->field_port_d_attache->target_id = $port_attache;
          }
          $boat->save();
      }
      $send_counter++;

    }
      \Drupal::messenger()->addStatus('Les bateaux ont été créé'); 
  }

}

