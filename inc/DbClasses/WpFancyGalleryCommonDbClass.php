<?php

namespace WpFancyGallery\inc\DbClasses;

class WpFancyGalleryCommonDbClass
{
    public $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
}
