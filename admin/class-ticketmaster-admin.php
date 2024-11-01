<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link http://www.ticketmaster.com
 * @since 1.0.0
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks.
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/admin
 * @author Ticketmaster <ticketmaster.com>
 */
class Ticketmaster_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Plugin admin pages screen ids.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array $plugin_admin_screen_ids Array of plugin admin pages screen ids.
	 */
	private $plugin_admin_screen_ids = array(
		'toplevel_page_ticketmaster',
		'ticketmaster_page_ticketmaster-event-discovery-widget',
		'ticketmaster_page_ticketmaster-countdown-widget',
		'ticketmaster_page_ticketmaster-calendar-widget',
		'ticketmaster_page_ticketmaster-map-widget',
		'ticketmaster_page_ticketmaster-direct-payments',
	);

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_styles() {
		$current_screen_id = get_current_screen() -> id;

		if ( in_array( $current_screen_id, $this->plugin_admin_screen_ids, true ) ) {
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ticketmaster-admin.css', array(), $this->version, 'all' );
		}

		switch ( $current_screen_id ) {
			case 'ticketmaster_page_ticketmaster-event-discovery-widget':
				wp_enqueue_style( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-minicolors', plugin_dir_url( __FILE__ ) . 'css/jquery.minicolors.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-oldschool', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/theme/oldschool.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-newschool', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/theme/newschool.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-listview', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/theme/listview.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-listviewthumbnails', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/theme/listviewthumbnails.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-grid', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/theme/grid.css', array(), $this->version, 'all' );
				break;
			case 'ticketmaster_page_ticketmaster-countdown-widget':
				wp_enqueue_style( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css', array(), $this->version, 'all' );
				break;
			case 'ticketmaster_page_ticketmaster-calendar-widget':
				wp_enqueue_style( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css', array(), $this->version, 'all' );
				wp_enqueue_style( $this->plugin_name . '-minicolors', plugin_dir_url( __FILE__ ) . 'css/jquery.minicolors.css', array(), $this->version, 'all' );
				break;
			case 'ticketmaster_page_ticketmaster-map-widget':
				wp_enqueue_style( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/css/bootstrap-slider.min.css', array(), $this->version, 'all' );
				break;
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_scripts() {
		$current_screen_id = get_current_screen() -> id;

		if ( in_array( $current_screen_id, $this->plugin_admin_screen_ids, true ) ) {
			wp_enqueue_script( 'jquery-ui-dialog' );
			wp_enqueue_script( $this->plugin_name . '-lazy-selector', plugin_dir_url( __FILE__ ) . 'js/lazy-selector.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-clipboard', plugin_dir_url( __FILE__ ) . 'js/clipboard.js', array(), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-clipboard-fallback', plugin_dir_url( __FILE__ ) . 'js/clipboard-fallback.js', array(), $this->version, true );
			wp_enqueue_script( $this->plugin_name . '-clipboard-init', plugin_dir_url( __FILE__ ) . 'js/clipboard-init.js', array(), $this->version, true );

			wp_register_script( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/ticketmaster-admin.js', array( 'jquery' ), $this->version, false );
			$translation_array = array(
				'empty_widgets_list_text_content' => __( 'No saved widgets.', $this->plugin_name ),
				'empty_title_error_message' => __( 'Please enter widget title!', $this->plugin_name ),
				'empty_api_key_error_message' => __( 'Please enter API Key!', $this->plugin_name ),
				'error_title' => __( 'Error', $this->plugin_name ),
				'info_title' => __( 'Info', $this->plugin_name ),
				'empty_message_text_content' => __( 'No Message to Display.', $this->plugin_name ),
				'delete_widget_text_content' => __( 'Delete', $this->plugin_name ),
				'delete_widget_impossible_text_content' => __( 'Widget can not be deleted because it is used.', $this->plugin_name ),
			);
			wp_localize_script( $this->plugin_name . '-admin', 'translations', $translation_array );
			wp_enqueue_script( $this->plugin_name . '-admin' );
		}

		switch ( $current_screen_id ) {
			case 'toplevel_page_ticketmaster':
				wp_enqueue_script( $this->plugin_name . '-countdown-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/countdown/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-event-discovery-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-calendar-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/calendar/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-map-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/map/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&libraries=visualization', array(), $this->version, true );
				break;
			case 'ticketmaster_page_ticketmaster-event-discovery-widget':
				wp_enqueue_script( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-minicolors', plugin_dir_url( __FILE__ ) . 'js/jquery.minicolors.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-datetimepicker', plugin_dir_url( __FILE__ ) . 'js/datetimepicker.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-difference', plugin_dir_url( __FILE__ ) . 'js/difference.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-without', plugin_dir_url( __FILE__ ) . 'js/without.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-event-discovery-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/event-discovery/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-core-event-discovery-widget-config', plugin_dir_url( __FILE__ ) . 'js/event-discovery/core-event-discovery-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-event-discovery-widget-config', plugin_dir_url( __FILE__ ) . 'js/event-discovery/event-discovery-widget-config.js', array(), $this->version, true );
                wp_enqueue_script( $this->plugin_name . '-jstree', plugin_dir_url( __FILE__ ) . 'js/event-discovery/jstree.min.js', array( 'jquery' ), $this->version, true );
                wp_enqueue_script( $this->plugin_name . '-classification-selector', plugin_dir_url( __FILE__ ) . 'js/event-discovery/classification-selector.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-latlong-selector', plugin_dir_url( __FILE__ ) . 'js/map/latlong-selector.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&libraries=visualization,places&callback=initMapLatLong', array($this->plugin_name . '-latlong-selector'), $this->version, true );
				break;
			case 'ticketmaster_page_ticketmaster-countdown-widget':
				wp_enqueue_script( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-countdown-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/countdown/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-core-countdown-widget-config', plugin_dir_url( __FILE__ ) . 'js/countdown/core-countdown-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-countdown-widget-config', plugin_dir_url( __FILE__ ) . 'js/countdown/countdown-widget-config.js', array(), $this->version, true );
				break;
			case 'ticketmaster_page_ticketmaster-calendar-widget':
				wp_enqueue_script( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-minicolors', plugin_dir_url( __FILE__ ) . 'js/jquery.minicolors.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-calendar-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/calendar/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-core-calendar-widget-config', plugin_dir_url( __FILE__ ) . 'js/calendar/core-calendar-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-calendar-widget-config', plugin_dir_url( __FILE__ ) . 'js/calendar/calendar-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-latlong-selector', plugin_dir_url( __FILE__ ) . 'js/map/latlong-selector.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&libraries=visualization,places&callback=initMapLatLong', array($this->plugin_name . '-latlong-selector'), $this->version, true );
				break;
			case 'ticketmaster_page_ticketmaster-map-widget':
				wp_enqueue_script( $this->plugin_name . '-slider', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/6.1.5/bootstrap-slider.min.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-map-main-widget', 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/map/1.0.0/lib/main-widget.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-core-map-widget-config', plugin_dir_url( __FILE__ ) . 'js/map/core-map-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-map-widget-config', plugin_dir_url( __FILE__ ) . 'js/map/map-widget-config.js', array(), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-jstree', plugin_dir_url( __FILE__ ) . 'js/event-discovery/jstree.min.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-classification-selector', plugin_dir_url( __FILE__ ) . 'js/event-discovery/classification-selector.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-latlong-selector', plugin_dir_url( __FILE__ ) . 'js/map/latlong-selector.js', array( 'jquery' ), $this->version, true );
				wp_enqueue_script( $this->plugin_name . '-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&libraries=visualization,places&callback=initMapLatLong', array($this->plugin_name . '-latlong-selector'), $this->version, true );
				break;
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since 1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page( __( 'Ticketmaster Settings', $this->plugin_name ), 'Ticketmaster', 'manage_options', $this->plugin_name, array( $this, 'display_plugin_widgets_list_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Saved Widgets', 'manage_options', $this->plugin_name, array( $this, 'display_plugin_widgets_list_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Event Discovery Widget', 'manage_options', $this->plugin_name . '-event-discovery-widget', array( $this, 'display_plugin_event_discovery_widget_config_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Countdown Widget', 'manage_options', $this->plugin_name . '-countdown-widget', array( $this, 'display_plugin_countdown_widget_config_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Calendar Widget', 'manage_options', $this->plugin_name . '-calendar-widget', array( $this, 'display_plugin_calendar_widget_config_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Map Widget', 'manage_options', $this->plugin_name . '-map-widget', array( $this, 'display_plugin_map_widget_config_page' ) );
		add_submenu_page( $this->plugin_name, __( 'Ticketmaster Settings', $this->plugin_name ), 'Universe Widget', 'manage_options', $this->plugin_name . '-direct-payments', array( $this, 'display_plugin_direct_payments_config_page' ) );
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_widgets_list_page() {
		include_once( 'partials/ticketmaster-admin-widgets.php' );
	}

	/**
	 * Render the Event Discovery Widget config page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_event_discovery_widget_config_page() {
		include_once( 'partials/ticketmaster-admin-event-discovery.php' );
	}

	/**
	 * Render the Countdown Widget config widget page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_countdown_widget_config_page() {
		include_once( 'partials/ticketmaster-admin-countdown.php' );
	}

	/**
	 * Render the Calendar Widget config widget page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_calendar_widget_config_page() {
		include_once( 'partials/ticketmaster-admin-calendar.php' );
	}

	/**
	 * Render the Map Widget config widget page for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function display_plugin_map_widget_config_page() {
		include_once( 'partials/ticketmaster-admin-map.php' );
	}

	/**
	 * Render the Direct Payments config page for this plugin.
	 */
	public function display_plugin_direct_payments_config_page() {
		include_once( 'partials/ticketmaster-admin-direct-payments.php' );
	}

	/**
	 * Get saved widgets.
	 *
	 * @return array
	 */
	public function get_widgets() {
		global $wpdb;

		$table_name = get_option( 'ticketmaster_db_table_name' );
		$all_widgets = $wpdb->get_results( "SELECT id, type, title, params FROM {$table_name}" ); // DB call ok; no-cache ok.

		$used_widgets_ids = $this->get_used_widgets_ids();
		foreach ( $all_widgets as &$widget ) {
			$widget->type = __( Ticketmaster_Widget::$widget_types[ $widget->type ]['description'], $this->plugin_name );
			$widget->params = unserialize( $widget->params );
			( in_array( $widget->id, $used_widgets_ids, true ) ) ? $widget -> used = true : $widget->used = false;
		}
		return $all_widgets;
	}

	/**
	 * Add AJAX callback that delete saved widget.
	 *
	 * @since 1.0.0
	 */
	public function delete_widget_callback() {
		global $wpdb;
		$table = get_option( 'ticketmaster_db_table_name' );
		$widget_id = intval( $_POST['id'] );
		$used_widgets_ids = $this->get_used_widgets_ids();
		if ( ! in_array( $widget_id, $used_widgets_ids ) ) {
			$result = $wpdb->delete( $table, array( 'id' => $widget_id ), array( '%d' ) ); // DB call ok; no-cache ok.
			if ( $result ) {
				echo wp_json_encode( array( 'status' => __( 'Widget deleted', $this->plugin_name ) ) );
			} else {
				echo wp_json_encode( array(
					'error'  => true,
				    'status' => __( 'Widget not found.', $this->plugin_name ),
				) );
			}
		} else {
			echo wp_json_encode( array(
				'error'  => true,
			    'status' => __( 'The widget is used and can not be deleted.', $this->plugin_name ),
			) );
		}
		wp_die();
	}

	/** Add AJAX callback that save new widget
	 *
	 * @since 1.0.0
	 */
	public function create_widget_callback() {
		global $wpdb;
		$table = get_option( 'ticketmaster_db_table_name' );
		$widget_type = sanitize_text_field( $_POST['type'] );
		$widget_title = sanitize_text_field( $_POST['title'] );
		$widget_params = serialize( json_decode( stripslashes( $_POST['params'] ), true ) );
		$widget_type = Ticketmaster_Widget::getWidgetTypeIDByCode( $widget_type );
		if ( $widget_type ) {
			$result = $wpdb->insert( $table, array( 'type' => $widget_type, 'title' => $widget_title, 'params' => $widget_params ), array( '%d', '%s', '%s' ) ); // DB call ok; no-cache ok.
			if ( $result ) {
				echo wp_json_encode( array( 'status' => __( 'Widget created.', $this->plugin_name ) ) );
			} else {
				echo wp_json_encode( array( 'error' => true, 'status' => __( 'Widget not created.', $this->plugin_name ) ) );
			}
		} else {
			echo wp_json_encode( array( 'error' => true, 'status' => __( 'Widget not created. Invalid widget type.', $this->plugin_name ) ) );
		}
		wp_die();
	}

	/** Add AJAX callback that change universe widget modal state.
	 *
	 * @since 1.0.0
	 */
	public function change_universe_modal_widget_state_callback() {
		$state = intval( $_POST['state'] );

		update_option( 'ticketmaster_universe_modal_widget', $state );
		wp_die();
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since 1.0.0
	 * @param array $links array of links.
	 * @return array
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>',
			),
			$links
		);
	}

	/**
	 * Get used widgets ids.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	protected function get_used_widgets_ids() {
		$used_widgets_ids = array();
		$used_widgets = get_option( 'widget_ticketmaster_widget' );
		foreach ( $used_widgets as $widget ) {
			if ( isset( $widget['widget_id'] ) ) {
				$used_widgets_ids[] = $widget['widget_id'];
			}
		}
		return $used_widgets_ids;
	}
} // class Ticketmaster_Admin

