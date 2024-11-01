<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://www.ticketmaster.com
 * @since      1.0.0
 *
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 * @author     Ticketmaster <support@ticketmaster.com>
 */
class Ticketmaster_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$table = get_option( 'ticketmaster_db_table_name' );
		$wpdb->query("DROP TABLE IF EXISTS {$table}");

		delete_option( 'ticketmaster_db_table_name' );
		delete_option( 'ticketmaster_version' );
		delete_option( 'ticketmaster_universe_modal_widget' );
		delete_option( 'widget_ticketmaster_widget' );
	}
} // class Ticketmaster_Deactivator

