<?php
namespace WpFancyGallery\inc\Init;
/**
 * Class WpFancyGalleryGalleryInitializer
 *
 * Includes initializing scripts
 */
class WpFancyGalleryGalleryInitializer
{
    public function init()
    {
        add_action('admin_menu', [$this, 'galleryPage']);
        add_action('admin_enqueue_scripts', [$this, 'initStylesAdmin']);
        add_action('admin_enqueue_scripts', [$this, 'initScriptsAdmin']);
        add_action('admin_enqueue_scripts', [$this, 'myEnqueueMedia']);

        add_action('wp_enqueue_scripts', [$this, 'initScriptsFrontend']);
        add_action('wp_enqueue_scripts', [$this, 'initStylesFrontend']);
    }

    public function myEnqueueMedia()
    {
        wp_enqueue_media();
    }

    public function initScriptsAdmin()
    {
        wp_register_script('gallery-bootstrap-script', WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_JS_URL . 'bootstrap.min.js', array(), '1.0.0', true);
        wp_enqueue_script('gallery-bootstrap-script');
        wp_register_script('gallery-script', WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_JS_URL . 'scripts.min.js', array(), '1.0.0', true);
        wp_enqueue_script('gallery-script');
        wp_localize_script('gallery-script', 'object_name', array('GALLERY_ASSETS_ADMIN_IMAGES_URL' => WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_IMAGES_URL));
    }

    public function initStylesAdmin()
    {
        wp_enqueue_style('gallery-bootstrap-styles', WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_CSS_URL . 'bootstrap.min.css', false, '1.0.0');
        wp_enqueue_style('gallery-main-styles', WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_CSS_URL . 'main.min.css', false, '1.0.0');
        wp_enqueue_style('gallery-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false, '1.0.0');
    }

    public function initScriptsFrontend()
    {
        wp_register_script('gallery-freewall', WPFANCYGALLERY_GALLERY_ASSETS_FRONTEND_JS_URL . 'freewall.min.js', array(), '1.0.0', true);
        wp_enqueue_script('gallery-freewall');
        wp_register_script('gallery-fancybox', WPFANCYGALLERY_GALLERY_ASSETS_FRONTEND_JS_URL . 'jquery.fancybox-1.3.4.min.js', array(), '1.0.0', true);
        wp_enqueue_script('gallery-fancybox');

        wp_register_script('gallery-scripts-frontend', WPFANCYGALLERY_GALLERY_ASSETS_FRONTEND_JS_URL . 'scripts.frontend.min.js', array(), '1.0.0', true);
        wp_enqueue_script('gallery-scripts-frontend');
    }

    public function initStylesFrontend()
    {
        wp_enqueue_style('gallery-fancybox-styles', WPFANCYGALLERY_GALLERY_ASSETS_FRONTEND_CSS_URL . 'fancybox/jquery.fancybox.min.css', false, '1.0.0');
        wp_enqueue_style('gallery-style-frontend', WPFANCYGALLERY_GALLERY_ASSETS_FRONTEND_CSS_URL . 'style.frontend.min.css', false, '1.0.0');
    }

    public function galleryPage()
    {
        add_menu_page('Gallery options', 'FancyGallery', 'manage_options', 'gallery-theme-settings', '', 'dashicons-menu', 101);
        add_submenu_page('gallery-theme-settings', 'Settings', 'Gallerypage', 'manage_options', 'gallery-theme-settings', [$this, 'settings']);
    }

    public function settings()
    {
        require(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . 'admin_settings.php');
    }
}
