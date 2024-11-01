<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.ticketmaster.com
 * @since      1.0.0
 *
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ticketmaster
 * @subpackage Ticketmaster/includes
 * @author     Ticketmaster <support@ticketmaster.com>
 */
class Ticketmaster_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ticketmaster',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



} // class Ticketmaster_i18n

