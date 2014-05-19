<?php

if (!class_exists('WPAI_Settings')) {

    /**
     * Handles plugin settings and user profile meta fields
     */
    class WPAI_Settings extends WPAI_Module
    {
        protected $settings;
        protected static $default_settings;
        protected static $readable_properties = array('settings');
        protected static $writeable_properties = array('settings');

        const REQUIRED_CAPABILITY = 'administrator';


        /*
         * General methods
         */

        /**
         * Constructor
         *
         * @mvc Controller
         */
        protected function __construct()
        {
            $this->register_hook_callbacks();
        }

        /**
         * Public setter for protected variables
         *
         * Updates settings outside of the Settings API or other subsystems
         *
         * @mvc Controller
         *
         * @param string $variable
         * @param array $value This will be merged with WPAI_Settings->settings, so it should mimic the structure of the WPAI_Settings::$default_settings. It only needs the contain the values that will change, though. See WordPress_Advertize_It->upgrade() for an example.
         */
        public function __set($variable, $value)
        {
            // Note: WPAI_Module::__set() is automatically called before this

            if ($variable != 'settings') {
                return;
            }

            $this->settings = self::validate_settings($value);
            update_option('wpai_settings', $this->settings);
        }

        /**
         * Register callbacks for actions and filters
         *
         * @mvc Controller
         */
        public function register_hook_callbacks()
        {
            add_action('admin_menu', __CLASS__ . '::register_settings_pages');
            add_action('init', array($this, 'init'));
            add_action('admin_init', array($this, 'register_settings'));

            add_filter(
                'plugin_action_links_' . plugin_basename(dirname(__DIR__)) . '/bootstrap.php',
                __CLASS__ . '::add_plugin_action_links'
            );
        }

        /**
         * Prepares site to use the plugin during activation
         *
         * @mvc Controller
         *
         * @param bool $network_wide
         */
        public function activate($network_wide)
        {
        }

        /**
         * Rolls back activation procedures when de-activating the plugin
         *
         * @mvc Controller
         */
        public function deactivate()
        {
        }

        /**
         * Initializes variables
         *
         * @mvc Controller
         */
        public function init()
        {
            self::$default_settings = self::get_default_settings();
            $this->settings = self::get_settings();
        }

        /**
         * Executes the logic of upgrading from specific older versions of the plugin to the current version
         *
         * @mvc Model
         *
         * @param string $db_version
         */
        public function upgrade($db_version = 0)
        {
            /*
            if( version_compare( $db_version, 'x.y.z', '<' ) )
            {
                // Do stuff
            }
            */
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
            // Note: __set() calls validate_settings(), so settings are never invalid

            return true;
        }


        /*
         * Plugin Settings
         */

        /**
         * Establishes initial values for all settings
         *
         * @mvc Model
         *
         * @return array
         */
        protected static function get_default_settings()
        {
            $blocks = array();

            $placements = array(
                "homepage_below_title" => "",
                "post_below_title" => "",
                "post_below_content" => "",
                "post_below_comments" => "",
                "page_below_title" => "",
                "page_below_content" => "",
                "page_below_comments" => "",
                "all_below_footer" => "",
                "middle_of_post" => "",
                "before_last_post_paragraph" => "",
                "before_last_page_paragraph" => "",
                "after_first_post_paragraph" => "",
                "after_first_page_paragraph" => ""
            );

            $options = array(
                "suppress_on_posts" => false,
                "suppress_on_pages" => false,
                "suppress_on_attachment" => false,
                "suppress_on_category" => false,
                "suppress_on_tag" => false,
                "suppress_on_home" => false,
                "suppress_on_front" => false,
                "suppress_on_archive" => false,
                "suppress_on_logged_in" => false,
                "suppress-post-id" => ""
            );

            return array(
                'db-version' => '0',
                'blocks' => $blocks,
                'placements' => $placements,
                'options' => $options
            );
        }

        /**
         * Retrieves all of the settings from the database
         *
         * @mvc Model
         *
         * @return array
         */
        protected static function get_settings()
        {
            $settings = shortcode_atts(
                self::$default_settings,
                get_option('wpai_settings', array())
            );

            return $settings;
        }

        /**
         * Adds links to the plugin's action link section on the Plugins page
         *
         * @mvc Model
         *
         * @param array $links The links currently mapped to the plugin
         * @return array
         */
        public static function add_plugin_action_links($links)
        {
            array_unshift($links, '<a href="http://wordpress.org/extend/plugins/wp-advertize-it/faq/">Help</a>');
            array_unshift($links, '<a href="options-general.php?page=' . 'wpai_settings">Settings</a>');

            return $links;
        }

        /**
         * Adds pages to the Admin Panel menu
         *
         * @mvc Controller
         */
        public static function register_settings_pages()
        {
            add_submenu_page(
                'options-general.php',
                WPAI_NAME . ' Settings',
                WPAI_NAME,
                self::REQUIRED_CAPABILITY,
                'wpai_settings',
                __CLASS__ . '::markup_settings_page'
            );
        }

        /**
         * Creates the markup for the Settings page
         *
         * @mvc Controller
         */
        public static function markup_settings_page()
        {
            if (current_user_can(self::REQUIRED_CAPABILITY)) {
                echo self::render_template('wpai-settings/page-settings.php');
            } else {
                wp_die('Access denied.');
            }
        }

        private function add_settings_field($id, $title, $section)
        {
            add_settings_field(
                $id,
                $title,
                array($this, 'markup_fields'),
                'wpai_settings',
                $section,
                array('label_for' => $id)
            );
        }

        private function add_settings_field_blocks($id, $title)
        {
            $this->add_settings_field($id, $title, 'wpai_section-blocks');
        }

        private function add_settings_field_placements($id, $title)
        {
            $this->add_settings_field($id, $title, 'wpai_section-placements');
        }

        private function add_settings_field_options($id, $title)
        {
            $this->add_settings_field($id, $title, 'wpai_section-options');
        }

        private function add_settings_section($id, $title)
        {
            add_settings_section(
                $id,
                $title,
                __CLASS__ . '::markup_section_headers',
                'wpai_settings'
            );
        }

        /**
         * Registers settings sections, fields and settings
         *
         * @mvc Controller
         */
        public function register_settings()
        {
            $blocks = $this->settings['blocks'];

            /*
             * Block Section
             */
            $this->add_settings_section('wpai_section-blocks', 'Ad Blocks');

            foreach ($blocks as $i => $block) {
                $this->add_settings_field_blocks('wpai_block-' . ($i + 1), 'Ad Block ' . ($i + 1));
            }

            /*
             * Placement Section
             */
            $this->add_settings_section('wpai_section-placements', 'Placements');

            $this->add_settings_field_placements('wpai_homepage-below-title', 'Home page below title');
            $this->add_settings_field_placements('wpai_post-below-title', 'Posts below title');
            $this->add_settings_field_placements('wpai_after-first-post-paragraph', 'After first post paragraph');
            $this->add_settings_field_placements('wpai_middle-of-post', 'Middle of post');
            $this->add_settings_field_placements('wpai_before-last-post-paragraph', 'Before last post paragraph');
            $this->add_settings_field_placements('wpai_post-below-content', 'Posts below content');
            $this->add_settings_field_placements('wpai_post-below-comments', 'Posts below comments');
            $this->add_settings_field_placements('wpai_page-below-title', 'Pages below title');
            $this->add_settings_field_placements('wpai_after-first-page-paragraph', 'After first page paragraph');
            $this->add_settings_field_placements('wpai_middle-of-page', 'Middle of page');
            $this->add_settings_field_placements('wpai_before-last-page-paragraph', 'Before last page paragraph');
            $this->add_settings_field_placements('wpai_page-below-content', 'Pages below content');
            $this->add_settings_field_placements('wpai_page-below-comments', 'Pages below comments');
            $this->add_settings_field_placements('wpai_all-below-footer', 'Below footer');

            /*
             * Options Section
             */
            $this->add_settings_section('wpai_section-options', 'Options');

            $this->add_settings_field_options('wpai_suppress-on-posts', 'Suppress ads on posts');
            $this->add_settings_field_options('wpai_suppress-on-pages', 'Suppress ads on pages');
            $this->add_settings_field_options('wpai_suppress-on-attachment', 'Suppress ads on attachment');
            $this->add_settings_field_options('wpai_suppress-on-category', 'Suppress ads on category');
            $this->add_settings_field_options('wpai_suppress-on-tag', 'Suppress ads on tag');
            $this->add_settings_field_options('wpai_suppress-on-home', 'Suppress ads on home page');
            $this->add_settings_field_options('wpai_suppress-on-front', 'Suppress ads on front page');
            $this->add_settings_field_options('wpai_suppress-on-archive', 'Suppress ads on archive');
            $this->add_settings_field_options('wpai_suppress-on-logged-in', 'Suppress ads for logged in users');
            $this->add_settings_field_options('wpai_suppress-post-id', 'Suppress ads for specific post/page IDs');

            // The settings container
            register_setting('wpai_settings', 'wpai_settings', array($this, 'validate_settings'));
        }

        /**
         * Adds the section introduction text to the Settings page
         *
         * @mvc Controller
         *
         * @param array $section
         */
        public static function markup_section_headers($section)
        {
            echo self::render_template('wpai-settings/page-settings-section-headers.php', array('section' => $section), 'always');
        }


        public static function get_ad_block($blocks, $id)
        {
            if (isset($blocks[intval($id)])) {
                return $blocks[intval($id)];
            }
            return "";
        }

        /**
         * Delivers the markup for settings fields
         *
         * @mvc Controller
         *
         * @param array $field
         */
        public function markup_fields($field)
        {
            echo self::render_template('wpai-settings/page-settings-fields.php', array('settings' => $this->settings, 'field' => $field), 'always');
        }

        private function setting_default_if_not_set($new_settings, $section, $id, $value)
        {
            if (!isset($new_settings[$section][$id])) {
                $new_settings[$section][$id] = $value;
            }
        }

        private function setting_empty_if_not_set($new_settings, $section, $id)
        {
            $this->setting_default_if_not_set($new_settings, $section, $id, '');
        }

        private function setting_zero_if_not_set($new_settings, $section, $id)
        {
            $this->setting_default_if_not_set($new_settings, $section, $id, '0');
        }

        /**
         * Validates submitted setting values before they get saved to the database. Invalid data will be overwritten with defaults.
         *
         * @mvc Model
         *
         * @param array $new_settings
         * @return array
         */
        public function validate_settings($new_settings)
        {
            $new_settings = shortcode_atts($this->settings, $new_settings);

            if (!is_string($new_settings['db-version'])) {
                $new_settings['db-version'] = WordPress_Advertize_It::VERSION;
            }

            /*
             * Blocks Settings
             */

            if (!isset($new_settings['blocks'])) {
                $new_settings['blocks'] = array();
            }

            /*
             * Placements Settings
             */

            if (!isset($new_settings['placements'])) {
                $new_settings['placements'] = array();
            }

            $this->setting_empty_if_not_set($new_settings, 'placements', 'homepage-below-title');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'post-below-title');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'post-below-content');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'post-below-comments');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'page-below-title');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'page-below-content');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'page-below-comments');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'all-below-footer');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'middle-of-post');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'middle-of-page');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'before-last-post-paragraph');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'before-last-page-paragraph');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'after-first-post-paragraph');
            $this->setting_empty_if_not_set($new_settings, 'placements', 'after-first-page-paragraph');

            /*
             * Options Settings
             */

            if (!isset($new_settings['options'])) {
                $new_settings['options'] = array();
            }

            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-posts');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-pages');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-attachment');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-category');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-tag');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-home');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-front');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-archive');
            $this->setting_zero_if_not_set($new_settings, 'options', 'suppress-on-logged-in');
            $this->setting_empty_if_not_set($new_settings, 'options', 'suppress-post-id');

            return $new_settings;
        }
    } // end WPAI_Settings
}
