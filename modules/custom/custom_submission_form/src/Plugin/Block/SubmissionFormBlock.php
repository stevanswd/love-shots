<?php

namespace Drupal\custom_submission_form\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;

/**
 * Provides a block with a custom submission form.
 *
 * @Block(
 *   id = "submission_form_block",
 *   admin_label = @Translation("Submission Form Block")
 * )
 */
class SubmissionFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\custom_submission_form\Form\SubmissionForm');
  }

}
