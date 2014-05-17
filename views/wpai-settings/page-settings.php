<div class="wrap">
    <div id="icon-options-general" class="icon32"><br/></div>
    <h2><?php esc_html_e(WPAI_NAME); ?> Settings</h2>

    <form method="post" action="options.php">
        <?php settings_fields('wpai_settings'); ?>
        <?php do_settings_sections('wpai_settings'); ?>

        <p class="submit">
            <input type="submit" name="submit" id="submit" class="button-primary"
                   value="<?php esc_attr_e('Save Changes'); ?>"/>
        </p>

        <h3>Hints</h3>

        <p class="underline">Inserting ad blocks in your theme</p>

        <p>
            You can manually insert ad blocks in your theme by using the following function:<br>
            <code>&lt;?php show_ad_block(X); ?&gt;</code>
        </p>

        <p class="underline">Inserting ad blocks in the editor</p>

        <p>
            You can manually insert ad blocks in the WordPress editor by using the button <img
                src="<?php echo plugins_url('images/dollar.png', dirname(dirname(__FILE__))); ?>">. This will insert a
            short code in the form: <br>
            <code>[showad block=X]</code><br>
            Alternatively, you can also insert this short code yourself.
        </p>

        <p class="underline">Disabling ads</p>

        <p>In order to disable some ads for a type of page, you can use one of the options above. But to disable ads in
            a particular post or page, you can use one of the following:
        <ul class="disc-list">
            <li>&lt;!--NoAds--&gt; : suppresses all ads when displaying this post (except in a list of posts)</li>
            <li>&lt;!--NoBelowTitleAds--&gt; : suppresses the ad below the post or page title</li>
            <li>&lt;!--NoAfterFirstParagraphAds--&gt; : suppresses the ad after the first paragraph</li>
            <li>&lt;!--NoMiddleOfContentAds--&gt; : suppresses the ad in the middle of the post or page</li>
            <li>&lt;!--NoBeforeLastParagraphAds--&gt; : suppresses the ad before the last paragraph</li>
            <li>&lt;!--NoBelowContentAds--&gt; : suppresses the ad below the post or page content</li>
            <li>&lt;!--NoBelowCommentsAds--&gt; : suppresses the ad below the comments</li>
            <li>&lt;!--NoWidgetAds--&gt; : suppresses the ad widget</li>
            <li>&lt;!--NoBelowFooterAds--&gt; : suppresses the footer</li>
        </ul>
        Just add it to your post in the text editor. These will be present on the page but not visible and will
        partially or totally disable ads when this post or page is viewed.
        </p>

        <p class="underline">Aligning ad blocks</p>

        <p>
            In order to center an ad block, please wrap it in a div like this:<br>
            <code>&lt;div style=&quot;display: table; margin: 0px auto;&quot;&gt; YOUR AD CODE HERE &lt;/div&gt;</code>
        </p>

        <p>
            In order to align an ad block to the left, please wrap it in a div like this:<br>
            <code>&lt;div style=&quot;float: left;&quot;&gt; YOUR AD CODE HERE &lt;/div&gt;</code>
        </p>

        <p>
            In order to align an ad block to the right, please wrap it in a div like this:<br>
            <code>&lt;div style=&quot;float: right;&quot;&gt; YOUR AD CODE HERE &lt;/div&gt;</code>
        </p>
    </form>
</div> <!-- .wrap -->
