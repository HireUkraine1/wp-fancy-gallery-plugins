<section class="gallery-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7">
                <div>
                    <h1>Gallery Page</h1>
                </div>
                <div id="gallery-form form-container">
                    <?php
                        $controller = new WpFancyGallery\inc\Controllers\WpFancyGalleryAdminGalleryTemplateController();
                        echo $controller->getHtml();
                    ?>
                </div>
                <div id="gallery-list"></div>
            </div>
        </div>
    </div>
</section>
