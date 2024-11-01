<?php

/**
 * Define the update plugin functionality.
 *
 * @since      1.0.2
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 * @author     Ticketmaster <support@ticketmaster.com>
 */
class Ticketmaster_Updater {

	/**
	 * Check plugin version.
	 *
	 * @since 1.0.2
	 */
	public function update_check(){
		$version = get_option( 'ticketmaster_version');

		if($version < '1.0.2') {
			$this->db_update();
		}
	}

	/**
	 * Change database table in update.
	 *
	 * @since    1.0.2
	 */
	private function db_update() {
		$table_name = get_option( 'ticketmaster_db_table_name' );

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

		update_option( 'ticketmaster_version', '1.0.2' );

	}
} // class Ticketmaster_Updater
