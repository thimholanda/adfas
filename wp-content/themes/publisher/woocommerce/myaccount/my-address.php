<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing'  => __( 'Billing Address', 'publisher' ),
		'shipping' => __( 'Shipping Address', 'publisher' )
	), $customer_id );
} else {
	$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'publisher' )
	), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>

<div class="wc-account-content-wrap">
	<p>
		<?php echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'publisher' ) ); ?>
	</p>
</div>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	echo '<div class="u-columns woocommerce-Addresses col2-set addresses">';
} ?>

<?php foreach ( $get_addresses as $name => $title ) : ?>

	<div
		class="u-column<?php echo ( ( $col = $col * - 1 ) < 0 ) ? 1 : 2; ?> col-<?php echo ( ( $oldcol = $oldcol * - 1 ) < 0 ) ? 1 : 2; ?> woocommerce-Address">

		<div class="wc-account-content-wrap">

			<header class="section-heading woocommerce-Address-title title">
				<span class="h-text"><?php echo esc_attr( $title ); ?></span>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>"
				   class="edit"><?php esc_html_e( 'Edit', 'publisher' ); ?></a>
			</header>

			<address>
				<?php
				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name' => get_user_meta( $customer_id, $name . '_first_name', TRUE ),
					'last_name'  => get_user_meta( $customer_id, $name . '_last_name', TRUE ),
					'company'    => get_user_meta( $customer_id, $name . '_company', TRUE ),
					'address_1'  => get_user_meta( $customer_id, $name . '_address_1', TRUE ),
					'address_2'  => get_user_meta( $customer_id, $name . '_address_2', TRUE ),
					'city'       => get_user_meta( $customer_id, $name . '_city', TRUE ),
					'state'      => get_user_meta( $customer_id, $name . '_state', TRUE ),
					'postcode'   => get_user_meta( $customer_id, $name . '_postcode', TRUE ),
					'country'    => get_user_meta( $customer_id, $name . '_country', TRUE )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address ) {
					esc_html_e( 'You have not set up this type of address yet.', 'publisher' );
				} else {
					echo $formatted_address; // escaped before in WooCommerce
				}
				?>
			</address>
		</div>

	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	echo '</div>';
} ?>
