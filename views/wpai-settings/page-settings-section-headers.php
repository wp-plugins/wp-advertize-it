<?php if ('wpai_section-blocks' == $section['id']) : ?>

    <script type="application/javascript">
        jQuery(document).ready(function () {
            jQuery('.placement-block-select').each(function () {
                resortSelect(jQuery(this));
            });
            jQuery('.delete-checkbox').each(function () {
                jQuery(this).closest('tr').children('th').first().prepend(jQuery(this));
            });
        });

        function addBlock() {
            if (!jQuery('#before-blocks + table.form-table').length) {
                jQuery('#before-blocks').after('<table class="form-table"><tbody></tbody></table>');
            }
            var lastIndex = 0;
            jQuery('#before-blocks + table.form-table tbody tr th label').each(function () {
                var currentIndex = parseInt(jQuery(this).attr("for").substring(11));
                if (currentIndex > lastIndex) {
                    lastIndex = currentIndex;
                }
            });
            jQuery('#before-blocks + table.form-table tbody').append('<tr><th scope="row"><label for="wpai_block-' + (lastIndex + 1) + '">Ad Block ' + (lastIndex + 1) + '</label></th><td><textarea style="width: 95%;" wrap="soft" rows="5" value="" class="regular-text" id="wpai_block-' + (lastIndex + 1) + '" name="wpai_settings[blocks][' + lastIndex + ']"></textarea><input type="checkbox" id="checkbox_wpai_settings[blocks][' + lastIndex + ']" data-ad-block="wpai_block-' + (lastIndex + 1) + '" class="delete-checkbox"></td></tr>');
            jQuery('.delete-checkbox').each(function () {
                jQuery(this).closest('tr').children('th').first().prepend(jQuery(this));
            });
            jQuery('.placement-block-select').each(function () {
                jQuery(this).append('<option data-block-id="wpai_block-' + (lastIndex + 1) + '" value="' + lastIndex + '" style="padding-right: 10px;">Ad Block ' + (lastIndex + 1) + '</option>')
                resortSelect(jQuery(this));
            });
            editAreaLoader.init({
                id: "wpai_block-" + (lastIndex + 1), syntax: "html", start_highlight: true, toolbar: "", EA_load_callback: "fEALoaded", allow_toggle: false, word_wrap: true
            });

        }

        function resortSelect(select) {
            var value = select.val();
            var selectList = select.children();
            selectList.sort(function (a, b) {
                if (a.value > b.value) return 1;
                else if (a.value < b.value) return -1;
                else return 0
            })

            select.html(selectList);
            select.val(value);
        }

        function removeBlocks() {
            if (confirm("Are you sure you want to remove these ad blocks ?")) {
                jQuery('.delete-checkbox:checked').each(function () {
                    var block_id = jQuery(this).attr('data-ad-block');
                    jQuery(this).closest('tr').remove();
                    jQuery('select.placement-block-select option[data-block-id="' + block_id + '"]').each(function () {
                        if (jQuery(this).is(':selected')) {
                            jQuery(this).parent().val("");
                        }
                        jQuery(this).remove();
                    });
                });
            }
        }
    </script>
    <p>Define here different ad blocks by pasting adsense code. These blocks can then be placed at different locations
        on your site.</p>
    <button id="add-block" class="button-secondary" onclick="javascript:addBlock();return false;">Add Block</button>
    <button id="remove-block" class="button-secondary" onclick="javascript:removeBlocks();return false;">Remove Selected
        Blocks
    </button>
    <div style="display:none;" id="before-blocks"></div>
<?php elseif ('wpai_section-placements' == $section['id']) : ?>

    <p>Select for each location which ad block you would like to see displayed.</p>

<?php
elseif ('wpai_section-options' == $section['id']) : ?>

    <p>Set options influencing how the ads are dispalyed.</p>
    <input type="hidden" name="wpai_settings[options][suppress-on-posts]" value="0">

<?php endif; ?>
