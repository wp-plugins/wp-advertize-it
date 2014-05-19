/**
 * Wrapper function to safely use $
 */
function wpaiWrapper($) {
    var wpai = {

        /**
         * Main entry point
         */
        init: function () {
            wpai.prefix = 'wpai_';
            wpai.templateURL = $('#template-url').val();
            wpai.ajaxPostURL = $('#ajax-post-url').val();

            wpai.registerEventHandlers();
            wpai.registerEditArea();
        },

        /**
         * Registers event handlers
         */
        registerEventHandlers: function () {
        },

        registerEditArea: function () {
            jQuery('.settings_page_wpai_settings textarea').each(function () {
                editAreaLoader.init({
                    id: jQuery(this).attr('id')		// textarea id
                    , syntax: "html"			// syntax to be uses for highgliting
                    , start_highlight: true		// to display with highlight mode on start-up
                });
            });
        }
    }; // end wpai

    $(document).ready(wpai.init);

} // end wpaiWrapper()

wpaiWrapper(jQuery);
