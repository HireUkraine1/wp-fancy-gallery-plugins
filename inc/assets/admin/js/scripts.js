"use strict";

(function ($) {

    $(document).on("ready", function () {

        /*
         * action when clicking on the image download button
         * You can also bind this action to a click on the image itself
         */
        $(document).on('click', '.upload_image_button', function () {
            var send_attachment_bkp = wp.media.editor.send.attachment;
            var button = $(this);
            wp.media.editor.send.attachment = function (props, attachment) {
                console.log($(this), attachment.url);
                $(button).parent().prev().attr('src', attachment.url);
                $(button).prev().val(attachment.id);
                wp.media.editor.send.attachment = send_attachment_bkp;
            }
            wp.media.editor.open(button);
            return false;
        });

        $(document).on('click', '.remove_image_button_gallery', function () {
            var r = confirm("Sure?");
            if (r == true) {
                var src = $(this).parent().prev().attr('data-src');
                $(this).parent().prev().attr('src', src);
                $(this).prev().prev().val('');
            }
            return false;
        });


        $(document).on('submit', '.form-wrap', function (e) {
            e.preventDefault();

            var ajaxserialize = $(this).serialize();
            var action = $(this).find("input[type='submit']").data('action');

            $.ajax({
                url: '/wp-admin/admin-ajax.php',
                method: 'post',
                data: {
                    action: action,
                    search: {
                        formserialize: ajaxserialize,
                    }
                },
                success: function (response) {
                    console.log(response);
                    location.reload();
                },
                error: function ($e) {
                    console.log($e);
                }
            });
        });

//drop gallery
        $(document).on('click', 'li span', function (e) {
            var action = $(this).find('i').data('dropgallery');

            var r = confirm('Are you sure that you want to delete the gallery - ' + action);
            if (r == true) {
                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    method: 'post',
                    data: {
                        action: 'dropGallery',
                        search: action
                    },
                    success: function (response) {
                        location.reload();
                    }
                });
            } else {
                location.reload();
            }

        });





        var GALLERY_ASSETS_ADMIN_IMAGES_URL = object_name.GALLERY_ASSETS_ADMIN_IMAGES_URL;

        $(document).on("click", '.add-button-item-gallery', function (event) {
            var counter = (new Date().getTime()).toString(36),
                newRow;
            event.preventDefault();
            var parentTab = $(this).parents(".tab-pane").attr("id");

            newRow = $('<div class="row-item" id="list_' + counter + '" data-id="' + counter + '" data-parent-id="' + parentTab + '" >' +
                ' <div class="img-upload"><img data-src="' + GALLERY_ASSETS_ADMIN_IMAGES_URL + '120.png" src="' + GALLERY_ASSETS_ADMIN_IMAGES_URL + '120.png" width="130" height="130"><div class="upload-buttons"><input type="hidden"  name="images[' + counter + '][image]" id="" value=""><button type="submit" class="upload_image_button btn btn-default">Load</button><button type="submit" class="remove_image_button_gallery btn btn-default">×</button></div></div>' +
                '</p><div class="gallery-params"><p class="form-group">' +
                '<input placeholder="Title" type="text" class="form-control" name="images[' + counter + '][title]"  pattern=".{0,30}" title="max 30 characters">' +
                '</p><p class="form-group"><textarea placeholder="Description" class="form-control" rows="3" name="images[' + counter + '][description]" pattern=".{0,230}" maxlength="230" title="max 250 characters"></textarea>' +
                '</p></div><p class="form-group delete-pst"><button type="button" class="btn btn-warning delete-button" data-delete="list_' + counter + '" >Remove item</button> </p></div>');


            $(this).parents(".tab-pane").find('.row-list').append(newRow);
        });


        $(".nav-tabs").on("click", "a", function (e) {
            e.preventDefault();
            if (!$(this).hasClass('add-contact-gallery')) {
                $(this).tab('show');
            }

        })
            .on("click", "span", function () {
                var anchor = $(this).siblings('a');
                $(anchor.attr('href')).remove();
                $(this).parent().remove();
                $(".nav-tabs li").children('a').first().click();
            });


        $('.add-contact-gallery').click(function (e) {
            e.preventDefault();
            var id = (new Date().getTime()).toString(36);
            var tabId = 'contact_' + id;

            $(this).closest('li').before('<li id="tab_' + id + '"><a  href="#contact_' + id + '">New Gallery</a> <span> <i class="fa fa-times" aria-hidden="true"></i> </span></li>');

            $('.tab-content').append(
                '<div class="tab-pane" id="' + tabId + '">' +
                '<form class="form-wrap"  action="" method="post">' +
                '<div class="shortcode">Here place for your shortcode</div> ' +
                '<input placeholder="Gallery name" type="text" class="form-control" name="name_gallery" pattern=".{1,20}" title="1 to 30 characters" required>' +
                '<div class="row-list">' +
                '</div>' +
                '<button type="button" class="btn btn-default add-button-item-gallery"><i class="fa fa-plus " data-id="' + tabId + '" aria-hidden="true"></i> Add Gallery Item</button>' +
                '<input type="submit" data-action="storeGallery" class="btn btn-primary main-submit" value="Save gallery">' +
                '</form>');


            $(".nav-tabs > li:last-child").prev("li").find("a").click();
        });


        $(document).on("click", ".delete-button", function () {
            $("div#" + $(this).data('delete')).remove();
        });


    })

})(jQuery);