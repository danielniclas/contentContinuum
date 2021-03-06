<div <?php aton_qodef_class_attribute($pricing_table_classes)?>>
	<div class="qodef-price-table-inner">
		<?php if($active == 'yes'){ ?>
            <div class="qodef-active-text">
				<span><span><span><span><span><span><span>
                </span></span></span></span></span></span></span>
                <div class="qodef-active-text-inner"><?php echo esc_html($active_text) ?></div>
            </div>
		<?php } ?>
		<ul>
            <li class="qodef-table-title">
                <span class="qodef-title-content"><?php echo esc_html($title) ?></span>
            </li>
            <li class="qodef-table-prices">
				<div class="qodef-price-in-table">
					<sup class="qodef-value"><?php echo esc_attr($currency) ?></sup>
					<span class="qodef-price"><?php echo esc_attr($price)?></span>
					<span class="qodef-mark">&#47;<?php echo esc_attr($price_period)?></span>
				</div>	
			</li>
			<li class="qodef-table-content">
				<?php
					echo do_shortcode($content);
				?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<li class="qodef-price-button">
					<?php echo aton_qodef_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'hover_type' => $hover_type,
                        'size' => 'small'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>