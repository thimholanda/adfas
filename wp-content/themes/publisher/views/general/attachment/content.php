<?php
/**
 * attachment.php
 *---------------------------
 * The main content of Attachment post type.
 *
 */

the_post();

// attachment valid parent or false!
$parent = publisher_get_attachment_parent( get_the_ID() );

// main image size
$thumbnail_size      = 'publisher-lg';
$list_thumbnail_size = 'thumbnail';
if ( publisher_get_page_layout() == '1-col' ) {
	$thumbnail_size      = 'publisher-full';
	$list_thumbnail_size = 'publisher-mg2';
}

?>
<article <?php publisher_attr( 'post', 'single-attachment-content' ); ?>>
	<?php

	if ( $parent ) {
		?>
		<div class="return-to">
			<a href="<?php echo get_permalink( $parent ); ?>" class="heading-typo"><i
					class="fa fa-angle-<?php echo is_rtl() ? 'right' : 'left'; ?>"></i> <?php

				echo esc_html( sprintf( publisher_translation_get( 'attachment_return_to' ), publisher_html_limit_words( get_the_title( $parent ), 100 ) ) )

				?></a>
		</div>
		<?php
	}

	?>
	<div class="single-featured">
		<?php

		if ( wp_attachment_is( 'image' ) ) {

			?>
			<a <?php publisher_attr( 'post-thumbnail-url', '', 'full' ); ?>>
				<img src="<?php echo esc_url( publisher_get_post_thumbnail_src( $thumbnail_size ) ); ?>"
				     alt="<?php the_title_attribute(); ?>">
			</a>
			<?php

		} elseif ( wp_attachment_is( 'video' ) || wp_attachment_is( 'audio' ) ) {
			echo do_shortcode( apply_filters( 'better-framework/content/auto-embed', get_attached_file( get_the_ID() ) ) );
		}

		?>
	</div>

	<header class="attachment-header">
		<?php the_title( '<h1 class="attachment-title">', '</h1>' ); ?>
	</header>

	<?php if ( ! empty( get_the_content() ) ) { ?>
	<div <?php publisher_attr( 'post-lead' ); ?>>
		<?php the_content(); ?>
		</div><?php
	}

	// todo add more info for attachment like size, and download links for other size ...

	if ( is_rtl() ) {
		$older_text = '<i class="fa fa-angle-double-right"></i> ' . publisher_translation_get( 'attachment_next' );
		$next_text  = publisher_translation_get( 'attachment_prev' ) . ' <i class="fa fa-angle-double-left"></i>';
	} else {
		$next_text  = '<i class="fa fa-angle-double-left"></i> ' . publisher_translation_get( 'attachment_prev' );
		$older_text = publisher_translation_get( 'attachment_next' ) . ' <i class="fa fa-angle-double-right"></i>';
	}

	?>
	<div <?php publisher_attr( 'pagination', 'bs-links-pagination clearfix' ); ?>>
		<div class="newer"><?php next_image_link( FALSE, $older_text ); ?></div>
		<div class="older"><?php previous_image_link( FALSE, $next_text ); ?></div>
	</div>
	<?php

	// Show all images inside parent post here
	if ( $parent ) {

		$images = get_attached_media( 'image', $parent );

		?>
		<div class="parent-images clearfix">
		<ul class="listing listing-attachment-siblings columns-5">
			<?php foreach ( (array) $images as $img ) {

				// remove current image from list
				if ( $img->ID == get_the_ID() ) {
					continue;
				}

				?>
				<li class="listing-item item-<?php echo esc_attr( $img->ID ); ?>">
					<?php $src = publisher_get_media_src( $img->ID, $list_thumbnail_size ); ?>
					<a class="img-holder" itemprop="url" rel="bookmark" href="<?php echo get_permalink( $img->ID ); ?>"
					   style="background-image: url(<?php echo esc_url( $src ); ?>);"><i class="fa fa-eye"></i></a>
				</li>
			<?php } ?>
		</ul>
		</div><?php
	}

	?>
</article>
