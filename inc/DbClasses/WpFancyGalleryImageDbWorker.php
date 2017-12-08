<?php

namespace WpFancyGallery\inc\DbClasses;
/**
 * Class WpFancyGalleryImageDbWorker
 *
 * Get ID of galleries and images
 */
class WpFancyGalleryImageDbWorker extends WpFancyGalleryDbWorker
{
    protected $table = WPFANCYGALLERY_DB_NAME_HU_FANCY_IMAGES;
    protected $fields = ['id_gallery', 'image', 'title', 'description'];
    protected $idNameGallery = 'id_gallery';

    public function dropImages(array $dbImagesId, array $qweryImagesId)
    {
        $diffImages = array_diff($dbImagesId, $qweryImagesId);
        foreach ($diffImages as $imageId) {
            $this->wpdb->delete($this->table, array('id' => $imageId), array('%d'));
        }
    }

    public function getGalleryId($id)
    {
        $fields = implode(',', $this->fields);
        $results = $this->wpdb->get_results("SELECT $fields FROM $this->table WHERE $this->idName = $id", ARRAY_A);
        return $results;
    }

    public function getImagesId($idGallery)
    {
        $results = $this->wpdb->get_results("SELECT $this->idName FROM $this->table WHERE $this->idNameGallery = $idGallery", ARRAY_A);

        $result = [];
        foreach ($results as $val) {
            $result[] = $val['id'];
        }

        return $result;
    }
}
