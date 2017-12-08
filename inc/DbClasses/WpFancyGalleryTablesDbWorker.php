<?php

namespace WpFancyGallery\inc\DbClasses;
/**
 * Class WpFancyGalleryTablesDbWorker
 *
 * Create tables on activation hook and drop tables on uninstall hook
 */
class WpFancyGalleryTablesDbWorker extends WpFancyGalleryCommonDbClass
{
    public function __construct()
    {
        parent::__construct();
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    }
    
    public function createTables()
    {
        $table_name_hireukraine_gallery = $this->wpdb->get_blog_prefix() . WPFANCYGALLERY_DB_NAME_HU_FANCY_GALLERY;
        $table_name_hireukraine_images = $this->wpdb->get_blog_prefix() . WPFANCYGALLERY_DB_NAME_HU_FANCY_IMAGES;

        $charset_collate = "DEFAULT CHARACTER SET {$this->wpdb->charset} COLLATE {$this->wpdb->collate}";

        $sql = "CREATE TABLE {$table_name_hireukraine_gallery}(
                    id_gallery  INT AUTO_INCREMENT PRIMARY KEY,
                    name_gallery varchar(30) NOT NULL
                ){$charset_collate};
                
                CREATE TABLE {$table_name_hireukraine_images} (
                    id  bigint(20) unsigned NOT NULL auto_increment PRIMARY KEY,
                    id_gallery INT NOT NULL,
                    image int default NULL,
                    title varchar(30) default NULL,
                    description varchar(255) default NULL,
                    FOREIGN KEY (id_gallery) REFERENCES {$table_name_hireukraine_gallery} (id_gallery) ON DELETE CASCADE
                ) {$charset_collate};";

        dbDelta($sql);

    }

    public function dropTables()
    {
        $table_name_hireukraine_gallery = $this->wpdb->get_blog_prefix() . WPFANCYGALLERY_DB_NAME_HU_FANCY_GALLERY;
        $table_name_hireukraine_images = $this->wpdb->get_blog_prefix() . WPFANCYGALLERY_DB_NAME_HU_FANCY_IMAGES;

        $sql = "DROP TABLE IF EXISTS $table_name_hireukraine_images";
        $this->wpdb->query($sql);

        $sql = "DROP TABLE IF EXISTS $table_name_hireukraine_gallery";
        $this->wpdb->query($sql);

    }
}
