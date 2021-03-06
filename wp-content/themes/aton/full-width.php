<?php 
/*
Template Name: Full Width
*/ 
?>
<?php
$aton_qodef_sidebar = aton_qodef_sidebar_layout(); ?>

<?php get_header(); ?>
<?php aton_qodef_get_title(); ?>
<?php get_template_part('slider'); ?>

<div class="qodef-full-width">
<div class="qodef-full-width-inner">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php if(($aton_qodef_sidebar == 'default')||($aton_qodef_sidebar == '')) : ?>
			<?php the_content(); ?>
			<?php do_action('aton_qodef_page_after_content'); ?>
		<?php elseif($aton_qodef_sidebar == 'sidebar-33-right' || $aton_qodef_sidebar == 'sidebar-25-right'): ?>
			<div <?php echo aton_qodef_sidebar_columns_class(); ?>>
				<div class="qodef-column1 qodef-content-left-from-sidebar">
					<div class="qodef-column-inner">
						<?php the_content(); ?>
						<?php do_action('aton_qodef_page_after_content'); ?>
					</div>
				</div>
				<div class="qodef-column2">
					<?php get_sidebar(); ?>
				</div>
			</div>
		<?php elseif($aton_qodef_sidebar == 'sidebar-33-left' || $aton_qodef_sidebar == 'sidebar-25-left'): ?>
			<div <?php echo aton_qodef_sidebar_columns_class(); ?>>
				<div class="qodef-column1">
					<?php get_sidebar(); ?>
				</div>
				<div class="qodef-column2 qodef-content-right-from-sidebar">
					<div class="qodef-column-inner">
						<?php the_content(); ?>
						<?php do_action('aton_qodef_page_after_content'); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>