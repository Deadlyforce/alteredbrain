
jQuery(document).ready(function ($) {
    
    var meta_image_frame; // Instantiates the variable that holds the media library frame.

    // Runs when the image button is clicked.
    $('.image-upload').click(function (e) {
        e.preventDefault();
        var meta_image = $(this).parent().children('.meta-image');
        var preview_image = $(this).parent().next().children('img');

        // If the frame already exists, re-open it.
        if (meta_image_frame) {
            meta_image_frame.open();
            return;
        }
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: meta_image.title,
            button: {
                text: meta_image.button
            }
        });
        // Runs when an image is selected.
        meta_image_frame.on('select', function () {
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            meta_image.val(media_attachment.url);

            preview_image.attr('src', media_attachment.url);
        });
        // Opens the media library frame.
        meta_image_frame.open();
    });
});
