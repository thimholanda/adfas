<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $order ) : ?>


	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<div class="order-thanks-wrap clearfix">

			<p class="woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'publisher' ); ?></p>

			<p class="woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
				   class="button pay"><?php esc_html_e( 'Pay', 'publisher' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
					   class="button pay"><?php esc_html_e( 'My Account', 'publisher' ); ?></a>
				<?php endif; ?>
			</p>
		</div>
	<?php else : ?>

		<div class="order-thanks-wrap clearfix">

			<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'publisher' ), $order ); ?></p>

			<ul class="woocommerce-thankyou-order-details order_details">
				<li class="order">
					<?php esc_html_e( 'Order Number:', 'publisher' ); ?>
					<strong><?php echo esc_html( $order->get_order_number() ); // escaped before ?></strong>
				</li>
				<li class="date">
					<?php esc_html_e( 'Date:', 'publisher' ); ?>
					<strong><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ) ); ?></strong>
				</li>
				<li class="total">
					<?php esc_html_e( 'Total:', 'publisher' ); ?>
					<strong><?php echo esc_html( $order->get_formatted_order_total() ); ?></strong>
				</li>
				<?php if ( $order->payment_method_title ) : ?>
					<li class="method">
						<?php esc_html_e( 'Payment Method:', 'publisher' ); ?>
						<strong><?php echo esc_html( $order->payment_method_title ); // escaped before ?></strong>
					</li>
				<?php endif; ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p class="woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'publisher' ), NULL ); ?></p>

<?php endif; ?>

