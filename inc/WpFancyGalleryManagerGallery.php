<?php

namespace WpFancyGallery\inc;

use WpFancyGallery\inc\Init\WpFancyGalleryGalleryInitializer;
use WpFancyGallery\inc\Controllers\WpFancyGalleryAjaxAdminController;
use WpFancyGallery\inc\Controllers\WpFancyGalleryShortcodeGalleryController;
use WpFancyGallery\inc\DbClasses\WpFancyGalleryTablesDbWorker;

/**
 * Class WpFancyGalleryManagerGallery
 *
 * Includes initializing scripts and functions
 */
class WpFancyGalleryManagerGallery
{
    private $initializer;

    public function __construct()
    {
        $this->initializer = new WpFancyGalleryGalleryInitializer();

        $this->activation();
        $this->registerAjaxMethod();
        $this->initFrontendHooks();
    }

    public function runGallery()
    {
        $this->initializer->init();
    }

    private function activation()
    {
        register_activation_hook(WPFANCYGALLERY_PL_FILE, array($this, 'createTables'));
        register_uninstall_hook(WPFANCYGALLERY_PL_FILE, array('WpFancyGallery\inc\WpFancyGalleryManagerGallery', 'dropTables'));
    }

    public function initFrontendHooks()
    {
        add_shortcode('hireukraine_shortcode_gallery', [$this, 'shortCodeGallery']);
    }

    private function registerAjaxMethod()
    {
        if (wp_doing_ajax()) {
            add_action('wp_ajax_storeGallery', [$this, 'storeGallery']);
            add_action('wp_ajax_nopriv_storeGallery', [$this, 'storeGallery']);

            add_action('wp_ajax_updateGallery', [$this, 'updateGallery']);
            add_action('wp_ajax_nopriv_updateGallery', [$this, 'updateGallery']);

            add_action('wp_ajax_dropGallery', [$this, 'dropGallery']);
            add_action('wp_ajax_nopriv_dropGallery', [$this, 'dropGallery']);
        }
    }

    public function storeGallery()
    {
        $controller = new WpFancyGalleryAjaxAdminController;
        return $controller->storeGallery();
    }

    public function updateGallery()
    {
        $controller = new WpFancyGalleryAjaxAdminController;
        return $controller->updateGallery();

    }

    public function dropGallery()
    {
        $controller = new WpFancyGalleryAjaxAdminController;
        return $controller->dropGallery();

    }

    public function shortCodeGallery($attr)
    {
        $controller = new WpFancyGalleryShortcodeGalleryController;
        return $controller->exec($attr);
    }

    public function createTables()
    {
        $db = new WpFancyGalleryTablesDbWorker();
        return $db->createTables();
    }

    public function dropTables()
    {
        $db = new WpFancyGalleryTablesDbWorker();
        return $db->dropTables();
    }
}
