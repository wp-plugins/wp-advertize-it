<?php
/*
 * Blocks Section
 */
?>

<?php if (strpos($field['label_for'], 'wpai_block-') === 0) : ?>

    <textarea style="width: 95%;" wrap="soft" rows="5" id="<?php esc_attr_e($field['label_for']); ?>"
              name="<?php esc_attr_e('wpai_settings[blocks][' . (intval(substr($field['label_for'], strlen('wpai_block-'))) - 1) . ']'); ?>"
              class="regular-text"><?php esc_attr_e($settings['blocks'][intval(substr($field['label_for'], strlen('wpai_block-'))) - 1]); ?></textarea>
    <input type="checkbox"
           id="checkbox_<?php esc_attr_e('wpai_settings[blocks][' . substr($field['label_for'], strlen('wpai_block-')) . ']'); ?>"
           data-ad-block="<?php esc_attr_e($field['label_for']); ?>" class="delete-checkbox"/>

<?php endif; ?>


<?php
/*
 * Placements Section
 */
?>

<?php if ('wpai_homepage-below-title' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][homepage-below-title]"
            name="wpai_settings[placements][homepage-below-title]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['homepage-below-title'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['homepage-below-title'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php elseif ('wpai_post-below-title' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][post-below-title]"
            name="wpai_settings[placements][post-below-title]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['post-below-title'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['post-below-title'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_post-below-content' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][post-below-content]"
            name="wpai_settings[placements][post-below-content]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['post-below-content'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['post-below-content'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_post-below-comments' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][post-below-comments]"
            name="wpai_settings[placements][post-below-comments]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['post-below-comments'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['post-below-comments'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_page-below-title' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][page-below-title]"
            name="wpai_settings[placements][page-below-title]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['page-below-title'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['page-below-title'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_page-below-content' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][page-below-content]"
            name="wpai_settings[placements][page-below-content]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['page-below-content'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['page-below-content'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_page-below-comments' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][page-below-comments]"
            name="wpai_settings[placements][page-below-comments]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['page-below-comments'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['page-below-comments'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_all-below-footer' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][all-below-footer]"
            name="wpai_settings[placements][all-below-footer]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['all-below-footer'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['all-below-footer'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_middle-of-post' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][middle-of-post]"
            name="wpai_settings[placements][middle-of-post]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['middle-of-post'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['middle-of-post'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_middle-of-page' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][middle-of-page]"
            name="wpai_settings[placements][middle-of-page]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['middle-of-page'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['middle-of-page'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_before-last-post-paragraph' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][before-last-post-paragraph]"
            name="wpai_settings[placements][before-last-post-paragraph]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['before-last-post-paragraph'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['before-last-post-paragraph'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_before-last-page-paragraph' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][before-last-page-paragraph]"
            name="wpai_settings[placements][before-last-page-paragraph]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['before-last-page-paragraph'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['before-last-page-paragraph'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_after-first-post-paragraph' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][after-first-post-paragraph]"
            name="wpai_settings[placements][after-first-post-paragraph]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['after-first-post-paragraph'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['after-first-post-paragraph'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_after-first-page-paragraph' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][after-first-page-paragraph]"
            name="wpai_settings[placements][after-first-page-paragraph]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['after-first-page-paragraph'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['after-first-page-paragraph'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_suppress-on-posts' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-posts]"
           id="wpai_settings[options][suppress-on-posts]"
           value="1" <?php checked(1, $settings['options']['suppress-on-posts']) ?>>
<?php
elseif ('wpai_suppress-on-pages' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-pages]"
           id="wpai_settings[options][suppress-on-pages]"
           value="1" <?php checked(1, $settings['options']['suppress-on-pages']) ?>>
<?php
elseif ('wpai_suppress-on-attachment' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-attachment]"
           id="wpai_settings[options][suppress-on-attachment]"
           value="1" <?php checked(1, $settings['options']['suppress-on-attachment']) ?>>
<?php
elseif ('wpai_suppress-on-category' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-category]"
           id="wpai_settings[options][suppress-on-category]"
           value="1" <?php checked(1, $settings['options']['suppress-on-category']) ?>>
<?php
elseif ('wpai_suppress-on-tag' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-tag]" id="wpai_settings[options][suppress-on-tag]"
           value="1" <?php checked(1, $settings['options']['suppress-on-tag']) ?>>
<?php
elseif ('wpai_suppress-on-home' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-home]" id="wpai_settings[options][suppress-on-home]"
           value="1" <?php checked(1, $settings['options']['suppress-on-home']) ?>>
<?php
elseif ('wpai_suppress-on-front' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-front]"
           id="wpai_settings[options][suppress-on-front]"
           value="1" <?php checked(1, $settings['options']['suppress-on-front']) ?>>
<?php
elseif ('wpai_suppress-on-archive' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-archive]"
           id="wpai_settings[options][suppress-on-archive]"
           value="1" <?php checked(1, $settings['options']['suppress-on-archive']) ?>>
<?php
elseif ('wpai_suppress-on-logged-in' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-logged-in]"
           id="wpai_settings[options][suppress-on-logged-in]"
           value="1" <?php checked(1, $settings['options']['suppress-on-logged-in']) ?>>
<?php
elseif ('wpai_suppress-post-id' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][suppress-post-id]"
           id="wpai_settings[options][suppress-post-id]"
           value="<?php echo $settings['options']['suppress-post-id']; ?>">
<?php endif; ?>