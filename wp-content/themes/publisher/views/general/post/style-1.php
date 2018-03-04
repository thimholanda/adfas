<?php
/**
 * style-1.php
 *---------------------------
 * Default post template.
 */

$layout = publisher_get_page_layout();

$container_class = '';

switch ( $layout ) {
	case '2-col-right':
		$container_class = 'container layout-2-col layout-right-sidebar post-template-1';
		$main_col_class  = 'col-sm-8 content-column';
		$aside_col_class = 'col-sm-4 sidebar-column';
		break;

	case '2-col-left':
		$container_class = 'container layout-2-col layout-left-sidebar post-template-1';
		$main_col_class  = 'col-sm-8 col-sm-push-4 content-column';
		$aside_col_class = 'col-sm-4 col-sm-pull-8 sidebar-column';
		break;

	case '1-col':
		$container_class = 'container layout-1-col layout-no-sidebar post-template-1';
		$main_col_class  = 'col-sm-12 content-column';
		$aside_col_class = '';
		break;
}

?>
<div class="<?php echo $container_class; // escaped before ?>">
	<div class="row main-section">

		<div class="<?php echo $main_col_class; // escaped before ?>">
			<?php publisher_get_view( 'post', 'content' ); ?>
		</div><!-- .content-column -->

		<?php if ( $layout != '1-col' ) { ?>
			<div class=" <?php echo $aside_col_class; // escaped before ?>">
				<?php get_sidebar(); ?>
			</div><!-- .sidebar-column -->
		<?php } ?>

	</div><!-- .main-section -->
</div><!-- .container -->
