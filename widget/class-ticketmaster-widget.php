<?php
/**
 * The widget-specific functionality of the plugin.
 *
 * @link http://www.ticketmaster.com
 * @since 1.0.0
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/widget
 */

/**
 * The widget-specific functionality of the plugin.
 *
 * Defines the plugin name, version and hooks.
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/widget
 * @author Ticketmaster <support@ticketmaster.com>
 */
class Ticketmaster_Widget extends WP_Widget{
	const EVENT_DISCOVERY = 1;
	const COUNTDOWN = 2;
	const CALENDAR = 3;
	const MAP = 4;

	/**
	 * The widget types code and description.
	 *
	 * @var array widget types
	 */
	public static $widget_types = array(
		self::EVENT_DISCOVERY => array(
			'code' => 'event-discovery',
			'description' => 'Event Discovery Widget',
		),
		self::COUNTDOWN => array(
			'code' => 'countdown',
			'description' => 'Countdown Widget',
		),
		self::CALENDAR => array(
			'code' => 'calendar',
			'description' => 'Calendar Widget',
		),
		self::MAP => array(
			'code' => 'map',
			'description' => 'Map Widget',
		),
	);

	/**
	 * The function gets widget type id by code.
	 *
	 * @param string $code Code of widget.
	 *
	 * @return mixed
	 */
	public static function getWidgetTypeIDByCode( $code ) {
		foreach ( Ticketmaster_Widget::$widget_types as $wt_key => $wt_values ) {
			if ( $wt_values['code'] === $code ) {
				return $wt_key;
			}
		}
		return false;
	}

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
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->plugin_name = 'ticketmaster';
		$this->version = get_option( 'ticketmaster_version' );

		parent::__construct(
			'Ticketmaster_Widget',
			__( 'Ticketmaster Widget', 'text_domain' ),
			array( 'description' => __( 'A Ticketmaster Widget', 'text_domain' ) )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $wpdb;
		$table_name = get_option( 'ticketmaster_db_table_name' );

		if ( $instance['widget_id'] && $widget = $wpdb->get_row( "SELECT id, type, params FROM $table_name WHERE id = {$instance['widget_id']}" ) ) {
			echo $args['before_widget'];
			$widget_params = unserialize( $widget->params );?>
			<div
			<?php foreach ( $widget_params as $param_key => $param_value ) : ?>
				<?php echo esc_attr( $param_key ); ?>="<?php echo esc_attr( $param_value ); ?>"
			<?php endforeach; ?>
			></div>

			<?php
			$script_path = 'https://ticketmaster-api-staging.github.io/products-and-docs/widgets/' . Ticketmaster_Widget::$widget_types[ $widget->type ]['code'] . '/1.0.0/lib/main-widget.js';
			wp_enqueue_script( $this->plugin_name . '-' . Ticketmaster_Widget::$widget_types[ $widget->type ]['code'], $script_path, array(), $this->version, true );
			if (Ticketmaster_Widget::$widget_types[ $widget->type ]['code'] == 'map') {
			  wp_enqueue_script( $this->plugin_name . '-google-maps', 'https://maps.googleapis.com/maps/api/js?key='.$widget_params["w-googleapikey"].'&libraries=visualization', array(), $this->version, true );
			}
			echo $args['after_widget'];
		}
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		global $wpdb;
		$table_name = get_option('ticketmaster_db_table_name');
		$widgets = $wpdb->get_results( "SELECT id, title FROM {$table_name}" );
		$widget_id = ! empty( $instance['widget_id'] ) ? $instance['widget_id'] : 0;
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_id' ) ); ?>"><?php _e( esc_attr( 'Widget:' ) ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'widget_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'widget_id' ) ); ?>">
				<option value=""></option>
				<?php foreach ( $widgets as $widget ) : ?>
					<option value="<?php echo esc_attr( $widget->id ); ?>" <?php selected( $widget_id, $widget->id ); ?>><?php echo esc_attr( $widget->title ); ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['widget_id'] = ( ! empty( $new_instance['widget_id'] ) ) ? strip_tags( $new_instance['widget_id'] ) : '';

		return $instance;
	}

	public function register_widget() {
		register_widget( 'Ticketmaster_Widget' );
	}

} // class Ticketmaster_Widget
