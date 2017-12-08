<?php

namespace WpFancyGallery\inc\Controllers;
/**
 * Class WpFancyGalleryShortcodeGalleryController
 *
 * Displays html in the frontend area
 */
class WpFancyGalleryShortcodeGalleryController extends WpFancyGalleryController
{
    public function exec($attr)
    {

        $id_gallery = intval($attr['id']);
        $galleries = $this->gallery->getGalleryById($id_gallery);

        if ($galleries != NULL) {

            $gallery_id_html = '<div id="freewall" class="free-wall">';
            foreach ($galleries[$id_gallery]['images'] as $fivesdraft) {
                if ($fivesdraft['id'] != NULL){
                    $gallery_id_html .= $this->get_local_file_contents(WPFANCYGALLERY_GALLERY_T_FRONT_PATH . 'item_image.php', $fivesdraft);
                }
            }

            $gallery_id_html .= '</div>';
            return $gallery_id_html;
        }

        return "Such a gallery does not exist! Check gallery <b>id</b>";
    }
}
