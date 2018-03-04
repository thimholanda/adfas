<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
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
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="order-customer-detail">
	<header><h2 class="section-heading"><span
				class="h-text"><?php esc_html_e( 'Customer Details', 'publisher' ); ?></span></h2></header>

	<table class="shop_table customer_details">
		<?php if ( $order->customer_note ) : ?>
			<tr>
				<th><?php esc_html_e( 'Note:', 'publisher' ); ?></th>
				<td><?php echo wptexturize( $order->customer_note ); // escaped before ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->billing_email ) : ?>
			<tr>
				<th><?php esc_html_e( 'Email:', 'publisher' ); ?></th>
				<td><?php echo esc_html( $order->billing_email ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->billing_phone ) : ?>
			<tr>
				<th><?php esc_html_e( 'Telephone:', 'publisher' ); ?></th>
				<td><?php echo esc_html( $order->billing_phone ); ?></td>
			</tr>
		<?php endif; ?>

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
	</table>
</div>


<div class="order-customer-adress-wrap">
	<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>
	<div class="col2-set addresses">
		<div class="col-1">

			<?php endif; ?>

			<header class="title">
				<h3 class="section-heading"><span
						class="h-text"><?php esc_html_e( 'Billing Address', 'publisher' ); ?></span></h3>
			</header>
			<address>
				<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : esc_html( __( 'N/A', 'publisher' ) ); // escaped before ?>
			</address>

			<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) : ?>

		</div><!-- /.col-1 -->
		<div class="col-2">
			<header class="title">
				<h3><?php esc_html_e( 'Shipping Address', 'publisher' ); ?></h3>
			</header>
			<address>
				<?php echo ( $address = $order->get_formatted_shipping_address() ) ? $address : esc_html( __( 'N/A', 'publisher' ) ); // escaped before ?>
			</address>
		</div><!-- /.col-2 -->
	</div><!-- /.col2-set -->
<?php endif; ?>
</div>

