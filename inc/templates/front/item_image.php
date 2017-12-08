<div class="item" style="width: 100px; height: 100px">
    <a data-fancybox="gallery" class="gallary-item" rel="group1"
       href="<?php echo ($data['image'] != 0) ? wp_get_attachment_image_url($data['image'], 'full') : WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_IMAGES_URL . '120.png'; ?>"
       title="<?php echo $data['title']; ?>">
        <img
            src="<?php echo ($data['image'] != 0) ? wp_get_attachment_image_url($data['image'], 'thumbnail') : WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_IMAGES_URL . '120.png'; ?>"
            alt="<?php echo $data['description']; ?>">
    </a>
</div>

