<?php

/**
 * Publisher
 *      -> Clean Style
 */
class Publisher_Theme_Style_Clean extends Publisher_Theme_Style {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->style_id = 'clean';
		parent::__construct();
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {
		// no custom functions
	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {
		// no custom style
	}


	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {
		// no custom category customization
	}


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 */
	function customize_panel_fields() {
		// No customization
	}


	/**
	 * Modifies panel typo options
	 *
	 * @return mixed
	 */
	function customize_panel_typo() {
		// No customization
	}

} // Publisher_Theme_Style_Clean