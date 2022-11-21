<?php

/**
 * Plugin Name: Instagram Feed Elementor Widget
 * Description: Elementor custom widget for showing Instagrad feed.
 * Plugin URI:  https://raunotali.ee/
 * Version:     1.0.0
 * Author:      Rauno Tali
 * Author URI:  https://raunotali.ee/
 * Text Domain: instagram-feed-elementor-widget
 *
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function register_instagram_feed_widget($widgets_manager)
{
    require_once(__DIR__ . '/widgets/instagram-widget.php');  // include the widget file
    $widgets_manager->register(new \Instagram_Feed_Widget());  // register the widget
}

function register_instagram_feed_styles()
{
    wp_enqueue_style(
        'instagram-feed-styles',
        plugin_dir_url(__FILE__) . '/assets/css/instagram-feed.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . '/assets/css/instagram-feed.css')
    );
}

function register_instagram_feed_scripts()
{
    wp_enqueue_script(
        'instagram-feed-scripts',
        plugin_dir_url(__FILE__) . '/assets/js/instagram-feed.js',
        array(),
        filemtime(plugin_dir_path(__FILE__) . '/assets/js/instagram-feed.js'),
        true
    );
}

add_action('elementor/widgets/register', 'register_instagram_feed_widget');
add_action('init', 'register_instagram_feed_scripts');
add_action('init', 'register_instagram_feed_styles');
