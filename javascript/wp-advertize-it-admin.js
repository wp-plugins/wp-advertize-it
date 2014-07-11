/**
 * Wrapper function to safely use $
 */
var custom_uploader;
function wpaiAdminWrapper($) {
    var wpaiAdmin = {
        /**
         * Main entry point
         */
        init: function () {
            wpaiAdmin.registerEditArea();
            $('.media-button').click(function (e) {
                e.preventDefault();

                var image_url = $(this).siblings('.wpai-image-url');
                var image_description = $(this).siblings('.wpai-image-description');

                //If the uploader object has already been created, reopen the dialog
                if (custom_uploader) {
                    custom_uploader.open();
                    return;
                }

                //Extend the wp.media object
                custom_uploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: { text: 'Choose Image' },
                    library: { type: 'image' },
                    multiple: false,
                    frame: 'select'
                });

                //When a file is selected, grab the URL and set it as the text field's value
                custom_uploader.on('select', function () {
                    attachment = custom_uploader.state().get('selection').first().toJSON();
                    image_url.val(attachment.url);
                    image_description.val(attachment.description);
                });

                //Open the uploader dialog
                custom_uploader.open();
            });
        },

        registerEditArea: function () {
            jQuery('.settings_page_wpai_settings textarea').each(function () {
                editAreaLoader.init({
                    id: jQuery(this).attr('id')		// textarea id
                    , syntax: "html"			// syntax to be uses for highgliting
                    , start_highlight: true		// to display with highlight mode on start-up
                    , toolbar: "", EA_load_callback: "fEALoaded", allow_toggle: false, word_wrap: true
                });
            });
        }
    }; // end wpaiAdmin

    $(document).ready(wpaiAdmin.init);

} // end wpaiAdminWrapper()

wpaiAdminWrapper(jQuery);

function fEALoaded() {
    jQuery('.settings_page_wpai_settings textarea').each(function () {
        jQuery('#frame_' + jQuery(this).attr('id')).contents().find('.area_toolbar').hide();
        jQuery('#frame_' + jQuery(this).attr('id')).css("height", "auto");
    });
}