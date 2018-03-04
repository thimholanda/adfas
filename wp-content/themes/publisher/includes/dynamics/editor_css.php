<?php
/***
 *
 * Special CSS for TinyMCE
 *
 *
 * -> Fonts
 *
 * -> page_layout & default issue
 *
 */

$post_id       = $_GET['publisher-theme-editor-shortcodes'];
$max_width     = Publisher_Theme_Editor_Shortcodes::get_config( 'size-max-width', 1130 );
$content_width = Publisher_Theme_Editor_Shortcodes::get_config( 'size-content-width', 743.333 );


//
// Initialize custom css generator
//
Better_Framework()->factory( 'custom-css' );
$css_generator = new BF_Custom_CSS();

$fonts['heading'] = publisher_get_option( 'typo_heading' );
$fonts['content'] = publisher_get_option( 'typo_entry_content' );

foreach ( $fonts as $_font ) {
	$css_generator->set_fonts( $_font['family'], $_font['variant'], $_font['subset'] );
}

$render = $css_generator->render_fonts();

foreach ( (array) $render as $url ) {
	echo '

@import url("' . $url . '");

';
}

if ( $fonts['content']['variant'] == 'regular' ) {
	$fonts['content']['variant'] = 400;
}

?>

.mceContentBody.mceContentBody{
	font-family: '<?php echo esc_attr( $fonts['content']['family'] ); ?>', sans-serif;
	font-weight: <?php echo esc_attr( $fonts['content']['variant'] ); ?>;
	font-size: <?php echo esc_attr( $fonts['content']['size'] ); ?>px;
	text-transform: <?php echo esc_attr( $fonts['content']['transform'] ); ?>;
	letter-spacing: <?php echo esc_attr( $fonts['content']['letter-spacing']); ?>;
	-webkit-text-size-adjust: 100%;
	text-rendering: optimizeLegibility;
	font-size-adjust: auto;
}


<?php

/***
 *
 * Custom CSS for page layout & default issue
 *
 */
if ( bf_get_post_meta( 'page_layout', $post_id ) == 'default' ) {

	if ( get_post_type( $post_id ) == 'page' ) {
		$layout = publisher_get_option( 'page_layout' );
	} else {
		$layout = publisher_get_option( 'post_layout' );
	}

	if ( $layout == 'default' ) {
		$layout = publisher_get_option( 'general_layout' );
	}

	switch ( $layout ) {

		case '1-col':
			?>
.mceContentBody.mceContentBody[data-page_layout="default"] {
	max-width: <?php echo esc_attr( $max_width ); ?>px; /* todo make this dynamic */
}
.mceContentBody.mceContentBody[data-page_layout="default"]::after {
	display: none;
}
.mceContentBody.mceContentBody[data-page_layout="default"]{
	border:none;
	padding-left: 15px;
	padding-right: 15px;
}
@media (max-width: <?php echo esc_attr( $content_width + 40 ); ?>px) {
	.mceContentBody.mceContentBody[data-page_layout="default"]{
		border:none !important;
		margin-left: 0 !important;
		margin-right: 0 !important ;
		padding-left: 15px !important ;
		padding-right: 15px !important ;
	}
}
			<?php
			break;

		case '2-col-left':
			?>
.mceContentBody.mceContentBody[data-page_layout="default"] {
	margin-left: 150px !important;
	border-left: 1px solid #eee;
	border-right: none;
}
.rtl.mceContentBody.mceContentBody[data-page_layout="default"] {
	margin-left: auto !important;
	border-left: none !important;
	margin-right: 150px !important;
	border-right: 1px solid #eee;
}
.mceContentBody.mceContentBody[data-page_layout="default"]::after {
	left: -25px;
	right: auto;
}
.rtl.mceContentBody.mceContentBody[data-page_layout="default"]::after {
	right: -25px;
	left: auto;
}
@media (max-width: <?php echo esc_attr( $content_width + 150 + 80 ); ?>px) {
	.mceContentBody.mceContentBody[data-page_layout="default"] {
		margin-left: 38px !important;
	}
	.rtl.mceContentBody.mceContentBody[data-page_layout="default"] {
		margin-right: 38px !important;
		margin-left: auto !important;
	}
}
@media (max-width: <?php echo esc_attr( $content_width + 40 ); ?>px) {
	.mceContentBody.mceContentBody[data-page_layout="default"]{
		border:none !important;
		margin-left: 0 !important;
		margin-right: 0 !important ;
		padding-left: 15px !important ;
		padding-right: 15px !important ;
	}
}
			<?php
			break;
	}

}

?>
.wpview-wrap.wpview-wrap[data-wpview-type="gallery"] .wp-caption-text{
    text-align: center !important;
    padding: 0 10px !important;
}
