<?php

namespace Drupal\customboatmanagement\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a contactproprietaire block.
 *
 * @Block(
 *   id = "testmodule_contactproprietaire",
 *   admin_label = @Translation("ContactProprietaire"),
 *   category = @Translation("Custom")
 * )
 */
class ContactproprietaireBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\customboatmanagement\Form\ContactProprietaireForm');
  }

}
