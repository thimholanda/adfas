<?php
/**
 * post.php
 *---------------------------
 * The template for displaying posts
 *
 */

the_post();

$post_format = get_post_format();

$has_post_thumbnail = has_post_thumbnail();

$thumbnail_size = 'publisher-lg';
if ( publisher_get_page_layout() == '1-col' ) {
	$thumbnail_size = 'publisher-full';
}

?>
<div class="ajax-post-content">

	<div class="single-container">
		<article <?php publisher_attr( 'post', 'post single-post-content ' . ( $has_post_thumbnail ? 'has-thumbnail' : '' ) ); ?>>
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
							src="<?php echo esc_url( publisher_get_post_thumbnail_src( $thumbnail_size ) ); // escaped before  ?>"
							alt="<?php the_title_attribute(); ?>">
					</a>
					<?php
				}

				if ( bf_get_post_meta( 'bs_featured_image_credit' ) != '' ) {
					?>
					<span class="image-credit"><?php bf_echo_post_meta( 'bs_featured_image_credit' ); ?></span>
					<?php
				}

				?>
			</div>

			<div class="post-header-inner">
				<div class="post-header-title">
					<?php publisher_cats_badge_code( $post_format ? 2 : 3, '', TRUE, TRUE, 'floated' ); ?>
					<h1 class="single-post-title">
						<span <?php publisher_attr( 'post-title' ); ?>><?php the_title(); ?></span></h1>
					<?php publisher_get_view( 'post', '_meta' ); ?>
				</div>
			</div>
			<?php

			// Social share buttons
			if ( publisher_get_option( 'social_share_single' ) == 'show' ) {
				publisher_listing_social_share( '', 'single-post-share', TRUE );
			}

			?>
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

	// Comments and comment form
	publisher_comments_template();

	?>
</div>
