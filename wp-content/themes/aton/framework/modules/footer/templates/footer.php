<?php
/**
 * Footer template part
 */

aton_qodef_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<?php if (!isset($_REQUEST["ajax_req"]) || $_REQUEST["ajax_req"] != 'yes') { ?>
<footer <?php aton_qodef_class_attribute($footer_classes); ?>>
	<div class="qodef-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			aton_qodef_get_footer_top();
		}
		if($display_footer_bottom) {
			aton_qodef_get_footer_bottom();
		}
		?>

	</div>
</footer>
<?php } ?>

</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
<?php wp_footer(); ?>
</body>
</html>