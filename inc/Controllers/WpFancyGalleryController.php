<?php

namespace WpFancyGallery\inc\Controllers;

use WpFancyGallery\inc\DbClasses\WpFancyGalleryGalleryDbWorker;
use WpFancyGallery\inc\DbClasses\WpFancyGalleryImageDbWorker;

class WpFancyGalleryController
{
    protected $gallery;

    protected $images;

    public function __construct()
    {
        $this->gallery = new WpFancyGalleryGalleryDbWorker();
        $this->images = new WpFancyGalleryImageDbWorker();
    }

    protected function get_local_file_contents($file_path, $data = [])
    {
        ob_start();
        include $file_path;
        $contents = ob_get_clean();

        return $contents;
    }
}
