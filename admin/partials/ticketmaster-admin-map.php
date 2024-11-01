<?php

/**
 * Partial of the map widget
 *
 * @link       http://www.ticketmaster.com
 * @since      1.0.0
 *
 * @package    Ticketmaster
 * @subpackage Ticketmaster/admin/partials
 */

?>

<div id="ticketmaster-settings" class="wrap">
	<h2><?php esc_attr_e( 'Ticketmaster Settings', $this->plugin_name ); ?></h2>
	<?php
	require_once( 'ticketmaster-admin-nav-tab.php' );
	?>

	<div class="wrap ticketmaster-metaboxes">
		<div id="map-config">
		    <h2><?php esc_attr_e( 'Map Widget', $this->plugin_name ); ?></h2>
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
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <div class="widget_api_key">
                                            <label for="w-tm-api-key">
                                                <?php esc_attr_e( 'API Key', $this->plugin_name ); ?> <span class="config_field__description">(<?php esc_attr_e( 'Required', $this->plugin_name ); ?>)</span>
                                            </label>
                                            <a href="https://developer-acct.ticketmaster.com/user/login" class="pull-right"><?php esc_attr_e( 'Get your own', $this->plugin_name ); ?></a>
                                            <div class="widget_api_key__field" id="js_custom_select_key">
                                                <input type="text" id="w-tm-api-key" name="w-tm-api-key" value="TQMbqzKDBbcCjAxC9SaKS1lg9D5Eousb">
                                                <a target="_blank" href="https://developer.ticketmaster.com/support/faq/" class="widget_api_key__question"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <label for="w-googleapikey">
                                            <?php esc_attr_e( 'Google API Key', $this->plugin_name ); ?> <span class="config_field__description">(<?php esc_attr_e( 'Required', $this->plugin_name ); ?>)</span>
                                        </label>
                                        <input type="text" id="w-googleapikey" name="w-googleapikey" value="">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6">
                                        <label for="w-keyword"><?php esc_attr_e( 'Keyword', $this->plugin_name ); ?></label>
                                        <input type="text" id="w-keyword" name="w-keyword" value="">
                                    </div>
                                </div>
                                <div class="row row-native">
                                    <div class="col-lg-12 base-margin-bottom">
                                        <label><?php esc_attr_e( 'Period', $this->plugin_name ); ?></label>
                                        <div class="row radio-buttons">
                                            <div class="col-lg-3 col-sm-2 col-xs-6 widget__various-min-width">
                                                <input checked="" id="w-period-day" type="radio" value="day" name="w-period">
                                                <label for="w-period-day"><?php esc_attr_e( 'Today', $this->plugin_name ); ?></label>
                                            </div>
                                            <div class="col-lg-3 col-sm-2 col-xs-6 widget__various-min-width">
                                                <input checked="" id="w-period-week" type="radio" value="week" name="w-period">
                                                <label for="w-period-week"><?php esc_attr_e( 'Week', $this->plugin_name ); ?></label>
                                            </div>
                                            <div class="col-lg-3 col-sm-2 col-xs-6 widget__various-min-width">
                                                <input id="w-period-month" type="radio" value="month" name="w-period">
                                                <label for="w-period-month"><?php esc_attr_e( 'Month', $this->plugin_name ); ?></label>
                                            </div>
                                            <div class="col-lg-3 col-sm-2 col-xs-6 widget__various-min-width">
                                                <input id="w-period-year" type="radio" value="year" name="w-period">
                                                <label for="w-period-year"><?php esc_attr_e( 'Year', $this->plugin_name ); ?></label>
                                            </div>
                                        </div>
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
                                                                <option value="">Select Country</option>
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
                                                            <?php esc_attr_e( 'Radius', $this->plugin_name ); ?> <span class="config_field__description">(<?php esc_attr_e( 'miles', $this->plugin_name ); ?>)</span>
                                                        </label>
                                                        <div class="js_numeric-input-group"><input class="js_widget__number js_numeric_input text-center" type="number" id="w-radius" name="w-radius" value="25" min="1" max="19999" inputmode="numeric"><span class="arrow arrow__inc"></span><span class="arrow arrow__dec"></span></div>
                                                </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <input type="checkbox" name="w-geoposition" id="w-geoposition" value="off">
                                                        <label for="w-geoposition"><?php esc_attr_e( '«Near Me» button is enabled *', $this->plugin_name ); ?></label>
                                                        <p><small><?php esc_attr_e( '* «Near Me» button function is available only with SSL connection', $this->plugin_name ); ?></small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-native">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="w-source"><?php esc_attr_e( 'Source', $this->plugin_name ); ?></label>
                                        <div class="js_custom_select custom_select">
                                            <select id="w-source" class="custom_select__field" name="w-source" tabindex="-1">
                                                <option value="" label=" "></option>
                                                <option value="ticketmaster"><?php esc_attr_e( 'ticketmaster', $this->plugin_name ); ?></option>
                                                <option value="tmr"><?php esc_attr_e( 'ticketmaster resale platform', $this->plugin_name ); ?></option>
                                                <option value="universe"><?php esc_attr_e( 'universe', $this->plugin_name ); ?></option>
                                                <option value="frontgate"><?php esc_attr_e( 'frontgate', $this->plugin_name ); ?></option>
                                            </select>
                                        <div class="custom_select__arrow"></div></div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-3">
		                                <label for="w-classificationname"><?php esc_attr_e( 'Classification Name', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-classificationname" name="w-classificationname" value="" class="js_lazy-selector-classification">
		                            </div>
                                </div>

                                <div class="row row-native">
                                    <div class="col-lg-6 col-md-6 col-sm-3">
		                                <label for="w-attractionid"><?php esc_attr_e( 'Attraction ID', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-attractionid" name="w-attractionid" value="">
		                            </div>
                                    <div class="col-lg-6 col-md-6 col-sm-3">
                                        <label for="w-promoterid">Promoter ID</label>
                                        <input type="text" id="w-promoterid" name="w-promoterid" value="">
                                    </div>
                                </div>
                                <div class="row row-native">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
		                                <label for="w-venueid"><?php esc_attr_e( 'Venue ID', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-venueid" name="w-venueid" value="">
		                            </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <label for="w-size">
                                            <?php esc_attr_e( 'Event Count', $this->plugin_name ); ?> <span class="config_field__description">(1-100)</span>
                                        </label>
                                        <div class="js_numeric-input-group"><input class="js_widget__number js_numeric_input text-center double-margin-bottom" type="number" id="w-size" name="w-size" value="25" max="100" min="1" required="" inputmode="numeric"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="widget-config-styling">
                                <div class="row row-native">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-color_scheme">
                                        <div class="widget__color_scheme_control" style="display: none">
                                            <label><?php esc_attr_e( 'Color Scheme', $this->plugin_name ); ?></label>
                                            <div class="tab-buttons">
                                                <input checked="" id="w-colorscheme-light" type="radio" value="light" name="w-colorscheme">
                                                <label for="w-colorscheme-light"><?php esc_attr_e( 'Light', $this->plugin_name ); ?></label>
                                                <input id="w-colorscheme-dark" type="radio" value="dark" name="w-colorscheme">
                                                <label for="w-colorscheme-dark"><?php esc_attr_e( 'Dark', $this->plugin_name ); ?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-sm-layout">
                                        <div class="row base-margin-bottom">
                                            <label><?php esc_attr_e( 'Layout', $this->plugin_name ); ?></label>
                                            <div class="col-lg-12 js-fixed-size-buttons radio-buttons">
                                                <div class="row">
                                                    <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
                                                        <input id="w-fixed-300x600" type="radio" value="m" name="w-proportion">
                                                        <label for="w-fixed-300x600">300x600</label>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
                                                        <input id="w-fixed-300x250" type="radio" value="s" name="w-proportion">
                                                        <label for="w-fixed-300x250">300x250</label>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
                                                        <input checked="" id="w-custom" type="radio" value="custom" name="w-proportion">
                                                        <label for="w-custom"><?php esc_attr_e( 'Custom', $this->plugin_name ); ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 js-tab-buttons radio-buttons">
                                                <div class="row">
                                                    <div class="col-lg-12 line"></div>
                                                    <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
                                                        <input checked="" id="w-layout-vertical" type="radio" value="vertical" name="w-layout">
                                                        <label for="w-layout-vertical"><?php esc_attr_e( 'Vertical', $this->plugin_name ); ?></label>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
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
                                            <?php esc_attr_e( 'Width', $this->plugin_name ); ?> <span class="config_field__description">(px)</span>
                                        </label>
                                        <div class="row row-native">
										  <div class="col-lg-6">
                                            <div class="bootstrap_slider bootstrap_slider-horizontal">
                                              <input id="w-width" name="w-width" type="text" min="350" max="500" value="350" />
                                            </div>
                                          </div>
										  <div class="col-lg-6">
										    <span class="config_field__description max"><?php esc_attr_e( 'max width is 1920 px', $this->plugin_name ); ?></span>
									      </div>
		                                </div>
                                    </div>
                                    <div class="col-lg-12 double-margin-bottom">
                                        <label for="w-borderradius">
                                            <?php esc_attr_e( 'Corner Radius', $this->plugin_name ); ?> <span class="config_field__description">(px)</span>
                                        </label>
                                        <div class="row row-native">
                                          <div class="col-lg-6">
                                            <div class="bootstrap_slider bootstrap_slider-horizontal">
                                              <input id="w-borderradius" name="w-borderradius" type="text" min="0" max="20" value="4" />
                                            </div>
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
									<button w-widget-type="map" type="button" class="js_get_widget_code btn btn-block button button-blue widget_config__btn"><?php esc_attr_e( 'ADD WIDGET', $this->plugin_name ); ?></button>
								</div>
								<div class="col-lg-6 col-md-3 col-sm-3">
									<button type="button" class="js_reset_widget btn btn-block button-white-gray-border widget_config__btn"><?php esc_attr_e( 'RESET', $this->plugin_name ); ?></button>
								</div>
							</div>
                        
                        </div>
                    </form>
                    
                    <div class="modal modal-common fade" id="js_ls-modal-classification" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                    <div class="row">
                                        <h3 class="modal-title col-lg-12"><?php esc_attr_e( 'Classification Selection', $this->plugin_name ); ?></h3>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <form id="js_lazy-sel_form" accept-charset="UTF-8" method="GET">
                                            <div class="col-sm-9 clear-padding-right">
                                                <input id="keyword" placeholder="keyword" autofocus="" class="search-input">
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <button id="js_classification-modal_btn" type="button" class="btn btn-transparent" data-selector="classifications"><?php esc_attr_e( 'GET', $this->plugin_name ); ?></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="spinner-ls" style="display: none;"></div>
                                    <div class="top-hr"></div>
                                    <div id="classification-jstree"></div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

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
                                <button id="js_widget_modal_map__close" type="button" class="btn btn-submit text-center"><?php esc_attr_e( 'SELECT', $this->plugin_name ); ?></button>
                            </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    
                    <?php
                        require_once( 'ticketmaster-admin-modal-lazy-selector.php' );
                    ?>
	            </div>
			    <div class="col-lg-8 col-lg-widget">
			        <div class="widget-container-wrapper" data-min="350" data-max="417" style="width: auto; margin-top: 0px;">
			            <div class="widget-container" style="width: 100%;">
			                <div w-type="map" w-tmapikey="TQMbqzKDBbcCjAxC9SaKS1lg9D5Eousb" w-googleapikey="" w-keyword="" w-theme="simple" w-colorscheme="light" w-width="350" w-height="600" w-size="25" w-border="1" w-borderradius="4" w-postalcode="" w-radius="" w-countrycode="US" w-city="Los Angeles" w-period="week" w-layout="vertical" w-attractionid="" w-promoterid="" w-venueid="" w-affiliateid="" w-segmentid="" w-proportion="custom" w-geoposition="off" style="height: 600px; width: 350px;" w-source=""></div>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<?php
/*function to add async and defer attributes
function defer_js_async($tag){

## 1: list of scripts to defer.
$scripts_to_defer = array('https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&#038;libraries=visualization%2Cplaces&#038;callback=initMapLatLong&#038;ver=1.0.0');
## 2: list of scripts to async.
$scripts_to_async = array('https://maps.googleapis.com/maps/api/js?key=AIzaSyB3-oFbQWw_jEcG7r7WGdi99jNT3DqvRas&#038;libraries=visualization%2Cplaces&#038;callback=initMapLatLong&#038;ver=1.0.0');
 
#defer scripts
foreach($scripts_to_defer as $defer_script){
	if(true == strpos($tag, $defer_script ) )
	return str_replace( ' src', ' async defer src', $tag );	
}
#async scripts
foreach($scripts_to_async as $async_script){
	if(true == strpos($tag, $async_script ) )
	return str_replace( ' src', ' async src', $tag );	
}
return $tag;
}
add_filter( 'script_loader_tag', 'defer_js_async', 10 );
*/ ?>