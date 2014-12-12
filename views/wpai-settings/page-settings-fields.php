<?php
/*
 * Blocks Section
 */
?>

<?php if (strpos($field['label_for'], 'wpai_block-') === 0) : ?>

	<div id="<?php esc_attr_e($field['label_for']); ?>_div"></div>
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
elseif ('wpai_between-posts' == $field['label_for']) : ?>
    <select class="placement-block-select" id="wpai_settings[placements][between-posts]"
            name="wpai_settings[placements][between-posts]">
        <?php
        foreach ($settings['blocks'] as $i => $block) :
            $label = 'Ad Block ' . ($i + 1);
            $selected = '';
            if ($settings['placements']['between-posts'] == $i)
                $selected = 'selected="selected"';
            echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        endforeach;
        $i = "";
        $label = 'None';
        $selected = '';
        if ($settings['placements']['between-posts'] == $i)
            $selected = 'selected="selected"';
        echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
        ?>
    </select>
<?php
elseif ('wpai_above-everything' == $field['label_for']) : ?>
	<select class="placement-block-select" id="wpai_settings[placements][above-everything]"
	        name="wpai_settings[placements][above-everything]">
		<?php
		foreach ($settings['blocks'] as $i => $block) :
			$label = 'Ad Block ' . ($i + 1);
			$selected = '';
			if ($settings['placements']['above-everything'] == $i)
				$selected = 'selected="selected"';
			echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
		endforeach;
		$i = "";
		$label = 'None';
		$selected = '';
		if ($settings['placements']['above-everything'] == $i)
			$selected = 'selected="selected"';
		echo '<option data-block-id="wpai_block-' . esc_attr($i + 1) . '" style="padding-right: 10px;" value="' . esc_attr($i) . '" ' . $selected . '>' . $label . '</option>';
		?>
	</select>
<?php
elseif ('wpai_suppress-on-posts' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-posts]"
           id="wpai_settings[options][suppress-on-posts]"
           value="1" <?php if (isset($settings['options']['suppress-on-posts'])) checked(1, $settings['options']['suppress-on-posts']) ?>>
<?php
elseif ('wpai_suppress-on-pages' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-pages]"
           id="wpai_settings[options][suppress-on-pages]"
           value="1" <?php if (isset($settings['options']['suppress-on-pages'])) checked(1, $settings['options']['suppress-on-pages']) ?>>
<?php
elseif ('wpai_suppress-on-attachment' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-attachment]"
           id="wpai_settings[options][suppress-on-attachment]"
           value="1" <?php if (isset($settings['options']['suppress-on-attachment'])) checked(1, $settings['options']['suppress-on-attachment']) ?>>
<?php
elseif ('wpai_suppress-on-category' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-category]"
           id="wpai_settings[options][suppress-on-category]"
           value="1" <?php if (isset($settings['options']['suppress-on-pages'])) checked(1, $settings['options']['suppress-on-category']) ?>>
<?php
elseif ('wpai_suppress-on-tag' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-tag]" id="wpai_settings[options][suppress-on-tag]"
           value="1" <?php if (isset($settings['options']['suppress-on-pages'])) checked(1, $settings['options']['suppress-on-tag']) ?>>
<?php
elseif ('wpai_suppress-on-home' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-home]" id="wpai_settings[options][suppress-on-home]"
           value="1" <?php if (isset($settings['options']['suppress-on-home'])) checked(1, $settings['options']['suppress-on-home']) ?>>
<?php
elseif ('wpai_suppress-on-front' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-front]"
           id="wpai_settings[options][suppress-on-front]"
           value="1" <?php if (isset($settings['options']['suppress-on-front'])) checked(1, $settings['options']['suppress-on-front']) ?>>
<?php
elseif ('wpai_suppress-on-archive' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-archive]"
           id="wpai_settings[options][suppress-on-archive]"
           value="1" <?php if (isset($settings['options']['suppress-on-archive'])) checked(1, $settings['options']['suppress-on-archive']) ?>>
<?php
elseif ('wpai_suppress-on-author' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-author]"
           id="wpai_settings[options][suppress-on-author]"
           value="1" <?php if (isset($settings['options']['suppress-on-author'])) checked(1, $settings['options']['suppress-on-author']) ?>>
