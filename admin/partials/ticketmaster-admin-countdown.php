<?php
/**
 * Partial of the countdown widgets
 *
 * @link http://www.ticketmaster.com
 * @since 1.0.0
 *
 * @package Ticketmaster
 * @subpackage Ticketmaster/admin/partials
 */

?>

<div id="ticketmaster-settings" class="wrap">
	<h2><?php esc_attr_e( 'Ticketmaster Settings', $this->plugin_name ); ?></h2>
	<?php
	require_once( 'ticketmaster-admin-nav-tab.php' );
	?>

	<div class="wrap ticketmaster-metaboxes">
		<div id="countdown-config">
			<h2><?php esc_attr_e( 'Countdown Widget', $this->plugin_name ); ?></h2>
			<p><?php esc_attr_e( 'You can use the widget configurator below to customize the layout of the widget.', $this->plugin_name );?></p>
			<div class="row row-native">
			    <div class="col-lg-4 config-block">
				    <form accept-charset="UTF-8" class="main-widget-config-form common_tabs" method="post" autocomplete="off">
	                    <!--Use for mobile devices 'Go' button-->
				        <button type="submit" class="hidden"></button>

					    <div>
							<label for="w-title"><?php esc_attr_e( 'Title', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(Required)', $this->plugin_name ); ?></span></label>
							<input type="text" id="w-title" name="w-title" maxlength="255">
						</div>

					    <ul class="nav nav-tabs" data-tabs="tabs">
						    <li class="active">
						        <a href="#widget-config-setup" data-toggle="tab" aria-expanded="true"><?php esc_attr_e( 'Technical', $this->plugin_name ); ?></a>
						    </li>
						    <li class="">
						        <a id="js_styling_nav_tab" href="#widget-config-styling" data-toggle="tab" aria-expanded="false"><?php esc_attr_e( 'Visual', $this->plugin_name ); ?></a>
						    </li>
					    </ul>

						<div class="tab-content">
						    <div class="tab-pane fade active in" id="widget-config-setup">
							    <div class="row row-native">
								    <div class="col-lg-12 col-md-6 col-sm-6">
								        <div class="widget_api_key">
									        <label for="w-tm-api-key">
									            <?php esc_attr_e( 'API Key', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(Required)', $this->plugin_name ); ?></span>
									        </label>
									        <a href="https://developer-acct.ticketmaster.com/user/login" class="pull-right"><?php esc_attr_e( 'Get your own', $this->plugin_name ); ?></a>
									        <div class="widget_api_key__field">
									            <input type="text" id="w-tm-api-key" name="w-tm-api-key" value="aJVApdB1RoA41ejGebe0o4Ai9gufoCbd">
									            <a target="_blank" href="https://developer.ticketmaster.com/support/faq/" class="widget_api_key__question"></a>
									        </div>
								        </div>
								    </div>
								    <div class="col-lg-12 col-md-6 col-sm-6">
								        <label for="w-id">
									        <?php esc_attr_e( 'Event Id', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(Required)', $this->plugin_name ); ?></span>
								        </label>
								        <!--<a href="javascript:void(0)" id="js_get-eventId_open" type="button" class="pull-right" data-toggle="modal" data-target="#get-eventId-modal"><?php esc_attr_e( 'Get event ID', $this->plugin_name ); ?></a>-->
								        <input type="text" id="w-id" name="w-id" value="Z7r9jZ1Aefkaz" class="double-margin-bottom js_lazy-selector">
								    </div>
							    </div>
							</div>
							<div class="tab-pane fade" id="widget-config-styling">
							    <div class="row row-native">
								    <div id="js-layout-box" class="col-lg-12 col-md-12 col-sm-12 col-sm-layout">
								        <div class="base-margin-bottom">
									        <label><?php esc_attr_e( 'Layout', $this->plugin_name ); ?></label>
									        <div class="col-lg-12 js-fixed-size-buttons radio-buttons">
									            <div class="row">
										            <div class="col-lg-4 col-sm-2 col-xs-6 widget__various-width">
										                <input id="w-fixed-300x600" type="radio" value="xxl" name="w-proportion">
										                <label for="w-fixed-300x600">300x600</label>
										            </div>
										            <div class="col-lg-4 col-sm-2 col-xs-6 widget__various-width">
										                <input id="w-fixed-300x250" type="radio" value="m" name="w-proportion">
										                <label for="w-fixed-300x250">300x250</label>
										            </div>
													<div class="col-lg-6 col-sm-2 col-xs-6 widget__various-width">
														<input id="w-layout-fullwidth" type="radio" value="fullwidth" name="w-proportion">
														<label for="w-layout-fullwidth"><?php esc_attr_e( 'Fullwidth', $this->plugin_name ); ?></label>
													</div>
										            <div class="col-lg-4 col-sm-2 col-xs-6 widget__various-width">
										                <input checked="" id="w-custom" type="radio" value="custom" name="w-proportion">
										                <label for="w-custom"><?php esc_attr_e( 'Custom', $this->plugin_name ); ?></label>
										            </div>
									            </div>
									        </div>
									        <div class="col-lg-12 js-tab-buttons radio-buttons" style="">
									            <div class="row">
										            <div class="col-lg-12 line"></div>
										            <div class="col-lg-4 col-sm-2 col-xs-6 widget__various-width">
										                <input checked="" id="w-layout-vertical" type="radio" value="vertical" name="w-layout">
										                <label for="w-layout-vertical"><?php esc_attr_e( 'Vertical', $this->plugin_name ); ?></label>
										            </div>
										            <div class="col-lg-4 col-sm-2 col-xs-6 widget__various-width">
										                <input id="w-layout-horizontal" type="radio" value="horizontal" name="w-layout">
										                <label for="w-layout-horizontal"><?php esc_attr_e( 'Horizontal', $this->plugin_name ); ?></label>
										            </div>
									            </div>
									        </div>
								        </div>
								    </div>
							    </div>

							    <div class="row row-native">
		                            <div class="col-lg-12 js_widget_width_slider">
		                              <label for="w-width">
											<?php esc_attr_e( 'Width', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
		                              </label>
		                              <div class="row row-native">
										<div class="col-lg-6">
									      <div class="bootstrap_slider bootstrap_slider-horizontal">
		                                    <input id="w-width" name="w-width" type="text" min="350" max="500" value="350" />
		                                  </div>
										</div>
										<div class="col-lg-6">
										  <span class="config_field__description max">max width is 1920 px</span>
									    </div>
		                              </div>
		                            </div>
		                            <div class="col-lg-12 js_widget_border_slider double-margin-bottom">
		                              <label for="w-borderradius">
											<?php esc_attr_e( 'Corner Radius', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
		                              </label>
									  <div class="row row-native">
										<div class="col-lg-6 bootstrap_slider bootstrap_slider-horizontal">
											<input id="w-borderradius" name="w-borderradius" type="text" min="0" max="20" value="4" />
										</div>
										<div class="col-lg-6">
										  <span class="config_field__description max"><?php esc_attr_e( 'max radius is 50 px', $this->plugin_name ); ?></span>
										</div>
									  </div>
		                            </div>
		                        </div>
							</div>

							<div class="row row-native visible-lg">
							    <div class="col-lg-6 col-md-3 col-sm-3">
								    <button w-widget-type="countdown" type="button" class="js_get_widget_code btn btn-block button button-blue widget_config__btn"><?php esc_attr_e( 'ADD WIDGET', $this->plugin_name ); ?></button>
							    </div>
							    <div class="col-lg-6 col-md-3 col-sm-3">
								    <button type="button" class="js_reset_widget btn btn-block button-white-gray-border widget_config__btn"><?php esc_attr_e( 'RESET', $this->plugin_name ); ?></button>
							    </div>
							</div>
						</div>
				    </form>

                    <?php
                    	require_once( 'ticketmaster-admin-modal-lazy-selector.php' );
                    ?>

	            </div>
			    <div class="col-lg-8 col-lg-widget">
			        <div class="widget-container-wrapper" data-min="350" data-max="417" style="width: auto; margin-top: 0px;">
			            <div class="widget-container" style="width: 100%;">
			                <div w-type="countdown" w-tmapikey="pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz" w-id="Z7r9jZ1Aefkaz" w-theme="simple_countdown" w-width="350" w-height="600" w-borderradius="4" w-layout="vertical" w-proportion="custom" w-tm-api-key="aJVApdB1RoA41ejGebe0o4Ai9gufoCbd" style="height: 600px; width: 350px; display: block;"></div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
