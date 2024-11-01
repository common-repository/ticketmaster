<?php
/**
 * Partial of the direct payments config
 *
 * @link http://www.ticketmaster.com
 * @since 1.0.0
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/admin/partials
 */

$state = get_option( 'ticketmaster_universe_modal_widget', 0 );
?>


<div id="ticketmaster-settings" class="wrap">
	<h2><?php esc_attr_e( 'Ticketmaster Settings', $this->plugin_name ); ?></h2>
	<?php
	require_once( 'ticketmaster-admin-nav-tab.php' );
	?>

	<div class="wrap ticketmaster-metaboxes">
		<div id="direct-payments-config">
			<h2><?php esc_attr_e( 'Direct Payments', $this->plugin_name ); ?></h2>
			<input id="w-universe-modal-widget" type="checkbox" value="show_modal_form" name="w-universe" <?php checked( $state, 1 ); ?>>
			<label for="w-universe-modal-widget"><?php esc_attr_e( 'Show Universe modal widget when click by link with event.', $this->plugin_name ); ?></label>
		</div>
	</div>
</div>
