<div class="row-item"
     id="list_<?php echo $data['id']; ?>"
     data-id="<?php echo $data['id']; ?>">

    <input type="hidden" name="images[<?php echo $data['id']; ?>][id]" value="<?php echo $data['id']; ?>">
    <div class="img-upload">
        <img data-src="<?php echo WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_IMAGES_URL . '120.png'?>"
             src="<?php echo ($data['image'] !=0) ? wp_get_attachment_image_url($data['image']): WPFANCYGALLERY_GALLERY_ASSETS_ADMIN_IMAGES_URL . '120.png'; ?>"
             width="130"
             height="130"
        >
        <div class="hidden-input">
            <input type="hidden" name="images[<?php echo $data['id']; ?>][image]" id="" value="<?php echo $data['image']; ?>">
            <button type="submit" class="upload_image_button  btn btn-default">Load</button>
            <button type="submit" class="remove_image_button_gallery btn btn-default">×</button>
        </div>
    </div>
    <div class="gallery-params">
        <p class="form-group"><label>Title</label>
            <input type="text" value="<?php echo $data['title']; ?>" class="form-control" name="images[<?php echo $data['id']; ?>][title]" pattern=".{0,30}"
                   title="max 30 characters"
                   >
        </p>
        <p class="form-group">
            <label>Description</label>
            <textarea class="form-control"
                      rows="3"
                      name="images[<?php echo $data['id']; ?>][description]" pattern=".{0,230}" maxlength="230" title="max 230 characters"><?php echo $data['description']; ?></textarea>
        </p></div>
    <p class="form-group delete-list">
        <button type="button"
                class="btn-warning delete-button btn "
                data-delete="list_<?php echo $data['id']; ?>"
        >
            Remove item
        </button>
    </p>
</div>