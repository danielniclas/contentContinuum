<?php do_action('aton_qodef_before_page_header'); ?>
<aside class="qodef-vertical-menu-area">
    <div class="qodef-vertical-menu-area-inner">
        <div class="qodef-vertical-area-background" <?php aton_qodef_inline_style(array($vertical_header_background_color,$vertical_header_opacity,$vertical_background_image)); ?>></div>
        <?php if(!$hide_logo) {
            aton_qodef_get_logo();
        } ?>
        <div class="qodef-vertical-navigation-holder">
            <?php aton_qodef_get_vertical_main_menu(); ?>
        </div>
        <div class="qodef-vertical-area-widget-holder">
            <div class="qodef-vertical-area-widget-holder-inner">
                <?php if(is_active_sidebar('qodef-vertical-area')) : ?>
                    <?php dynamic_sidebar('qodef-vertical-area'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</aside>

<?php do_action('aton_qodef_after_page_header'); ?>