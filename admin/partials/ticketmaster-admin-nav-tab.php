<?php
/**
 * Provide a nav tab for the plugin admin page.
 *
 * @since 1.0.0 *
 * @package Ticketmaster *
 * @subpackage Ticketmaster/admin/partials
 */

?>

<?php
$current_page = get_current_screen() -> id;
?>
<div class="nav-tab-wrapper">
	<ul class="nav-tab-list">
		<li class="nav-tab-item <?php echo ( 'toplevel_page_ticketmaster' === $current_page ) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster"><?php esc_attr_e( 'Saved Widgets', $this->plugin_name );?></a></li>
		<li class="nav-tab-item <?php echo ( 'ticketmaster_page_ticketmaster-event-discovery-widget' === $current_page ) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster-event-discovery-widget"><?php esc_attr_e( 'Event Discovery Widget', $this->plugin_name );?></a></li>
		<li class="nav-tab-item <?php echo ( 'ticketmaster_page_ticketmaster-countdown-widget' === $current_page) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster-countdown-widget"><?php esc_attr_e( 'Countdown Widget', $this->plugin_name );?></a></li>
		<li class="nav-tab-item <?php echo ( 'ticketmaster_page_ticketmaster-calendar-widget' === $current_page) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster-calendar-widget"><?php esc_attr_e( 'Calendar Widget', $this->plugin_name );?></a></li>
		<li class="nav-tab-item <?php echo ( 'ticketmaster_page_ticketmaster-map-widget' === $current_page) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster-map-widget"><?php esc_attr_e( 'Map Widget', $this->plugin_name );?></a></li>
		<li class="nav-tab-item <?php echo ( 'ticketmaster_page_ticketmaster-direct-payments' === $current_page ) ? 'active': ''; ?>"><a href="admin.php?page=ticketmaster-direct-payments"><?php esc_attr_e( 'Universe Widget', $this->plugin_name );?></a></li>
	</ul>
</div>
