<div class="tab-pane <?php echo $data['active']; ?>" id="contact_<?php echo $data['id_gallery']; ?>">
    <form class="form-wrap" action="" method="post">
        <div class="shortcode">Copy this shortcode and paste it into the content field <span class="short-code">[hireukraine_shortcode_gallery id=<?php echo $data['id_gallery']; ?>
                ]</span>
            <input type="text" hidden name="id_gallery" value="<?php echo $data['id_gallery']; ?>">
            <input value="<?php echo $data['name_gallery']; ?>" placeholder="Gallery name"
                   type="text"
                   class="form-control"
                   name="name_gallery"
                   pattern=".{1,20}"
                   title="1 to 30 characters"
                    required>
        </div>

        <div class="row-list">