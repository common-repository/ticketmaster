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
		<div id="calendar-config">
			<h2><?php esc_attr_e( 'Calendar Widget', $this->plugin_name ); ?></h2>
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
								<a href="#widget-config-setup" data-toggle="tab"><?php esc_attr_e( 'Technical', $this->plugin_name ); ?></a>
							</li>
							<li>
								<a id="js_styling_nav_tab" href="#widget-config-styling" data-toggle="tab"><?php esc_attr_e( 'Visual', $this->plugin_name ); ?></a>
							</li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane fade in active" id="widget-config-setup">
								<div class="row row-native">
									<div class="col-lg-12 col-md-6 col-sm-6">
										<div class="widget_api_key">
											<label for="w-tm-api-key">
												<?php esc_attr_e( 'API Key', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(Required)', $this->plugin_name ); ?></span>
											</label>
											<a href="https://developer-acct.ticketmaster.com/user/login" class="pull-right"><?php esc_attr_e( 'Get your own', $this->plugin_name ); ?></a>
											<div class="widget_api_key__field">
												<input type="text" id="w-tm-api-key" name="w-tm-api-key" value="pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz">
												<a target="_blank" href="https://developer.ticketmaster.com/support/faq/" class="widget_api_key__question"></a>
											</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-6">
										<label for="w-googleapikey">
											<?php esc_attr_e( 'Google API Key', $this->plugin_name ); ?> <span class="config_field__description"></span>
										</label>
										<input type="text" id="w-googleapikey" name="w-googleapikey" value="">
									</div>
									<div class="col-lg-12 col-md-6 col-sm-6">
										<label for="w-keyword"><?php esc_attr_e( 'Keyword', $this->plugin_name ); ?></label>
										<input type="text" id="w-keyword" name="w-keyword" value="">
									</div>
								</div>

								<div class="row row-native">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="loclatlong">
                                            <div class="widget__location">
                                                <p><?php esc_attr_e( 'You can input location data or', $this->plugin_name ); ?> <span><?php esc_attr_e( 'use Geoposition', $this->plugin_name ); ?></span></p>
                                                <div class="row row-native">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="w-countryCode"><?php esc_attr_e( 'Country Code', $this->plugin_name ); ?></label>
                                                        <div class="js_custom_select custom_select">
                                                            <select id="w-countryCode" class="custom_select__field" name="w-countryCode" tabindex="-1">
                                                                <option value=""><?php esc_attr_e( 'Select Country', $this->plugin_name ); ?></option>
                                                            </select>
                                                            <input type="hidden" id="h-countryCode" name="h-countryCode" value="US">
                                                        <div class="custom_select__arrow"></div></div>
                                                    </div>
                                                </div>
                                                <div class="row row-native">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label for="w-postalcode"><?php esc_attr_e( 'Postal Code', $this->plugin_name ); ?></label>
                                                            <input type="text" id="w-postalcode" name="w-postalcode" value="">
                                                        <input type="hidden" id="h-postalcode" name="h-postalcode" value="">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label for="w-city"><?php esc_attr_e( 'City', $this->plugin_name ); ?></label>
                                                        <input type="text" id="w-city" name="w-city" value="Los Angeles">
                                                        <input type="hidden" id="h-city" name="h-city" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget__latlong hidn">
                                                <p><?php esc_attr_e( 'You can use Geoposition or', $this->plugin_name ); ?> <span><?php esc_attr_e( 'input Location data', $this->plugin_name ); ?></span></p>
                                                <div class="row row-native">
                                                    <div class="col-lg-6 col-md-12 col-sm-12 latlong-holder">
                                                    <label for="w-latlong"><?php esc_attr_e( 'Geoposition', $this->plugin_name ); ?> <span class="config_field__description">(<?php esc_attr_e( 'Latitude, Longitude', $this->plugin_name ); ?>)</span></label>
                                                    <input type="text" id="w-latlong" name="w-latlong" value="">
                                                        <a href="#" id="js_widget_modal_map__open" class="latlong-picker" data-selector="map-open"></a>
                                                    <input type="hidden" id="h-latlong" name="h-latlong" value="34.0390107, -118.2672801">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <label for="w-radius">
                                                            <?php esc_attr_e( 'Radius', $this->plugin_name );?> <span class="config_field__description">(<?php esc_attr_e( 'miles', $this->plugin_name );?>)</span>
                                                        </label>
                                                        <div class="js_numeric-input-group"><input class="js_widget__number js_numeric_input text-center" type="number" id="w-radius" name="w-radius" value="25" min="1" max="19999" inputmode="numeric"><span class="arrow arrow__inc"></span><span class="arrow arrow__dec"></span></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

							</div>

							<div class="tab-pane fade" id="widget-config-styling">
								<div class="row row-native">
									<div class="col-lg-12 col-md-12 col-sm-12 col-sm-color_scheme">
										<div class="widget__color_scheme_control">
											<label><?php esc_attr_e( 'Color Scheme', $this->plugin_name ); ?></label>
											<div class="tab-buttons">
												<input checked id="w-colorscheme-light" type="radio" value="light" name="w-colorscheme">
												<label for="w-colorscheme-light"><?php esc_attr_e( 'Light', $this->plugin_name ); ?></label>
												<input id="w-colorscheme-dark" type="radio" value="dark" name="w-colorscheme">
												<label for="w-colorscheme-dark"><?php esc_attr_e( 'Dark', $this->plugin_name ); ?></label>
												<input id="w-colorscheme-custom" type="radio" value="custom" name="w-colorscheme">
												<label for="w-colorscheme-custom">Custom</label>
											</div>
										</div>

										<div class="widget__color_scheme_custom" style="display: none">
											<div class="row row-native">
												<div class="col-lg-6">
													<label for="w-background">
														Background color: <span class="config_field__description"></span>
													</label>
													<input id="w-background" name="w-background" class="color-picker" type="text" size="7" min="7" max="7" value="#f1f4f6">
												</div>
												<div class="col-lg-6">
													<label for="w-textcolor">
														Text color: <span class="config_field__description"></span>
													</label>
													<input id="w-textcolor" name="w-textcolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3">
												</div>
												<div class="col-lg-6">
													<label for="w-bordercolor">
														Border color: <span class="config_field__description"></span>
													</label>
													<input id="w-bordercolor" name="w-bordercolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b2c3cb">
												</div>
												<div class="col-lg-6">
													<label for="w-tabsbordercolor">
														Tabs border color: <span class="config_field__description"></span>
													</label>
													<input id="w-tabsbordercolor" name="w-tabsbordercolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3">
												</div>
												<div class="col-lg-6">
													<label for="w-tabcolor">
														Active tab color: <span class="config_field__description"></span>
													</label>
													<input id="w-tabcolor" name="w-tabcolor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff">
												</div>
												<div class="col-lg-6">
													<label for="w-tabbackground">
														Active tab background: <span class="config_field__description"></span>
													</label>
													<input id="w-tabbackground" name="w-tabbackground" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d2">
												</div>
												<div class="col-lg-6">
													<label for="w-hovertabcolor">
														Hover tab color: <span class="config_field__description"></span>
													</label>
													<input id="w-hovertabcolor" name="w-hovertabcolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3">
												</div>
												<div class="col-lg-6">
													<label for="w-hovertabbackground">
														Hover tab background: <span class="config_field__description"></span>
													</label>
													<input id="w-hovertabbackground" name="w-hovertabbackground" class="color-picker" type="text" size="7" min="7" max="7" value="#dfe6ea">
												</div>
												<div class="col-lg-6">
													<label for="w-selectorcolorhover">
														Selector hover color: <span class="config_field__description"></span>
													</label>
													<input id="w-selectorcolorhover" name="w-selectorcolorhover" class="color-picker" type="text" size="7" min="7" max="7" value="#189ddc">
												</div>
												<div class="col-lg-6">
													<label for="w-datesbackground">
														Dates background: <span class="config_field__description"></span>
													</label>
													<input id="w-datesbackground" name="w-datesbackground" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d2">
												</div>
												<div class="col-lg-6">
													<label for="w-datescolor">
														Dates color: <span class="config_field__description"></span>
													</label>
													<input id="w-datescolor" name="w-datescolor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff">
												</div>
												<div class="col-lg-6">
													<label for="w-datescolorhover">
														Dates color hover: <span class="config_field__description"></span>
													</label>
													<input id="w-datescolorhover" name="w-datescolorhover" class="color-picker" type="text" size="7" min="7" max="7" value="#189ddc">
												</div>
												<div class="col-lg-6">
													<label for="w-schedulesdotscolor">
														Schedules dots color: <span class="config_field__description"></span>
													</label>
													<input id="w-schedulesdotscolor" name="w-schedulesdotscolor" class="color-picker" type="text" size="7" min="7" max="7" value="#009cde">
												</div>
												<div class="col-lg-6">
													<label for="w-schedulesdotscolorhover">
														Schedules dates hover: <span class="config_field__description"></span>
													</label>
													<input id="w-schedulesdotscolorhover" name="w-schedulesdotscolorhover" class="color-picker" type="text" size="7" min="7" max="7" value="#ba1079">
												</div>
												<div class="col-lg-6">
													<label for="w-popuscolor">
														Popups color: <span class="config_field__description"></span>
													</label>
													<input id="w-popuscolor" name="w-popuscolor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff">
												</div>
												<div class="col-lg-6">
													<label for="w-popusbackground">
														Popups background: <span class="config_field__description"></span>
													</label>
													<input id="w-popusbackground" name="w-popusbackground" class="color-picker" type="text" size="7" min="7" max="7" value="#768692">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row row-native">
									<div class="col-lg-12 double-margin-bottom">
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
									<button w-widget-type="calendar" type="button" class="js_get_widget_code btn btn-block button button-blue widget_config__btn"><?php esc_attr_e( 'ADD WIDGET', $this->plugin_name ); ?></button>
								</div>
								<div class="col-lg-6 col-md-3 col-sm-3">
									<button type="button" class="js_reset_widget btn btn-block button-white-gray-border widget_config__btn"><?php esc_attr_e( 'RESET', $this->plugin_name ); ?></button>
								</div>
							</div>
						</div>
					</form>
				</div>

				<div class="modal modal-common fade" id="js_ls-modal-map" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                    <div class="row">
                                        <h3 class="modal-title col-lg-12"><?php esc_attr_e( 'Select Location', $this->plugin_name ); ?></h3>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="map-holder">
                                                <input id="pac_input" class="controls" type="text" placeholder="<?php esc_attr_e( 'Enter a location', $this->plugin_name ); ?>">
                                                <div id="map_latlong"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <div id="map_address">
                                    <div id="map_address_country"></div>
                                    <div id="map_address_street"></div>
                                </div>
                                <button id="js_widget_modal_map__close" type="button" class="btn btn-submit text-center"><?php esc_attr_e( 'Select Location', $this->plugin_name );?></button>
                            </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

				<div class="col-lg-8 col-lg-widget">
					<div class="widget-container-wrapper">
						<div class="widget-container widget-container--calendar">
							<!-- <script src="https://www.promisejs.org/polyfills/promise-6.1.0.min.js"></script> -->
							<div w-type="calendar" w-tmapikey="pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz" w-googleapikey="AIzaSyBQrJ5ECXDaXVlICIdUBOe8impKIGHDzdA" w-keyword="" w-theme="calendar" w-colorscheme="light" w-width="298" w-height="400" w-size="25" w-border="1" w-borderradius="4" w-postalcode="" w-radius="25" w-country="" w-countrycode="US" w-city="Los Angeles" w-period="week" w-period-week="week" w-layout="vertical" w-classificationid="" w-attractionid="" w-promoterid="" w-venueid="" w-affiliateid="" w-segmentid="" w-proportion="standart" style="height: 400px; width: 298px; border-radius: 4px; border-width: 1px;" w-latlong="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
