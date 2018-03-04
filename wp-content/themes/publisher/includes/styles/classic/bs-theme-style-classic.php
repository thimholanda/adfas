<?php

/**
 * BS theme classic style
 */
class Publisher_Theme_Style_Classic extends Publisher_Theme_Style {

	/**
	 * Style initializer.
	 */
	public function __construct() {
		$this->style_id = 'classic';
		parent::__construct();
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {
	}

	/**
	 * Enqueue current style css file
	 */
	function register_assets() {
	}

	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {
	} // customize_category_fields


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 */
	function customize_panel_fields() {
	} // customize_panel_fields


	/**
	 * Modifies panel typo options
	 *
	 * @return mixed
	 */
	function customize_panel_typo() {
	} // customize_panel_typo

} // Publisher_Theme_Style_Classic