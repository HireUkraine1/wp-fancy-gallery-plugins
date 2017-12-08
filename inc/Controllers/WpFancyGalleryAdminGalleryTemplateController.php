<?php

namespace WpFancyGallery\inc\Controllers;

/**
 * Class WpFancyGalleryAdminGalleryTemplateController
 *
 * Displays html in the admin area
 */
class WpFancyGalleryAdminGalleryTemplateController extends WpFancyGalleryController
{
    public function getHtml()
    {
        $galleries = $this->gallery->getGalleries();
        $html = '';
        $html .= $this->navMenu($galleries);
        $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/start_wrap_items.php');
        $firstGallery = true;
        foreach ($galleries as $items) {
            $html .= $this->items($items, $firstGallery);
            $firstGallery = false;
        }

        $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/finish_wrap_items.php');
        return $html;
    }

    private function navMenu($galleries)
    {
        $html = $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/nav_menu_start_wrap.php');
        $firstGallery = true;
        foreach ($galleries as $idGallery => $item) {
            $name_gallery = $item['name_gallery'];
            $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/nav_menu_list.php', array('id' => $idGallery, 'active' => $firstGallery ? 'active' : '', 'name_gallery' => $name_gallery));
            $firstGallery = false;
        }
        $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/nav_menu_finish_wrap.php');

        return $html;
    }

    private function items($gallery, $firstGallery)
    {
        $html = $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/start_wrap_item.php', ['active' => $firstGallery ? 'active' : '', 'id_gallery' => $gallery['id_gallery'], 'name_gallery' => $gallery['name_gallery']]);
        if ($gallery['images'][0]['id'] != NULL) {
            foreach ($gallery['images'] as $image) {
                $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/item_gallery.php', $image);
            }
        }
        $html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_ADMIN_PATH . '/finish_wrap_item.php', $gallery);

        return $html;
    }
}
