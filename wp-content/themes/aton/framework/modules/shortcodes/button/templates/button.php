<button type="submit" <?php aton_qodef_inline_style($button_styles); ?> <?php aton_qodef_class_attribute($button_classes); ?> <?php echo aton_qodef_get_inline_attrs($button_data); ?> <?php echo aton_qodef_get_inline_attrs($button_custom_attrs); ?>>
    <span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo aton_qodef_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>