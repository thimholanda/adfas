<?php

/**
 * override parent method to discard printed outputs
 *
 * Class BF_Plugin_Upgrader_Skin
 */
class BF_Plugin_Upgrader_Skin {

	public function header() {
	}

	public function footer() {
	}

	public function feedback( $string ) {
	}

	public function before() {
	}

	public function after() {
	}

	public function decrement_update_count( $type ) {
	}

	public function set_upgrader( &$upgrader ) {
	}

	public function add_strings() {
	}

	public function set_result( $result ) {
	}

	public function request_filesystem_credentials( $error = FALSE, $context = FALSE, $allow_relaxed_file_ownership = FALSE ) {
	}

	public function error( $errors ) {
	}

	public function bulk_header() {
	}

	public function bulk_footer() {
	}
}