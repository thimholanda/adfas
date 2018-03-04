<?php

/**
 * Publisher
 *      -> Clean Style
 *          -> Magazine Demo
 */
class Publisher_Theme_Style_Clean_Magazine extends Publisher_Theme_Style_Clean {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'magazine';
		parent::__construct();
	}


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 *
	 * Table of sections:
	 *
	 * => Template Options
	 *      -> Posts
	 *      -> Categories Archive
	 *
	 * => Header Options
	 *      -> Topbar
	 *
	 * => Footer Options
	 *
	 * =>Color & Style
	 *      -> Topbar Colors
	 *      -> Header Colors
	 *      -> Footer Colors
	 *      -> Widgets
	 *
	 * =>Typography
	 *      -> Modern Grid Typography
	 *
	 * => Advanced Options
	 *
	 */
	function customize_panel_fields() {

		parent::customize_category_fields();

		$std_id = $this->get_std_id();

		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color']['css-echo-default'] = TRUE;
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $std_id ]          = '#0080ce';

	} // customize_panel_fields

} // Publisher_Theme_Style_Clean_Magazine