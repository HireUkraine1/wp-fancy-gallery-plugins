<?php

namespace WpFancyGallery\inc\Controllers;
/**
 * Class WpFancyGalleryAjaxAdminController
 *
 * Ajax creating, updating and deleting galleries
 */
class WpFancyGalleryAjaxAdminController extends WpFancyGalleryController
{
    public function storeGallery()
    {
        if (isset($_POST['search'])) {
            parse_str($_POST['search']['formserialize'], $data);

            $ImagesData = $data['images'];

            unset($data['images']);
            $galleryId = $this->gallery->create($data);

            foreach ($ImagesData as $imageData) {
                $image = array_merge(['id_gallery' => $galleryId], $imageData);
                $this->images->create($image);
            }
        }
        wp_die();
    }

    public function updateGallery()
    {
        if (isset($_POST['search'])) {
            parse_str($_POST['search']['formserialize'], $data);
            $ImagesData = $data['images'];

            unset($data['images']);
            $update_gallery_id = $this->gallery->update($data);

            $get_id_images = $this->images->getImagesId($update_gallery_id);
            $get_id_images_for_gallery = $this->getImagesIdForGallery($ImagesData);

            $this->images->dropImages($get_id_images, $get_id_images_for_gallery);

            foreach ($ImagesData as $imageData) {
                $image = array_merge(['id_gallery' => $update_gallery_id], $imageData);
                if ($imageData['id'] == NULL) {
                    $this->images->create($image);
                } else {
                    $this->images->update($image);
                }
            }

        }
        wp_die();
    }

    public function dropGallery()
    {
        if (isset($_POST['search'])) {
            $id_table = $_POST['search'];
            $this->gallery->drop($id_table);
        }
        wp_die();
    }

    private function getImagesIdForGallery($id_images)
    {
        $result = [];
        foreach ($id_images as $val) {
            $result[] = $val['id'];
        }

        return $result;
    }
}
