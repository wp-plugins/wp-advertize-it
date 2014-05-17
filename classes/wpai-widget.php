<?php

/**
 * Created by PhpStorm.
 * User: benohead
 * Date: 09.05.14
 * Time: 13:55
 */
class WPAI_Widget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'wpai_widget',
            __('Ad Block', 'wpai_widget_domain'),
            array('description' => __('WP Advertize It', 'wpai_widget_domain'),)
        );
    }

    public function widget($args, $instance)
    {
        $content = get_the_content();

        $options = WPAI_Settings::get_instance()->settings['options'];

        if (!is_feed() && strpos($content, '<!--NoAds-->') !== false) {
            return;
        }
        if (!is_feed() && strpos($content, '<!--NoWidgetAds-->') !== false) {
            return;
        }

        if (is_single() && $options['suppress-on-posts'] == 1) {
            return;
        }
        if (is_page() && $options['suppress-on-pages'] == 1) {
            return;
        }
        if (is_attachment() && $options['suppress-on-attachment'] == 1) {
            return;
        }
        if (is_category() && $options['suppress-on-category'] == 1) {
            return;
        }
        if (is_tag() && $options['suppress-on-tag'] == 1) {
            return;
        }
        if (is_home() && $options['suppress-on-home'] == 1) {
            return;
        }
        if (is_front_page() && $options['suppress-on-front'] == 1) {
            return;
        }
        if (is_archive() && $options['suppress-on-archive'] == 1) {
            return;
        }
        if (is_user_logged_in() && $options['suppress-on-logged-in'] == 1) {
            return;
        }

        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        $block = $instance['block'];
        $blocks = WPAI_Settings::get_instance()->settings['blocks'];
        echo WPAI_Settings::get_ad_block($blocks, $block);
    }

    public function form($instance)
    {
        $settings = WPAI_Settings::get_instance()->settings;

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'wpai_widget_domain');
        }

        if (isset($instance['block'])) {
            $selected_block = $instance['block'];
        } else {
            $selected_block = "";
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('block'); ?>"><?php _e('Ad Block:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('block'); ?>"
                    name="<?php echo $this->get_field_name('block'); ?>">
                <?php
                foreach ($settings['blocks'] as $i => $block) :
                    $label = 'Ad Block ' . ($i + 1);
                    $selected = '';
                    if ($selected_block == $i)
                        $selected = 'selected="selected"';
                    ?>
                    <option style="padding-right: 10px;"
                            value="<?php echo esc_attr($i); ?>" <?php echo $selected ?>><?php echo $label ?></option>
                <?php
                endforeach;
                ?>
            </select>
        </p>
    <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['block'] = (!empty($new_instance['block'])) ? strip_tags($new_instance['block']) : '';
        return $instance;
    }
} // Class wpai_widget ends here

// Register and load the widget
function wpai_load_widget()
{
    register_widget('wpai_widget');
}

add_action('widgets_init', 'wpai_load_widget');