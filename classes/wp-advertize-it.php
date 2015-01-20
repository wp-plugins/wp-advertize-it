<?php

if (!class_exists('WordPress_Advertize_It')) {

    /**
     * Main / front controller class
     */
    class WordPress_Advertize_It extends WPAI_Module
    {
        /**
         * @var array all readable properties
         */
        protected static $readable_properties = array(); // These should really be constants, but PHP doesn't allow class constants to be arrays
        /**
         * @var array all writable properties
         */
        protected static $writeable_properties = array();
        /**
         * @var array all plugin modules
         */
        protected $modules;

        /**
         * Plugin version
         */
        const VERSION = '0.9.6';
        /**
         * Prefix used to identify things related to this plugin
         */
        const PREFIX = 'wpai_';
        /**
         * Whether debug mode is switched on or not. Not used currently.
         */
        const DEBUG_MODE = false;


        /*
         * Magic methods
         */

        /**
         * Constructor
         *
         * @mvc Controller
         */
        protected function __construct()
        {
            $this->register_hook_callbacks();

            $this->modules = array(
                'WPAI_Settings' => WPAI_Settings::get_instance()
            );
        }

        /*
         * Static methods
         */

        /**
         * Enqueues CSS, JavaScript, etc
         *
         * @mvc Controller
         */
        public static function load_resources()
        {
            wp_register_script(
                self::PREFIX . 'wp-advertize-it',
                plugins_url('javascript/wp-advertize-it.js', dirname(__FILE__)),
                array('jquery'),
                self::VERSION,
                true
            );

            wp_register_script(
                self::PREFIX . 'wp-advertize-it-admin',
                plugins_url('javascript/wp-advertize-it-admin.js', dirname(__FILE__)),
                array('jquery'),
                self::VERSION,
                true
            );

            wp_register_script(
                self::PREFIX . 'ace',
                plugins_url('ace/ace.js', dirname(__FILE__)),
                array('jquery'),
                self::VERSION,
                true
            );

            wp_register_style(
                self::PREFIX . 'admin',
                plugins_url('css/admin.css', dirname(__FILE__)),
                array(),
                self::VERSION,
                'all'
            );

            if (is_admin()) {
                if (!did_action('wp_enqueue_media')) {
                    wp_enqueue_media();
                }
                wp_enqueue_style(self::PREFIX . 'admin');
                wp_enqueue_script(self::PREFIX . 'wp-advertize-it-admin');
                wp_enqueue_script(self::PREFIX . 'ace');
                wp_enqueue_script('jquery-ui-dialog');
                wp_enqueue_style("wp-jquery-ui-dialog");
            } else {
                wp_enqueue_script(self::PREFIX . 'wp-advertize-it');
            }
        }

        /**
         * Clears caches of content generated by caching plugins like WP Super Cache
         *
         * @mvc Model
         */
        public static function clear_caching_plugins()
        {
            // WP Super Cache
            if (function_exists('wp_cache_clear_cache')) {
                wp_cache_clear_cache();
            }

            // W3 Total Cache
            if (class_exists('W3_Plugin_TotalCacheAdmin')) {
                $w3_total_cache = w3_instance('W3_Plugin_TotalCacheAdmin');

                if (method_exists($w3_total_cache, 'flush_all')) {
                    $w3_total_cache->flush_all();
                }
            }

            // WP Engine
            if (class_exists('WpeCommon')) {
                WpeCommon::purge_memcached();
                WpeCommon::clear_maxcdn_cache();
                WpeCommon::purge_varnish_cache();
            }
        }

        /*
         * Instance methods
         */

        /**
         * Prepares sites to use the plugin during single or network-wide activation
         *
         * @mvc Controller
         *
         * @param bool $network_wide
         */
        public function activate($network_wide)
        {
            global $wpdb;

            if (function_exists('is_multisite') && is_multisite()) {
                if ($network_wide) {
                    $blogs = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

                    foreach ($blogs as $blog) {
                        switch_to_blog($blog);
                        $this->single_activate($network_wide);
                    }

                    restore_current_blog();
                } else {
                    $this->single_activate($network_wide);
                }
            } else {
                $this->single_activate($network_wide);
            }
        }

        /**
         * Runs activation code on a new WPMS site when it's created
         *
         * @mvc Controller
         *
         * @param int $blog_id
         */
        public function activate_new_site($blog_id)
        {
            switch_to_blog($blog_id);
            $this->single_activate(true);
            restore_current_blog();
        }

        /**
         * Prepares a single blog to use the plugin
         *
         * @mvc Controller
         *
         * @param bool $network_wide
         */
        protected function single_activate($network_wide)
        {
            foreach ($this->modules as $module) {
                $module->activate($network_wide);
            }
        }

        /**
         * Rolls back activation procedures when de-activating the plugin
         *
         * @mvc Controller
         */
        public function deactivate()
        {
            foreach ($this->modules as $module) {
                $module->deactivate();
            }
        }

        /**
         * Register callbacks for actions and filters
         *
         * @mvc Controller
         */
        public function register_hook_callbacks()
        {
            add_action('wpmu_new_blog', __CLASS__ . '::activate_new_site');
            add_action('wp_enqueue_scripts', __CLASS__ . '::load_resources');
            add_action('admin_enqueue_scripts', __CLASS__ . '::load_resources');

            add_action('init', array($this, 'init'));
            add_action('init', array($this, 'upgrade'), 11);

            add_action('init', array($this, 'editor_buttons'), 999);

            add_filter('the_content', array($this, 'show_ad_in_content'));
            add_action('wp_head', array($this, 'buffer_start'));
            add_action('wp_footer', array($this, 'buffer_end'));
            add_action('wp_footer', array($this, 'show_ad_below_footer'));
            add_action('comment_form', array($this, 'show_ad_below_comments'));
            add_action('the_post', array($this, 'show_ad_between_posts'));

            add_shortcode('showad', array($this, 'handle_short_code'));
            add_action('wp_ajax_get_ad_list', array($this, 'get_ad_list'));
        }

        /**
         * Callback called when the page buffering stops.
         * It checks whether an ad block is configured to be displayed at the beginning of the page and adds it just after the body tag.
         *
         * @param $buffer page contents
         * @return string page contents containing the additional ad block before the body tag (if configured)
         */
        function buffering_callback($buffer)
        {
            $above_everything = "";

            $content = get_the_content();
            $blocks = $this->RemoveSuppressBlocks($this->modules['WPAI_Settings']->settings['blocks'], $content);
            $above_everything_block = $this->modules['WPAI_Settings']->settings['placements']['above-everything'];

            $options = $this->modules['WPAI_Settings']->settings['options'];

            if ($this->is_suppress_specific($options, $content)) {
                return $buffer;
            }

            if ($above_everything_block != "") {
                $above_everything = WPAI_Settings::get_ad_block($blocks, $above_everything_block);
            }

            $matches = preg_split('/(<body.*?>)/i', $buffer, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            $buffer = $matches[0] . $matches[1] . $above_everything . $matches[2];
            return $buffer;
        }

        /**
         * Starts buffering of the page contents and defines buffering_callback as call back when buffering ends.
         */
        function buffer_start()
        {
            ob_start(array($this, 'buffering_callback'));
        }

        /**
         * Ends buffering of the page contents.
         */
        function buffer_end()
        {
            ob_end_flush();
        }

        /**
         * Registers the button in the visual editor unless it is disabled in the settings or the user doesn't have the required rights.
         */
        function editor_buttons()
        {
            $options = $this->modules['WPAI_Settings']->settings['options'];
            if ((!isset($options['hide-editor-button']) || $options['hide-editor-button'] != 1)
                && (current_user_can('edit_posts') || current_user_can('edit_pages'))
                && get_user_option('rich_editing')
            ) {
                add_filter('mce_external_plugins', array($this, 'add_buttons'));
                add_filter('mce_buttons', array($this, 'register_buttons'));
            }
        }

        /**
         * @param $plugin_array
         * @return mixed
         */
        function add_buttons($plugin_array)
        {
            $plugin_array['wpai'] = plugins_url('../javascript/shortcode.js', __file__);
            return $plugin_array;
        }

        /**
         * @param $buttons
         * @return mixed
         */
        function register_buttons($buttons)
        {
            array_push($buttons, 'showad');
            return $buttons;
        }

        /**
         * @param $attributes
         * @return string
         */
        function handle_short_code($attributes)
        {
            $ad_block = "";

            extract(shortcode_atts(array(
                'block' => ''
            ), $attributes));

            if (isset($block) && $block !== '') {
                return $this->get_ad_block($block);
            }

            return $ad_block;
        }

        /**
         * @param $block
         * @return string
         */
        function get_ad_block($block)
        {
            $ad_block = "";
            $blocks = $this->modules['WPAI_Settings']->settings['blocks'];
            if (isset($blocks[intval($block) - 1]) && isset($blocks[intval($block) - 1]['text'])) {
                $ad_block = $blocks[intval($block) - 1]['text'];
            }
            return $ad_block;
        }

        /**
         * Displays the contents of a dialog allowing to choose and ad block to be displayed.
         */
        function get_ad_list()
        {
            $blocks = $this->modules['WPAI_Settings']->settings['blocks'];
            ?>
            <!DOCTYPE html>
            <head>
                <title>WP Advertize It - Insert Ad Block</title>
            </head>
            <body>
            <p>
                <label for="ad-block-select"><?php _e('Ad Block:'); ?></label>
                <select class="widefat" id="ad-block-select"
                        name="ad-block-select">
                    <?php foreach ($blocks as $i => $block) : ?>
            <option style="padding-right: 10px;"
                    value="<?php echo esc_attr(($i + 1)); ?>"><?php echo $block['name']; ?></option>
        <?php endforeach; ?>
                </select>
            </p>
            </body>
            </html>
            <?php
            die;
        }

        /**
         * Reads the options and checks for which post ID no adds should be displayed.
         *
         * @param $options settings for this plugin
         * @return array list of post IDs for which no adds should be displayed
         */
        public function get_suppress_post_id($options)
        {
            $suppress_post_id = array();

            foreach (explode(',', $options['suppress-post-id']) as $id) {
                $id2 = explode('-', $id);
                if (count($id2) == 1) {
                    array_push($suppress_post_id, $id2[0]);
                } else {
                    for ($i = $id2[0]; $i <= $id2[1]; $i++) {
                        array_push($suppress_post_id, $i);
                    }
                }
            }
            return $suppress_post_id;
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_url($options)
        {
            $suppress_url = array();

            foreach (explode(',', $options['suppress-url']) as $id) {
                if ($id != "") {
                    array_push($suppress_url, $id);
                }
            }
            return $suppress_url;
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_ipaddress($options)
        {
            $suppress_ipaddress = array();

            foreach (explode(',', $options['suppress-ipaddress']) as $id) {
                if ($id != "") {
                    array_push($suppress_ipaddress, $id);
                }
            }
            return $suppress_ipaddress;
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_referrer($options)
        {
            $suppress_referrer = array();

            foreach (explode(',', $options['suppress-referrer']) as $id) {
                if ($id != "") {
                    array_push($suppress_referrer, $id);
                }
            }
            return $suppress_referrer;
        }

        /**
         * Converts any array to an array of ints by converting each element in the array to an int.
         *
         * @param $array_in array to be converted
         * @return array converted array
         */
        private function to_int_array($array_in)
        {
            $array_out = array();

            if (isset($array_in) && is_array($array_in)) {
                foreach ($array_in as $id) {
                    array_push($array_out, intval($id));
                }
            }
            return $array_out;
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_category($options)
        {
            return isset($options['suppress-category']) ? $this->to_int_array($options['suppress-category']) : array();
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_tag($options)
        {
            return isset($options['suppress-tag']) ? $this->to_int_array($options['suppress-tag']) : array();
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_user($options)
        {
            return isset($options['suppress-user']) ? $this->to_int_array($options['suppress-user']) : array();
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_format($options)
        {
            return isset($options['suppress-format']) ? $options['suppress-format'] : array();
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_post_type($options)
        {
            return isset($options['suppress-post-type']) ? $options['suppress-post-type'] : array();
        }

        /**
         * @param $options settings for this plugin
         * @return array
         */
        public function get_suppress_language($options)
        {
            return isset($options['suppress-language']) ? $options['suppress-language'] : array();
        }

        /**
         * @param $needle
         * @param $haystack
         * @return bool
         */
        public function in_array_substr($needle, $haystack)
        {
            foreach ($haystack as $hay_item) {
                if ($hay_item !== "" && strpos($needle, $hay_item)) {
                    return true;
                }
            }
            return false;
        }

        /**
         * @param $options settings for this plugin
         * @param $content contents of the current post
         * @return bool
         */
        public function is_suppress_specific($options, $content)
        {
            $suppress_post_id = $this->get_suppress_post_id($options);
            $suppress_category = $this->get_suppress_category($options);
            $suppress_tag = $this->get_suppress_tag($options);
            $suppress_user = $this->get_suppress_user($options);
            $suppress_format = $this->get_suppress_format($options);
            $suppress_post_type = $this->get_suppress_post_type($options);
            $suppress_language = $this->get_suppress_language($options);
            $suppress_url = $this->get_suppress_url($options);
            $suppress_referrer = $this->get_suppress_referrer($options);
            $suppress_ipaddress = $this->get_suppress_ipaddress($options);

            return ((is_array($suppress_format) && count($suppress_format) > 0 && in_array(get_post_format(), $suppress_format))
                || (is_array($suppress_user) && count($suppress_user) > 0 && in_array(get_the_author_meta('ID'), $suppress_user))
                || (is_array($suppress_tag) && count($suppress_tag) > 0 && has_tag($suppress_tag))
                || (is_array($suppress_category) && count($suppress_category) > 0 && has_category($suppress_category))
                || (is_array($suppress_post_type) && count($suppress_post_type) > 0 && in_array(get_post_type(get_the_ID()), $suppress_post_type))
                || (is_array($suppress_language) && count($suppress_language) > 0 && function_exists('qtrans_getLanguage') && in_array(qtrans_getLanguage(), $suppress_language))
                || (is_array($suppress_url) && count($suppress_url) > 0 && $this->in_array_substr(get_permalink(get_the_ID()), $suppress_url))
                || (is_array($suppress_referrer) && count($suppress_referrer) > 0 && $this->in_array_substr($_SERVER['HTTP_REFERER'], $suppress_referrer))
                || (is_array($suppress_ipaddress) && count($suppress_ipaddress) > 0 && $this->in_array_substr($_SERVER['REMOTE_ADDR'], $suppress_ipaddress))
                || (!is_feed() && !is_home() && in_array(get_the_ID(), $suppress_post_id))
                || (!is_feed() && !is_home() && strpos($content, '<!--NoAds-->') !== false)
                || (!is_feed() && !is_home() && strpos($content, '<!--NoWidgetAds-->') !== false)
                || (is_single() && isset($options['suppress-on-posts']) && $options['suppress-on-posts'] == 1)
                || (is_page() && isset($options['suppress-on-pages']) && $options['suppress-on-pages'] == 1)
                || (is_attachment() && isset($options['suppress-on-attachment']) && $options['suppress-on-attachment'] == 1)
                || (is_category() && isset($options['suppress-on-category']) && $options['suppress-on-category'] == 1)
                || (is_tag() && isset($options['suppress-on-tag']) && $options['suppress-on-tag'] == 1)
                || (is_home() && isset($options['suppress-on-home']) && $options['suppress-on-home'] == 1)
                || (is_front_page() && isset($options['suppress-on-front']) && $options['suppress-on-front'] == 1)
                || (is_archive() && isset($options['suppress-on-archive']) && $options['suppress-on-archive'] == 1)
                || (is_author() && isset($options['suppress-on-author']) && $options['suppress-on-author'] == 1)
                || (is_404() && isset($options['suppress-on-error']) && $options['suppress-on-error'] == 1)
                || (function_exists('bnc_wptouch_is_mobile') && bnc_wptouch_is_mobile() && $options['suppress-on-wptouch'] == 1)
                || (is_user_logged_in() && isset($options['suppress-on-logged-in']) && $options['suppress-on-logged-in'] == 1)
            );
        }

        /**
         * Counts the number of HTML paragraphs in the provided content.
         *
         * @param $content contents of the current post
         * @return int the number of HTML paragraphs in the provided content.
         */
        public function get_paragraph_count($content)
        {
            return substr_count($content, '</p>');
        }

        /**
         * Counts the words in the provided content after stripping all HTML tags
         *
         * @param $content contents of the current post
         * @return int the number of words in the provided content
         */
        public function get_word_count($content)
        {
            return str_word_count(strip_tags($content));
        }

        /**
         * Counts the characters in the provided content after stripping all HTML tags
         *
         * @param $content contents of the current post
         * @return int the number of characters in the provided content
         */
        public function get_character_count($content)
        {
            return strlen(strip_tags($content));
        }

        /**
         * Adds the ad blocks to be displayed in the provided contents
         *
         * @param $content contents of the current post
         * @return string the post contents with the additionally configured ad blocks
         */
        public function show_ad_in_content($content)
        {
            global $homepage_below_title_count;
            if (!isset($homepage_below_title_count)) $homepage_below_title_count = 0;

            $homepage_below_title = "";
            $post_below_title = "";
            $post_below_content = "";
            $page_below_title = "";
            $page_below_content = "";

            $content = str_replace('</P>', '</p>', $content);
            $char_count = $this->get_character_count($content);
            $word_count = $this->get_word_count($content);
            $paragraph_count = $this->get_paragraph_count($content);

            $options = $this->modules['WPAI_Settings']->settings['options'];

            if ($this->is_suppress_specific($options, $content)) {
                return $content;
            }

            $blocks = $this->RemoveSuppressBlocks($this->modules['WPAI_Settings']->settings['blocks'], $content);

            $homepage_below_title_block = $this->modules['WPAI_Settings']->settings['placements']['homepage-below-title'];
            $post_below_title_block = $this->modules['WPAI_Settings']->settings['placements']['post-below-title'];
            $post_below_content_block = $this->modules['WPAI_Settings']->settings['placements']['post-below-content'];
            $page_below_title_block = $this->modules['WPAI_Settings']->settings['placements']['page-below-title'];
            $page_below_content_block = $this->modules['WPAI_Settings']->settings['placements']['page-below-content'];
            $middle_of_post_block = $this->modules['WPAI_Settings']->settings['placements']['middle-of-post'];
            $middle_of_page_block = $this->modules['WPAI_Settings']->settings['placements']['middle-of-page'];
            $before_last_post_paragraph_block = $this->modules['WPAI_Settings']->settings['placements']['before-last-post-paragraph'];
            $before_last_page_paragraph_block = $this->modules['WPAI_Settings']->settings['placements']['before-last-page-paragraph'];
            $after_first_post_paragraph_block = $this->modules['WPAI_Settings']->settings['placements']['after-first-post-paragraph'];
            $after_first_page_paragraph_block = $this->modules['WPAI_Settings']->settings['placements']['after-first-page-paragraph'];

            if (!is_feed() && strpos($content, '<!--NoHomePageAds-->') !== false) {
                $homepage_below_title_block = "";
            }
            if (!is_feed() && strpos($content, '<!--NoBelowTitleAds-->') !== false) {
                $post_below_title_block = "";
                $page_below_title_block = "";
                $homepage_below_title_block = "";
            }
            if (!is_feed() && strpos($content, '<!--NoBelowContentAds-->') !== false) {
                $post_below_content_block = "";
                $page_below_content_block = "";
                $homepage_below_title_block = "";
            }
            if (!is_feed() && strpos($content, '<!--NoMiddleOfContentAds-->') !== false) {
                $middle_of_post_block = "";
                $middle_of_page_block = "";
            }
            if (!is_feed() && strpos($content, '<!--NoBeforeLastParagraphAds-->') !== false) {
                $before_last_post_paragraph_block = "";
                $before_last_page_paragraph_block = "";
            }
            if (!is_feed() && strpos($content, '<!--NoAfterFirstParagraphAds-->') !== false) {
                $after_first_post_paragraph_block = "";
                $after_first_page_paragraph_block = "";
            }

            if ($homepage_below_title_block != "") {
                $homepage_below_title = WPAI_Settings::get_ad_block($blocks, $homepage_below_title_block);
            }
            if ($post_below_title_block != "") {
                $post_below_title = WPAI_Settings::get_ad_block($blocks, $post_below_title_block);
            }
            if ($post_below_content_block != "") {
                $post_below_content = WPAI_Settings::get_ad_block($blocks, $post_below_content_block);
            }
            if ($page_below_title_block != "") {
                $page_below_title = WPAI_Settings::get_ad_block($blocks, $page_below_title_block);
            }
            if ($page_below_content_block != "") {
                $page_below_content = WPAI_Settings::get_ad_block($blocks, $page_below_content_block);
            }
            if (is_single()
                && $middle_of_post_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $middle_of_post = WPAI_Settings::get_ad_block($blocks, $middle_of_post_block);
                $middle_paragraph = (int)($paragraph_count / 2);
                $index = 0;
                for ($i = 0; $i < $middle_paragraph; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $middle_of_post, $index, 0);
            } else if (is_page()
                && $middle_of_page_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $middle_of_page = WPAI_Settings::get_ad_block($blocks, $middle_of_page_block);
                $middle_paragraph = (int)($paragraph_count / 2);
                $index = 0;
                for ($i = 0; $i < $middle_paragraph; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $middle_of_page, $index, 0);
            }
            if (is_single()
                && $before_last_post_paragraph_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $before_last_post_paragraph = WPAI_Settings::get_ad_block($blocks, $before_last_post_paragraph_block);
                $index = 0;
                for ($i = 0; $i < $paragraph_count - 1; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $before_last_post_paragraph, $index, 0);
            } else if (is_page()
                && $before_last_page_paragraph_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $before_last_page_paragraph = WPAI_Settings::get_ad_block($blocks, $before_last_page_paragraph_block);
                $index = 0;
                for ($i = 0; $i < $paragraph_count - 1; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $before_last_page_paragraph, $index, 0);
            }
            if (is_single()
                && $after_first_post_paragraph_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $after_first_post_paragraph = WPAI_Settings::get_ad_block($blocks, $after_first_post_paragraph_block);
                $index = 0;
                for ($i = 0; $i < 1; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $after_first_post_paragraph, $index, 0);
            } else if (is_page()
                && $after_first_page_paragraph_block != ""
                && intval($options['min-char-count']) <= $char_count
                && intval($options['min-word-count']) <= $word_count
                && intval($options['min-paragraph-count']) <= $paragraph_count
            ) {
                $after_first_page_paragraph = WPAI_Settings::get_ad_block($blocks, $after_first_page_paragraph_block);
                $index = 0;
                for ($i = 0; $i < 1; $i++) {
                    $index = strpos($content, '</p>', $index) + 4;
                }
                $content = substr_replace($content, $after_first_page_paragraph, $index, 0);
            }
            if (is_single()) {
                return $post_below_title . $content . $post_below_content;
            } else if (is_home()) {
                if (empty($options['homepage-below-title-max']) || $homepage_below_title_count < $options['homepage-below-title-max']) {
                    $homepage_below_title_count++;
                    return $homepage_below_title . $content;
                } else {
                    return $content;
                }
            } else if (is_page()) {
                return $page_below_title . $content . $page_below_content;
            } else {
                return $content;
            }
        }

        /**
         * Displays ad blocks at regular intervals between posts in a multi-post page
         *
         * @param $post the current post in a multi-post page
         */
        public function show_ad_between_posts($post)
        {
            global $wp_query;

            if (((!is_home()) && (!is_archive())) || $wp_query->post != $post || 0 == $wp_query->current_post) {
                return;
            }

            $options = $this->modules['WPAI_Settings']->settings['options'];
            $every = isset($options['between-posts-every']) ? intval($options['between-posts-every']) : 0;
            $max = isset($options['between-posts-every']) ? intval($options['between-posts-max']) : 0;

            if ($every > 0 && $wp_query->current_post % $every == 0 && $wp_query->current_post <= $every * $max) {
                $blocks = $this->modules['WPAI_Settings']->settings['blocks'];
                $between_posts_block = $this->modules['WPAI_Settings']->settings['placements']['between-posts'];
                if (isset($between_posts_block) && $between_posts_block != "") {
                    echo WPAI_Settings::get_ad_block($blocks, $between_posts_block);
                }
            }
        }

        /**
         * Displays an ad block (if configured).
         * This function is called after the footer has been rendered. The ad block is thus displayed below the footer.
         */
        public function show_ad_below_footer()
        {
            $all_below_footer = "";

            $content = get_the_content();
            $blocks = $this->RemoveSuppressBlocks($this->modules['WPAI_Settings']->settings['blocks'], $content);
            $all_below_footer_block = $this->modules['WPAI_Settings']->settings['placements']['all-below-footer'];

            $options = $this->modules['WPAI_Settings']->settings['options'];

            if ($this->is_suppress_specific($options, $content)) {
                return;
            }

            if ($all_below_footer_block != "") {
                $all_below_footer = WPAI_Settings::get_ad_block($blocks, $all_below_footer_block);
            }

            echo $all_below_footer;
        }

        /**
         * Displays an ad block (if configured).
         * This function is called after the comment section has been rendered. The ad block is thus displayed below the comment section.
         */
        public function show_ad_below_comments()
        {
            $post_below_comments = "";
            $page_below_comments = "";

            $content = get_the_content();
            $blocks = $this->RemoveSuppressBlocks($this->modules['WPAI_Settings']->settings['blocks'], $content);
            $post_below_comments_block = $this->modules['WPAI_Settings']->settings['placements']['post-below-comments'];
            $page_below_comments_block = $this->modules['WPAI_Settings']->settings['placements']['page-below-comments'];

            $options = $this->modules['WPAI_Settings']->settings['options'];

            if ($this->is_suppress_specific($options, $content)) {
                return;
            }

            if ($post_below_comments_block != "") {
                $post_below_comments = WPAI_Settings::get_ad_block($blocks, $post_below_comments_block);
            }
            if ($page_below_comments_block != "") {
                $page_below_comments = WPAI_Settings::get_ad_block($blocks, $page_below_comments_block);
            }

            if (is_single()) {
                echo $post_below_comments;
            } else if (is_page()) {
                echo $page_below_comments;
            }
        }

        /**
         * Initializes variables
         *
         * @mvc Controller
         */
        public function init()
        {
            try {
                $instance_example = new WPAI_Instance_Class('Instance example', '42');
                //add_notice( $instance_example->foo .' '. $instance_example->bar );
            } catch (Exception $exception) {
                add_notice(__METHOD__ . ' error: ' . $exception->getMessage(), 'error');
            }
        }

        /**
         * Checks if the plugin was recently updated and upgrades if necessary
         *
         * @mvc Controller
         *
         * @param string $db_version
         */
        public function upgrade($db_version = 0)
        {
            if (version_compare($this->modules['WPAI_Settings']->settings['db-version'], self::VERSION, '==')) {
                return;
            }

            foreach ($this->modules as $module) {
                $module->upgrade($this->modules['WPAI_Settings']->settings['db-version']);
            }

            $this->modules['WPAI_Settings']->settings = array('db-version' => self::VERSION);
            self::clear_caching_plugins();
        }

        /**
         * Removes the ad blocks which are disabled with the NoAdBlock comment in the post contents.
         *
         * @param $blocks all configured ad blocks
         * @param $content contents of the current post
         *
         * @return mixed the remaining ad blocks
         */
        public function RemoveSuppressBlocks($blocks, $content)
        {
            foreach ($blocks as $number => $code) {
                if (strpos($content, '<!--NoAdBlock' . ($number + 1) . '-->') !== false) {
                    $blocks[$number]['text'] = "";
                }
            }

            return $blocks;
        }

        /**
         * Checks that the object is in a correct state
         *
         * @mvc Model
         *
         * @param string $property An individual property to check, or 'all' to check all of them
         * @return bool
         */
        protected function is_valid($property = 'all')
        {
            return true;
        }
    }
    ; // end WordPress_Advertize_It
}
