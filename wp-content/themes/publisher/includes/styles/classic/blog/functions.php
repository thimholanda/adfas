<?php

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
					'%%widget-id%% .widget-heading',
				),
				'prop'     => array(
					'background' => '%%value%%'
				),
			),
			array(
				'selector' => array(
					'%%widget-id%% .widget-heading:after',
				),
				'prop'     => array(
					'border-top-color' => '%%value%% !important'
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
	} // publisher_widgets_custom_css
}