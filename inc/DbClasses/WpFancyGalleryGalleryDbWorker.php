<?php

namespace WpFancyGallery\inc\DbClasses;
/**
 * Class WpFancyGalleryGalleryDbWorker
 *
 * Getting galleries from DB
 */
class WpFancyGalleryGalleryDbWorker extends WpFancyGalleryDbWorker
{
    protected $table = WPFANCYGALLERY_DB_NAME_HU_FANCY_GALLERY;
    protected $childTable;
    protected $fields = ['name_gallery'];
    protected $idName = 'id_gallery';
    protected $idRelationColumnNameInChildTable = 'id_gallery';

    public function __construct()
    {
        parent::__construct();
        $this->childTable = $this->wpdb->get_blog_prefix() . WPFANCYGALLERY_DB_NAME_HU_FANCY_IMAGES;

    }


    protected function galleries($results){
        $galleries = [];
        foreach ($results as $item) {
            $galleries[$item['id_gallery']]['name_gallery'] = $item['name_gallery'];
            $galleries[$item['id_gallery']]['id_gallery'] = $item['id_gallery'];
            $galleries[$item['id_gallery']]['images'][] = $item;
        }
        return $galleries;
    }

    public function getGalleries()
    {
        $fields = $this->childTable . '.*, ' . $this->table . '.*';

        $query = sprintf("SELECT $fields 
                                    FROM $this->table  
                                    LEFT JOIN $this->childTable ON $this->table.$this->idName = $this->childTable.$this->idRelationColumnNameInChildTable");
        $results = $this->wpdb->get_results($query, ARRAY_A);

        $galleries = $this->galleries($results);
        return $galleries;
    }

    public function getGalleryById($id)
    {
        $fields = $this->childTable . '.*, ' . $this->table . '.*';

        $query = sprintf("SELECT $fields 
                                    FROM $this->table  
                                    LEFT JOIN $this->childTable ON $this->table.$this->idName = $this->childTable.$this->idRelationColumnNameInChildTable
                                    WHERE $this->table.$this->idName = $id");
        $results = $this->wpdb->get_results($query, ARRAY_A);

        $galleries = $this->galleries($results);
        return $galleries;
    }
}
