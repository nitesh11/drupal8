<?php

/**
 * @file
 * Contains Drupal\custom_module\Form\ModuleConfigurationForm.
 */

namespace Drupal\custom_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ModuleConfigurationForm.
 *
 * @package Drupal\custom_module\Form
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'custom_module.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'custom_module_configuration_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('custom_module.settings');

    $form['bio'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Bio'),
      '#default_value' => $config->get('bio'),
    );

    $form['body'] = array(
      '#type' => 'text_format',
      '#title' => 'Body',
      '#format' => $config->get('body.format'),
      '#default_value' => $config->get('body.value'),
    );

    $form['checkbox'] = array(
      '#type' => 'checkbox',
      '#title' => t('Your checkbox'),
      '#size' => 10,
      '#maxlength' => 255,
      '#default_value' => $config->get('checkbox'),
      '#required' => TRUE,
    );

    $form['checkboxes'] = array(
      '#type' => 'checkboxes',
      '#title' => t('Checkboxes'),
      '#maxlength' => 255,
      '#options' => array(
        'pepperoni' => t('Pepperoni'),
        'black_olives' => t('Black olives'), 
        'veggies' => t('Veggies')
      ),
      '#default_value' => $config->get('checkboxes'),
      '#required' => TRUE,
    );

    $form['radio'] = array(
      '#type' => 'radio',
      '#title' => t('Agree'),
      '#maxlength' => 255,
      '#return_value' => 0,
      '#default_value' => $config->get('radio'),
      '#required' => TRUE,
    );

    $form['radios'] = array(
      '#type' => 'radios',
      '#title' => t('Radios'),
      '#maxlength' => 255,
      '#options' => array(
        'pepperoni' => t('Pepperoni'),
        'black_olives' => t('Black olives'), 
        'veggies' => t('Veggies')
      ),
      '#default_value' => $config->get('radios'),
      '#required' => TRUE,
    );

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
    parent::submitForm($form, $form_state);

    $values = $form_state->getValues();
    dsm($values);
    // Update the configuration
    $this->config('custom_module.settings')
      // Set the title to the configuration
      ->set('bio', $values['bio'])
      // Set the value of the textarea to the configuration
      ->set('body.value', $values['body']['value'])
      // Set the format of the textarea to the configuration
      ->set('body.format', $values['body']['format'])
      // Checkbox.
      ->set('checkbox', $values['checkbox'])
      // Checkboxes.
      ->set('checkboxes', $values['checkboxes'])
      // Radio.
      ->set('radio', $values['radio'])
      // Radios.
      ->set('radios', $values['radios'])
      // Save the configuration
      ->save();
  }
}
