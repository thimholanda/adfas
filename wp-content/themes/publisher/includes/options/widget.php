<?php
/**
 * widget.php
 *---------------------------
 * Registers options for widgets
 *
 */


// Define general widget fields and values
add_filter( 'better-framework/widgets/options/general', 'publisher_widgets_general_fields', 100 );
add_filter( 'better-framework/widgets/options/general/bf-widget-title-bg-color/default', 'publisher_general_widget_title_bg_color_field_default', 100 );
add_filter( 'better-framework/widgets/options/general/bf-widget-bg-color/default', 'publisher_general_widget_bg_color_field_default', 100 );

// Define custom css for widgets
add_filter( 'better-framework/css/widgets', 'publisher_widgets_custom_css', 100 );

if ( ! function_exists( 'publisher_widgets_general_fields' ) ) {
	/**
	 * Filter widgets general fields
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function publisher_widgets_general_fields( $fields ) {

		$fields[] = 'bf-widget-title-bg-color';
		$fields[] = 'bf-widget-bg-color';

		$fields[] = 'bf-widget-title-icon';
		$fields[] = 'bf-widget-title-link';

		$fields[] = 'bf-widget-show-desktop';
		$fields[] = 'bf-widget-show-tablet';
		$fields[] = 'bf-widget-show-mobile';

		return $fields;

	} // publisher_widgets_general_fields
}


if ( ! function_exists( 'publisher_general_widget_title_bg_color_field_default' ) ) {
	/**
	 * Default value for widget title heading color
	 *
	 * @param $value
	 *
	 * @return string
	 */
	function publisher_general_widget_title_bg_color_field_default( $value ) {
		return publisher_get_option( 'widget_title_bg_color' );
	}
}


if ( ! function_exists( 'publisher_general_widget_bg_color_field_default' ) ) {
	/**
	 * Default value for widget title heading color
	 *
	 * @param $value
	 *
	 * @return string
	 */
	function publisher_general_widget_bg_color_field_default( $value ) {
		return publisher_get_option( 'widget_bg_color' );
	}
}


if ( ! function_exists( 'publisher_widgets_custom_css' ) ) {
	/**
	 * Widgets Custom css parameters
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function publisher_widgets_custom_css( $fields ) {

		$fields[] = array(
			'field' => 'bf-widget-title-bg-color',
			array(
				'selector' => array(
					'%%widget-id%% .widget-heading > .h-text',
					'%%widget-id%% .widget-heading:after',
				),
				'prop'     => array(
					'background' => '%%value%%'
				),
			),
		);

		$fields[] = array(
			'field' => 'bf-widget-bg-color',
			array(
				'selector' => array(
					'%%widget-id%%',
				),
				'prop'     => array(
					'background' => '%%value%%; padding: 20px;',
				),
			),
		);

		return $fields;
	}
}