<?php
elseif ('wpai_suppress-on-error' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-error]"
           id="wpai_settings[options][suppress-on-error]"
           value="1" <?php if (isset($settings['options']['suppress-on-error'])) checked(1, $settings['options']['suppress-on-error']) ?>>
<?php
elseif ('wpai_suppress-on-wptouch' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-wptouch]"
           id="wpai_settings[options][suppress-on-wptouch]"
           value="1" <?php if (isset($settings['options']['suppress-on-wptouch'])) checked(1, $settings['options']['suppress-on-wptouch']) ?>>
<?php
elseif ('wpai_suppress-on-logged-in' == $field['label_for']) : ?>
    <input type="checkbox" name="wpai_settings[options][suppress-on-logged-in]"
           id="wpai_settings[options][suppress-on-logged-in]"
           value="1" <?php if (isset($settings['options']['suppress-on-logged-in'])) checked(1, $settings['options']['suppress-on-logged-in']) ?>>
<?php
elseif ('wpai_suppress-post-id' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][suppress-post-id]"
           id="wpai_settings[options][suppress-post-id]"
           value="<?php echo $settings['options']['suppress-post-id']; ?>" placeholder="e.g. 32,9-19,33">
<?php
elseif ('wpai_suppress-category' == $field['label_for']) : ?>
    <?php $categories = get_terms('category'); ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-category]"
            name="wpai_settings[options][suppress-category][]" size="4"
            multiple="multiple">
        <?php foreach ($categories as $category) { ?>
            <option
                value="<?php echo esc_attr($category->term_id); ?>" <?php echo(isset($settings['options']['suppress-category']) && in_array($category->term_id, (array)$settings['options']['suppress-category']) ? 'selected="selected"' : ''); ?>><?php echo esc_html($category->name); ?></option>
        <?php } ?>
    </select>
    <button id="clear-category" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-category\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-tag' == $field['label_for']) : ?>
    <?php $tags = get_terms('post_tag'); ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-tag]"
            name="wpai_settings[options][suppress-tag][]" size="4"
            multiple="multiple">
        <?php foreach ($tags as $tag) { ?>
            <option
                value="<?php echo esc_attr($tag->term_id); ?>" <?php echo(isset($settings['options']['suppress-tag']) && in_array($tag->term_id, (array)$settings['options']['suppress-tag']) ? 'selected="selected"' : ''); ?>><?php echo esc_html($tag->name); ?></option>
        <?php } ?>
    </select>
    <button id="clear-tag" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-tag\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-user' == $field['label_for']) : ?>
    <?php
    $allUsers = get_users('orderby=post_count&order=DESC');
    $users = array();
    // Remove subscribers from the list as they won't write any articles
    foreach ($allUsers as $currentUser) {
        if (!in_array('subscriber', $currentUser->roles)) {
            $users[] = $currentUser;
        }
    }
    ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-user]"
            name="wpai_settings[options][suppress-user][]" size="4"
            multiple="multiple">
        <?php foreach ($users as $user) { ?>
            <option
                value="<?php echo esc_attr($user->ID); ?>" <?php echo(isset($settings['options']['suppress-user']) && in_array($user->ID, (array)$settings['options']['suppress-user']) ? 'selected="selected"' : ''); ?>><?php echo esc_html($user->display_name); ?></option>
        <?php } ?>
    </select>
    <button id="clear-user" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-user\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-format' == $field['label_for']) : ?>
    <?php $formats = get_theme_support('post-formats'); ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-format]"
            name="wpai_settings[options][suppress-format][]" size="4"
            multiple="multiple">
        <?php
        if (is_array($formats) && count($formats) > 0) {
            ?>
            <option
                value="0" <?php echo(isset($settings['options']['suppress-format']) && in_array('0', (array)$settings['options']['suppress-format']) ? 'selected="selected"' : ''); ?>><?php echo get_post_format_string('standard'); ?></option>
            <?php
            foreach ($formats[0] as $format_name) {
                ?>
                <option
                    value="<?php echo esc_attr($format_name); ?>" <?php echo(isset($settings['options']['suppress-format']) && in_array($format_name, (array)$settings['options']['suppress-format']) ? 'selected="selected"' : ''); ?>><?php echo esc_html(get_post_format_string($format_name)); ?></option>
            <?php
            }
        }
        ?>
    </select>
    <button id="clear-format" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-format\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-post-type' == $field['label_for']) : ?>
    <?php $post_types = get_post_types(); ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-post-type]"
            name="wpai_settings[options][suppress-post-type][]" size="4"
            multiple="multiple">
        <?php
        foreach ($post_types as $post_type_name) {
            ?>
            <option
                value="<?php echo esc_attr($post_type_name); ?>" <?php echo(isset($settings['options']['suppress-post-type']) && in_array($post_type_name, (array)$settings['options']['suppress-post-type']) ? 'selected="selected"' : ''); ?>><?php echo esc_html(get_post_type_object($post_type_name)->labels->name); ?></option>
        <?php
        }
        ?>
    </select>
    <button id="clear-post-type" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-post-type\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-language' == $field['label_for'] && function_exists('qtrans_getSortedLanguages')) : ?>
    <?php $languages = qtrans_getSortedLanguages(); ?>
    <select style="min-width: 190px;" id="wpai_settings[options][suppress-language]"
            name="wpai_settings[options][suppress-language][]" size="4"
            multiple="multiple">
        <?php
        foreach ($languages as $language_name) {
            ?>
            <option
                value="<?php echo esc_attr($language_name); ?>" <?php echo(isset($settings['options']['suppress-language']) && in_array($language_name, (array)$settings['options']['suppress-language']) ? 'selected="selected"' : ''); ?>><?php echo $q_config['language_name'][$language_name]; ?></option>
        <?php
        }
        ?>
    </select>
    <button id="clear-language" class="button-secondary"
            onclick="jQuery('#wpai_settings\\[options\\]\\[suppress-language\\]')[0].selectedIndex = -1;return false;">
        Clear
    </button>
