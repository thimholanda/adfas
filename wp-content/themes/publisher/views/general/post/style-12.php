<?php
/**
 * style-12.php
 *---------------------------
 * Post template style 12.
 */


$layout = publisher_get_page_layout();

$post_format = get_post_format();

$has_post_thumbnail = has_post_thumbnail();

switch ( $layout ) {
	case '2-col-right':
		$container_class = 'container layout-2-col layout-right-sidebar post-template-12';
		$main_col_class  = 'col-sm-8 content-column';
		$aside_col_class = 'col-sm-4 sidebar-column';
		break;

	case '2-col-left':
		$container_class = 'container layout-2-col layout-left-sidebar post-template-12';
		$main_col_class  = 'col-sm-8 col-sm-push-4 content-column';
		$aside_col_class = 'col-sm-4 col-sm-pull-8 sidebar-column';
		break;

	case '1-col':
		$container_class = 'container layout-1-col layout-no-sidebar post-template-12';
		$main_col_class  = 'col-sm-12 content-column';
		$aside_col_class = '';
		break;
}

$thumbnail_size = 'publisher-full';

the_post();

?>
</div> <!-- .content-wrap -->
<div class="post-header post-tp-12-header">
	<div class="content-wrap">
		<div class="container">
			<div class="post-header-inner">
				<div class="post-header-title">
					<?php publisher_cats_badge_code( get_post_format() ? 2 : 3, '', TRUE, TRUE, 'floated' ); ?>
					<h1 class="single-post-title">
						<span <?php publisher_attr( 'post-title' ); ?>><?php the_title(); ?></span></h1>
					<?php publisher_get_view( 'post', '_meta' ); ?>
				</div>

				<div class="single-featured">
					<?php

					// Gallery Post Format
					if ( $post_format == 'gallery' ) {
						publisher_get_view( 'post', '_gallery' );
					} // Video/Audio Post Format
					elseif ( $post_format == 'video' || $post_format == 'audio' ) {
						echo do_shortcode( apply_filters( 'better-framework/content/auto-embed', bf_get_post_meta( '_featured_embed_code' ) ) );
					} // Simple Thumbnail
					elseif ( $has_post_thumbnail ) {
						?>
						<a <?php publisher_attr( 'post-thumbnail-url', '', 'full' ); ?>>
							<img
								src="<?php echo esc_url( publisher_get_post_thumbnail_src( $thumbnail_size ) );  // escaped before  ?>"
								alt="<?php the_title_attribute(); ?>">
						</a>
						<?php
					}

					?>
				</div>
				<?php

				// Social share buttons
				if ( publisher_get_option( 'social_share_single' ) == 'show' ) {
					publisher_listing_social_share( '', 'single-post-share', TRUE );
				}

				?>
				<?php

				if ( bf_get_post_meta( 'bs_featured_image_credit' ) != '' ) {
					?>
					<span class="image-credit"><?php bf_echo_post_meta( 'bs_featured_image_credit' ); ?></span>
					<?php
				}

				?>
			</div>
		</div>
	</div>
</div><!-- .slider-container -->

<div class="content-wrap">

	<div class="<?php echo $container_class; // escaped before ?>">
		<div class="row main-section">

			<div class="<?php echo $main_col_class; // escaped before ?>">
				<div class="single-container">
					<article <?php publisher_attr( 'post', 'single-post-content' ); ?>>
						<div <?php publisher_attr( 'post-content', 'clearfix single-post-content' ); ?>>
							<?php publisher_the_content(); ?>
						</div>
						<?php

						// Shows source
						if ( bf_get_post_meta( '_bs_source_name' ) != '' && bf_get_post_meta( '_bs_source_url' ) != '' ) {
							publisher_get_view( 'post', '_source', 'default' );
						}

						// Shows via
						if ( bf_get_post_meta( '_bs_via_name' ) != '' && bf_get_post_meta( '_bs_via_url' ) != '' ) {
							publisher_get_view( 'post', '_via', 'default' );
						}

						// Shows post tags
						if ( publisher_has_tag() ) {
							publisher_get_view( 'post', '_tags', 'default' );
						}

						?>
					</article>
					<?php

					// Author box
					if ( publisher_get_option( 'post_author_box' ) == 'show' ) {
						publisher_get_view( 'post', '_author' );
					}

					?>
				</div>
				<?php

				// Related posts
				if ( publisher_get_related_post_type() == 'show' ) {
					publisher_get_view( 'post', '_related' );
				}

				// Comments and comment form
				publisher_comments_template();

				?>
			</div><!-- .content-column -->

			<?php if ( $layout != '1-col' ) { ?>
				<div class=" <?php echo $aside_col_class; // escaped before ?>">
					<?php get_sidebar(); ?>
				</div><!-- .sidebar-column -->
			<?php } ?>

		</div><!-- .main-section -->
	</div><!-- .layout-2-col -->
