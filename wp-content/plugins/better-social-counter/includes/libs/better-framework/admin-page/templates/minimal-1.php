<div class="bf-admin-page-wrap bf-admin-template-minimal-1">

	<header class="bf-page-header">
		<h2 class="page-title"><?php echo esc_html( $title ); ?></h2>

		<?php if ( ! empty( $desc ) ) {
			echo '<div class="page-desc">' . wp_kses( $desc, bf_trans_allowed_html() ) . '</div>';
		} ?>
	</header>

	<div class="bf-page-postbox">
		<div class="inside">

			<?php echo $body; // escaped before  ?>

		</div>
	</div>

</div>