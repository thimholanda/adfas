<div class="bf-section-container bf-clearfix">
	<div class="bf-section-heading bf-clearfix" data-id="<?php echo esc_attr( $options['id'] ); ?>"
	     id="<?php echo esc_attr( $options['id'] ); ?>">
		<div class="bf-section-heading-title bf-clearfix">
			<h3><?php echo esc_html( $options['name'] ); ?></h3>
		</div>
		<?php if ( ! empty( $options['desc'] ) ) { ?>
			<div
				class="bf-section-heading-desc bf-clearfix"><?php echo wp_kses( $options['desc'], bf_trans_allowed_html() ); ?></div>
		<?php } ?>
	</div>
</div>