<?php
elseif ('wpai_suppress-language' == $field['label_for']) : ?>
    <p>This option is only available with the plugin <a href="https://wordpress.org/plugins/qtranslate/">qTranslate</a>
        or <a href="https://wordpress.org/plugins/mqtranslate/">mqTranslate</a>.</p>
<?php
elseif ('wpai_min-char-count' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][min-char-count]"
           id="wpai_settings[options][min-char-count]"
           value="<?php echo $settings['options']['min-char-count']; ?>">
<?php
elseif ('wpai_min-word-count' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][min-word-count]"
           id="wpai_settings[options][min-word-count]"
           value="<?php echo $settings['options']['min-word-count']; ?>">
<?php
elseif ('wpai_min-paragraph-count' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][min-paragraph-count]"
           id="wpai_settings[options][min-paragraph-count]"
           value="<?php echo $settings['options']['min-paragraph-count']; ?>">
<?php
elseif ('wpai_between-posts-every' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][between-posts-every]"
           id="wpai_settings[options][between-posts-every]"
           value="<?php echo isset($settings['options']['between-posts-every']) ? $settings['options']['between-posts-every'] : ''; ?>">
<?php
elseif ('wpai_between-posts-max' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][between-posts-max]"
           id="wpai_settings[options][between-posts-max]"
           value="<?php echo isset($settings['options']['between-posts-max']) ? $settings['options']['between-posts-max'] : ''; ?>">
<?php
elseif ('wpai_suppress-url' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][suppress-url]"
           id="wpai_settings[options][suppress-url]"
           value="<?php echo $settings['options']['suppress-url']; ?>">
<?php
elseif ('wpai_suppress-referrer' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][suppress-referrer]"
           id="wpai_settings[options][suppress-referrer]"
           value="<?php echo $settings['options']['suppress-referrer']; ?>">
<?php
elseif ('wpai_suppress-ipaddress' == $field['label_for']) : ?>
    <input type="text" name="wpai_settings[options][suppress-ipaddress]"
           id="wpai_settings[options][suppress-ipaddress]"
           value="<?php echo $settings['options']['suppress-ipaddress']; ?>">
<?php endif; ?>