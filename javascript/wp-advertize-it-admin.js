/**
 * Wrapper function to safely use $
 */
function wpaiAdminWrapper($) {
    var wpaiAdmin = {

        /**
         * Main entry point
         */
        init: function () {
            wpaiAdmin.registerEditArea();
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