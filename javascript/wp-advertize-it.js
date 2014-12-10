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
        },

        /**
         * Registers event handlers
         */
        registerEventHandlers: function () {
        }
    }; // end wpai

    $(document).ready(wpai.init);

} // end wpaiWrapper()

wpaiWrapper(jQuery);
