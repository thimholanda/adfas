<ul class="listing listing-widget listing-widget-thumbnail listing-widget-simple-thumbnail-meta">
	<?php while( publisher_have_posts() ): publisher_the_post(); ?>
		<li class="listing-item clearfix">
			<article <?php publisher_attr( 'post' ); ?>>
				<?php if ( publisher_has_post_thumbnail() ) { ?>
					<?php $img = publisher_get_thumbnail(); ?>
					<a class="img-holder" itemprop="url" rel="bookmark" href="<?php the_permalink(); ?>"
					   style="background-image: url(<?php echo esc_url( $img['src'] ); ?>);"></a>
				<?php } ?>
				<h4 class="title">
					<a <?php publisher_attr( 'post-url' ); ?>><span <?php publisher_attr( 'post-title' ); ?>><?php the_title(); ?></span></a>
				</h4>
				<?php publisher_get_view( 'loop', '_meta' ); ?>
				<?php publisher_meta_tag( 'full' ); ?>
			</article>
		</li>
	<?php endwhile; ?>
</ul>
