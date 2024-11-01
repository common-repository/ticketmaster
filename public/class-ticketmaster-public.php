<?php

/**
 * The public-specific functionality of the plugin.
 *
 * @link http://www.ticketmaster.com
 * @since 1.0.0
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/public
 */

/**
 * The public-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/public
 * @author Ticketmaster <ticketmaster.com>
 */
class Ticketmaster_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the JavaScript for the public.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		$universe_widget_modal = get_option( 'ticketmaster_universe_modal_widget', 0 );

		if ( $universe_widget_modal ) {
			wp_enqueue_script( $this->plugin_name . '-universe', 'https://www.universe.com/embed.js', array(), $this->version, false );
		} else {
			wp_enqueue_script( $this->plugin_name . '-nomodal', plugin_dir_url( __FILE__ ) . 'js/ticketmaster-nomodal.js', array(), $this->version, true );
		}
	}
}
