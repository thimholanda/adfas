<?php

/**
 * BetterFramework Bas Functionality For Themes
 */
abstract class BF_WooCommerce {

	public function __construct() {

		add_theme_support( 'woocommerce' );

		add_filter( 'init', array( $this, 'init' ) );
	}


	/**
	 * Register WooCommrece related hooks
	 */
	public function init() {

		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );

		add_filter( 'add_to_cart_fragments', array( $this, 'add_to_cart_fragments' ) );

	}

	/**
	 * Action callback: Add WooCommerce assets
	 */
	abstract public function register_assets();


	/**
	 * Filter Callback: Used for adding total items in cart
	 *
	 * @param $fragments
	 *
	 * @return mixed
	 */
	public function add_to_cart_fragments( $fragments ) {

		global $woocommerce;

		$fragments['total-items-in-cart'] = $woocommerce->cart->cart_contents_count;

		return $fragments;

	}

}