<?php

namespace Drupal\customboatmanagement\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Provides a TestModule form.
 */
class ContactProprietaireForm extends FormBase {

  protected $request_stack;

  public function __construct(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('request_stack')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'testmodule_example';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['subject'] = [
      '#type' => 'textfield',
      '#title' => $this->t('subject'),
      '#required' => TRUE,
    ];
    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#required' => TRUE,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (mb_strlen($form_state->getValue('message')) < 10) {
      $form_state->setErrorByName('message', $this->t('Message should be at least 10 characters.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    // Envoyer un mail au propriétaire du bateau avec le sujet et le message
    // Récupérer dans la requête les infos du node 
    $node = $this->requestStack->getCurrentRequest()->attributes->get('node');
    // Récupérer le propriétaire pour obtenir son mail

    $proprietaire = $node->get('field_proprietaire')->first()->get('entity')->getTarget()->getValue();

    $destinataire = $proprietaire->getEmail();

    // Charger / utiliser le mailmanager 

      //On charge le service d'envoi de mail
  $mailer = \Drupal::service('plugin.manager.mail');
  // On récupère la langue de l'utilisateur cournat
  $langcode = \Drupal::languageManager()->getCurrentLanguage()->getId();
  // On récupère le nom du site dans la config pour le mettre dans le sujet du mail
  $site_name = \Drupal::config('system.site')->get('name');
  //On récupère l'utilisateur actuellement connecté
  $current_user = \Drupal::currentUser();
  $expediteur = $current_user->getEmail();
  //On construit le tableau avec les paramètres pour l'envoi du mail
  $params = array(
    'message' => $form_state->getValue('message'),
    'subject' => $form_state->getValue('subject'),
  );

    $this->messenger()->addStatus($this->t('The message has been sent.'));
    $form_state->setRedirect('<front>');


  $mailer->mail('testmodule', 'contact_proprio_send_email', $destinataire, $langcode, $params, $expediteur, $send=TRUE );
  }

}
