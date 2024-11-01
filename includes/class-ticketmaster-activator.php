<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.ticketmaster.com
 * @since      1.0.0
 *
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 * @author     Ticketmaster <support@ticketmaster.com>
 */
class Ticketmaster_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		Ticketmaster_Activator::create_db_table();
		add_option( 'ticketmaster_universe_modal_widget', 0 );
	}

	/**
	 * Create database table for storing ticketmaster widgets markup.
	 *
	 * @since    1.0.0
	 */
	private static function create_db_table() {
		global $wpdb;

		$version = get_option( 'ticketmaster_version', '1.0.2' );

		$table_name = $wpdb->prefix . 'ticketmaster_widgets';
		$charset_collate = $wpdb->get_charset_collate();

		/* @todo problem with charset */
		if( $wpdb->get_var( "show tables like '$table_name'" ) != $table_name ) {
			$sql = "CREATE TABLE " . $table_name . " (
			  id mediumint(9) NOT NULL AUTO_INCREMENT,
			  type tinyint(3) NOT NULL,
			  title varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			  params varchar(10000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
			  UNIQUE KEY id (id),
			  UNIQUE KEY title (title)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			$result = dbDelta( $sql );

			add_option( 'ticketmaster_db_table_name', $table_name );
			add_option( 'ticketmaster_version', $version );
		}
	}
} // class Ticketmaster_Activator

