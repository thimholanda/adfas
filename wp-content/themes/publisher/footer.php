<?php
/**
 * footer.php
 *---------------------------
 * The template for displaying the footer.
 *
 */
?>


</main><!-- main -->
</div><!-- .content-wrap -->

<?php

// Show Social Icons
$show_socials = publisher_get_option( 'footer_social' ) == 'show';

// Show Widgets
$show_widgets = publisher_get_option( 'footer_widgets' ) != 'hide';

// Prepare copyright Text
$copy_text_1 = str_replace(
	array(
		'%%year%%',
		'%%date%%',
		'%%title%%',
		'%%sitename%%',
		'%%siteurl%%',
	),
	array(
		date( 'Y' ),
		date( 'Y' ),
		get_bloginfo( 'name' ),
		get_bloginfo( 'name' ),
		get_home_url()
	),
	publisher_get_option( 'footer_copy1' )
);

$copy_text_2 = str_replace(
	array(
		'%%year%%',
		'%%date%%',
		'%%title%%',
		'%%sitename%%',
		'%%siteurl%%',
	),
	array(
		date( 'Y' ),
		date( 'Y' ),
		get_bloginfo( 'name' ),
		get_bloginfo( 'name' ),
		get_home_url()
	),
	publisher_get_option( 'footer_copy2' )
);

// Footer Instagram
if ( publisher_get_option( 'footer_social_feed' ) != 'hide' && publisher_get_option( 'footer_instagram' ) != '' ) {
	// Location: "views/footer/_social-feed.php"
	publisher_get_view( 'footer', 'instagram-' . publisher_get_option( 'footer_social_feed' ) );
}

?>
<footer id="site-footer" class="site-footer">
	<?php

	// Footer Socials
	if ( $show_socials ) {
		// Location: "views/footer/_social-icons.php"
		publisher_get_view( 'footer', '_social-icons' );
	}

	// Footer Widgets
	// Location: "views/footer/widgets.php"
	publisher_get_view( 'footer', 'widgets' );

	?>
	<div class="copy-footer">
		<div class="content-wrap">
			<div class="container">
				<?php publisher_get_view( 'menu', 'footer' ); ?>
				<div class="row">
					<div class="copy-1 col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?php echo wp_kses( $copy_text_1, bf_trans_allowed_html() ); ?>
					</div>
					<div class="copy-2 col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<?php echo wp_kses( $copy_text_2, bf_trans_allowed_html() ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer><!-- .footer -->

</div><!-- .main-wrap -->

<?php if ( publisher_get_option( 'back_to_top' ) == 'show' ) { ?>
	<span class="back-top"><i class="fa fa-arrow-up"></i></span>
<?php } ?>

<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>