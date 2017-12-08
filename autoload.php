<?php

spl_autoload_register(function ($class) {

    $classPath = str_replace('WpFancyGallery\\inc\\', WPFANCYGALLERY_GALLERY_INC_PATH, $class);

    $file = str_replace('\\', DIRECTORY_SEPARATOR, $classPath) . '.php';
    if (file_exists($file)) {
        include_once $file;
    };

}); 