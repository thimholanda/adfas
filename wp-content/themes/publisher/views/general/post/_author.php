<?php
/**
 * _author.php
 *---------------------------
 * Post author box in bottom of post contents template
 *
 */

$author_id = get_the_author_meta( 'ID' );

if ( get_the_author_meta( 'description' ) == '' ) {
	return;
}

$author_archive_link = get_author_posts_url( $author_id );

?>
<section <?php publisher_attr( 'author', 'clearfix' ); ?>>

	<h4 class="section-heading multi-tab">
		<p class="main-link active"><span class="h-text"><?php publisher_translation_echo( 'author' ); ?></span></p>
		<a href="<?php echo esc_url( $author_archive_link ); ?>" class="other-link"
		   title="<?php publisher_translation()->_echo_esc_attr( 'browse_auth_articles' ); ?>">
			<span class="h-text"><?php publisher_translation_echo( 'author_all_posts' ); ?></span>
		</a>
	</h4>
	<?php

	/**
	 * Filter the author bio avatar size.
	 *
	 * @since Publisher 1.0
	 *
	 * @param int $size The avatar height and width size in pixels.
	 */
	$avatar_size = apply_filters( 'publisher/post/author/avatar-size', 80 );

	?>
	<a href="<?php echo esc_url( $author_archive_link ); ?>" itemscope="itemscope" itemprop="url"
	   title="<?php echo publisher_translation_esc_attr( 'browse_auth_articles' ); ?>">
		<span <?php publisher_attr( 'author-avatar' ); ?>><?php echo get_avatar( $author_id, $avatar_size ); /* escaped before */ ?></span>
	</a>

	<div class="author-links">
		<?php publisher_the_author_social_icons( $author_id ); ?>
	</div>

	<h5 class="author-title">
		<a <?php publisher_attr( 'post-meta-author-url' ) ?>><span <?php publisher_attr( 'author-name' ); ?>><?php echo get_the_author_meta( 'display_name' ); // escaped before in WP ?></span></a>
	</h5>

	<div <?php publisher_attr( 'author-bio' ); ?>>
		<?php echo wpautop( get_the_author_meta( 'description' ) ); // escaped before ?>
	</div>

</section>
