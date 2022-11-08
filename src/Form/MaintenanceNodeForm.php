<?php

namespace Drupal\maintenance_node\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteMaintenanceModeForm;

/**
 * Configure Maintenance Node settings for this site.
 */
class MaintenanceNodeForm extends SiteMaintenanceModeForm {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'maintenance.node',
      'system.maintenance'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $maintenance_node_id = $this->config('maintenance.node')->get('maintenance_node');
    $this->entityTypeManager = \Drupal::entityTypeManager();
    $maintenance_node = $maintenance_node_id ?
      $this->entityTypeManager->getStorage('node')->load($maintenance_node_id) : '';


    $form['maintenance_node'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'node',
      '#title' => $this->t('Maintenance Node'),
      '#description' => $this->t('Node to show when maintenance mode is on. When this field is empty, the default message will be shown.'),
      '#default_value' => $maintenance_node,
      '#weight' => 99,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('maintenance.node')
      ->set('maintenance_node', $form_state->getValue('maintenance_node'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
