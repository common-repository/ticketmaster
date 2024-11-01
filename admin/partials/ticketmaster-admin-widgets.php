<?php

/**
 * Partial of the widgets
 *
 * @link       http://www.ticketmaster.com
 * @since      1.0.0
 *
 * @package    Ticketmaster
 * @subpackage Ticketmaster/admin/partials
 */

?>

<div id="ticketmaster-settings" class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php
	require_once( 'ticketmaster-admin-nav-tab.php' );
	?>
	<div class="wrap ticketmaster-metaboxes">
		<h2><?php esc_attr_e( 'The List of Widgets', $this->plugin_name ); ?></h2>
		<div id="widgets-list" class="w-grid">
            <?php
			$widgets = $this->get_widgets();
			foreach ( $widgets as $widget ) : ?>
                <div class="w-item">
	                <div class="conf">
	                    <div class="info">
	                        <span class="widget-title"><?php echo esc_attr( $widget->title ); ?></span>
						    <span class="widget-type"><?php echo esc_attr( $widget->type, $this->plugin_name ); ?></span>
						<?php if ( ! $widget->used ) : ?>
							</div>
							<span data-widgetid="<?php echo esc_attr( $widget->id ); ?>" class="delete-widget"><?php esc_attr_e( 'Delete', $this->plugin_name ); ?></span>
						<?php else : ?>
							<span class="delete-widget-impossible"><?php esc_attr_e( 'Widget can not be deleted because it is used.', $this->plugin_name ); ?></span>
						    </div>
						<?php endif; ?>   
	                </div>
	                <div class="wholder">
		                <div
							<?php foreach ( $widget->params as $param_key => $param_value ) : ?>
								<?php echo esc_attr( $param_key ); ?>="<?php echo esc_attr( $param_value ); ?>"
							<?php endforeach; ?>
							></div>
					</div>
	            </div>
            <?php endforeach; ?>
		    <?php if ( empty( $widgets ) ) : ?>
                <p><?php esc_attr_e( 'No saved widgets.', $this->plugin_name ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>