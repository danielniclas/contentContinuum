<?php if(aton_qodef_options()->getOptionValue('enable_social_share') == 'yes'
    && aton_qodef_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="qodef-portfolio-social">
        <?php echo aton_qodef_get_social_share_html(array('icon_type' => 'circle')) ?>
    </div>
<?php endif; ?>

