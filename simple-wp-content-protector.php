<?php

/**
 * Plugin Name:       Simple Wp Content Protector
 * Plugin URI:        https://wordpress.org/plugins/simple-wp-content-protector
 * Description:       Simple content plugin help to protect your wordpress website text & image. it will help you to disable ctl+a, ctl+u, ctl+c, ctl+x, ctl+d drag & drop etc.
 * Version:           1.0.4
 * Requires at least: 5.2
 * Tested up to:      6.6
 * Requires PHP:      7.2
 * Author:            rajubdpro
 * Author URI:        http://codepopular.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simple-wp-content-protector
 */

if (!defined('ABSPATH')) die ('No direct access allowed');

class SimplecontentProtector
{

    public function __construct()
    {
        $this->init();;

    }

    public function init(){
        // Plugin Settings
        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$plugin", 'plugin_settings_links');
// Load admin css and js
        add_action('admin_enqueue_scripts', array('SimplecontentProtector', 'scp_admin_css_adn_js'));
// Submenu page
        add_action('admin_menu', array('SimplecontentProtector', 'Simple_content_protector_admin_menu'));
// Load public css and js
        add_action('wp_enqueue_scripts', array('SimplecontentProtector', 'scp_public_css_and_js'));

        add_action('admin_init', array('SimplecontentProtector', 'load_admin'));
    }

    public static function load_admin(){
        require_once('admin/admin.php');
    }

    // ---------- Register admin menu ----------------
    public static function simple_content_protector_admin_menu()
    {
        add_submenu_page(
            'options-general.php',
            'Simple Wp Content Protector',
            'Simple Wp Content Protector',
            'manage_options',
            'simple_content_protector',
            'simplecontent_admin_pages'
        );
    }


    // ----------  Load admin css and js ----------------
    public static function scp_admin_css_adn_js()
    {
        $hook = get_current_screen();
        if ($hook->id == 'settings_page_simple_content_protector') {
            wp_enqueue_style('scp-admin-css', plugins_url('admin/css/admin.css', __FILE__));
        }

    }

    // ----------  Load public css and js ----------------
    public static function scp_public_css_and_js()
    {
        if (get_option('simple_content_protector') != 'scp_disable') {
            wp_enqueue_style('scp_public_css', plugins_url('public/css/simple-content-protector.css', __FILE__));
            wp_enqueue_script('scp_public_js', plugins_url('public/js/simple-content-protector.js', __FILE__));
        }
    }
}

// ----------  Setting page ----------------
function plugin_settings_links($links)
{
    $settings_link = '<a href="options-general.php?page=simple_content_protector">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

if (class_exists('SimplecontentProtector')) {
    $new = new SimplecontentProtector();


}

?>
