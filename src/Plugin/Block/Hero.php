<?php
/**
 * Contains \Drupal\mixcomponents\Plugin\Block\Hero.
 */
namespace Drupal\mixcomponents\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Hero block based on the Bourbon/Neat unstyled Hero refill.
 *
 * @Block(
 *   id = "mixcomponents_hero",
 *   admin_label = @Translation("Mixology Hero"),
 * )
 */
class Hero extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    // TODO: Implement build() method.
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();

    $form['background_image'] = array(
      '#type' => 'managed_file',
      '#title' => t('Background Image'),
      //TODO
      '#default_value' => isset($config['background_image']) ? $config['background_image'] : NULL,
    );
    $form['foreground_image'] = array(
      '#type' => 'managed_file',
      '#title' => t('Foreground Image'),
      //TODO
      '#default_value' => isset($config['foreground_image']) ? $config['foreground_image'] : NULL,
    );
    $form['hero_text'] = array(
      '#type' => 'textarea',
      '#title' => t('Hero Text'),
      //TODO
      '#default_value' => isset($config['hero_text']) ? $config['hero_text'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('background_image', $form_state->getValue('background_image'));
    $this->setConfigurationValue('foreground_image', $form_state->getValue('foreground_image'));
    $this->setConfigurationValue('hero_text', $form_state->getValue('hero_text'));
  }
}
