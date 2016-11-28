<?php
/**
 * Contains \Drupal\mixcomponents\Plugin\Block\SocialLinks.
 */
namespace Drupal\mixcomponents\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Social Links block.
 *
 * @Block(
 *   id = "mixcomponents_social_links",
 *   admin_label = @Translation("Mixology Social Links"),
 * )
 */
class SocialLinks extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $output = [
      '#theme' => 'mixcomponents_social_links',
      '#attached' => [
        'library' => 'mixcomponents/social-links'
      ],
    ];

    if (!empty($config['facebook_enabled'])) {
      $output['#links'][] = [
        'url' => $config['facebook_url'],
        'title' => $this->t('Facebook'),
        'class' => 'facebook',
        'svg' => $this->getFacebookSvg(),
      ];
    }
    if (!empty($config['twitter_enabled'])) {
      $output['#links'][] = [
        'url' => $config['twitter_url'],
        'title' => $this->t('Twitter'),
        'class' => 'twitter',
        'svg' => $this->getTwitterSvg(),
      ];
    }
    if (!empty($config['linkedin_enabled'])) {
     $output['#links'][] = [
       'url' => $config['linkedin_url'],
       'title' => $this->t('LinkedIn'),
       'class' => 'linkedin',
       'svg' => $this->getLinkedInSvg(),
     ];
    }
    if (!empty($config['youtube_enabled'])) {
      $output['#links'][] = [
        'url' => $config['youtube_url'],
        'title' => $this->t('YouTube'),
        'class' => 'youtube',
        'svg' => $this->getYouTubeSvg(),
      ];
    }
    if (!empty($config['rss_enabled'])) {
      $output['#links'][] = [
        'url' => $config['rss_url'],
        'title' => $this->t('RSS Feed'),
        'class' => 'rss',
        'svg' => $this->getRssSvg(),
      ];
    }

    return $output;
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();

    $form['facebook_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Facebook Link'),
      '#default_value' => isset($config['facebook_enabled']) ? $config['facebook_enabled'] : FALSE,
    ];
    $form['facebook_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Facebook URL'),
      '#default_value' => isset($config['facebook_url']) ? $config['facebook_url'] : '',
    ];
    $form['twitter_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable Twitter Link'),
      '#default_value' => isset($config['twitter_enabled']) ? $config['twitter_enabled'] : FALSE,
    ];
    $form['twitter_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Twitter URL'),
      '#default_value' => isset($config['twitter_url']) ? $config['twitter_url'] : '',
    ];
    $form['linkedin_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable LinkedIn Link'),
      '#default_value' => isset($config['linkedin_enabled']) ? $config['linkedin_enabled'] : FALSE,
    ];
    $form['linkedin_url'] = [
      '#type' => 'url',
      '#title' => $this->t('LinkedIn URL'),
      '#default_value' => isset($config['linkedin_url']) ? $config['linkedin_url'] : '',
    ];
    $form['youtube_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable YouTube Link'),
      '#default_value' => isset($config['youtube_enabled']) ? $config['youtube_enabled'] : FALSE,
    ];
    $form['youtube_url'] = [
      '#type' => 'url',
      '#title' => $this->t('YouTube URL'),
      '#default_value' => isset($config['youtube_url']) ? $config['youtube_url'] : '',
    ];
    $form['rss_enabled'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable RSS Link'),
      '#default_value' => isset($config['rss_enabled']) ? $config['rss_enabled'] : FALSE,
    ];
    $form['rss_url'] = [
      '#type' => 'url',
      '#title' => $this->t('RSS Feed URL'),
      '#default_value' => isset($config['rss_url']) ? $config['rss_url'] : '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('facebook_enabled', $form_state->getValue('facebook_enabled'));
    $this->setConfigurationValue('facebook_url', $form_state->getValue('facebook_url'));
    $this->setConfigurationValue('twitter_enabled', $form_state->getValue('twitter_enabled'));
    $this->setConfigurationValue('twitter_url', $form_state->getValue('twitter_url'));
    $this->setConfigurationValue('linkedin_enabled', $form_state->getValue('linkedin_enabled'));
    $this->setConfigurationValue('linkedin_url', $form_state->getValue('linkedin_url'));
    $this->setConfigurationValue('youtube_enabled', $form_state->getValue('youtube_enabled'));
    $this->setConfigurationValue('youtube_url', $form_state->getValue('youtube_url'));
    $this->setConfigurationValue('rss_enabled', $form_state->getValue('rss_enabled'));
    $this->setConfigurationValue('rss_url', $form_state->getValue('rss_url'));
  }

  /**
   * Return the svg markup from the specified file.
   *
   * @param string $filename
   *   The filename, assumed to be in the svg/sociallinks directory.
   *
   * @return string
   *   The contents of the file.
   */
  private function getSvgFileContents($filename) {
    $directory = drupal_get_path('module', 'mixcomponents') . '/svg/sociallinks/';
    return file_get_contents($directory . $filename);
  }

  /**
   * Get the Facebook svg icon.
   *
   * @return string
   *   SVG markup.
   */
  private function getFacebookSvg() {
    return $this->getSvgFileContents('facebook-circle.svg');
  }

  /**
   * Get the Twitter svg icon.
   *
   * @return string
   *   SVG markup.
   */
  private function getTwitterSvg() {
    return $this->getSvgFileContents('twitter-circle.svg');
  }

  /**
   * Get the LinkedIn svg icon.
   *
   * @return string
   *   SVG markup.
   */
  private function getLinkedInSvg() {
    return $this->getSvgFileContents('linkedin-circle.svg');
  }

  /**
   * Get the YouTube svg icon.
   *
   * @return string
   *   SVG markup.
   */
  private function getYouTubeSvg() {
    return $this->getSvgFileContents('youtube-circle.svg');
  }

  /**
   * Get the RSS svg icon.
   *
   * @return string
   *   SVG markup.
   */
  private function getRssSvg() {
    return $this->getSvgFileContents('rss-circle.svg');
  }
}