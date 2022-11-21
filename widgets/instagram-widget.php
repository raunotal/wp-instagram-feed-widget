<?php

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

class Instagram_Feed_Widget extends \Elementor\Widget_Base
{
  public function get_name()
  {
    return 'instagram';
  }

  public function get_title()
  {
    return esc_html__('Instagram Feed', 'instagram-feed-elementor-widget');
  }

  public function get_icon()
  {
    return 'eicon-instagram-gallery';
  }

  public function get_custom_help_url()
  {
    return 'https://raunotali.ee';
  }

  public function get_categories()
  {
    return ['general'];
  }

  public function get_keywords()
  {
    return ['instagram', 'feed', 'pictures', 'photos'];
  }

  protected function register_controls()
  {
    $this->start_controls_section(
      'content_section',
      [
        'label' => esc_html__('Settings', 'instagram-feed-elementor-widget'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
      'secret',
      [
        'label' => esc_html__('Secret', 'instagram-feed-elementor-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Your secret here', 'instagram-feed-elementor-widget'),
        'default' => ''
      ]
    );

    $this->add_control(
      'token',
      [
        'label' => esc_html__('Token', 'instagram-feed-elementor-widget'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'label_block' => true,
        'placeholder' => esc_html__('Your token here', 'instagram-feed-elementor-widget'),
        'default' => ''
      ]
    );

    $this->end_controls_section();
  }

  protected function render()
  {

    $settings = $this->get_settings_for_display();
    $secret = $settings['secret'];
    $access_token = $settings['token'];
    $url = 'https://graph.instagram.com/me/media/?fields=caption,media_type,media_url,permalink,thumbnail_url&limit=20&access_token=' . esc_html($access_token);
    $instagram_data = wp_remote_retrieve_body(wp_remote_get($url));
    $instagram_data = json_decode($instagram_data, true);
    $imagesCount = count($instagram_data['data']);
?>

    <div class="instagram-feed">
      <div class="instagram-feed__carousel" id="instagram-feed-carousel" data-count="<?php echo $imagesCount ?>">
        <?php foreach ($instagram_data['data'] as $key => $post) {
          $caption = $post["caption"];
          $mediaType = $post["media_type"];
          $mediaUrl = $post["media_url"];
          $permalink = $post["permalink"];
        ?>
          <div class="instagram-feed__slide">
            <img src="<?php echo esc_url($mediaUrl) ?>" alt="<?php echo esc_html($caption) ?>">
          </div>
        <?php } ?>
      </div>
    </div>
<?php

  }
}
