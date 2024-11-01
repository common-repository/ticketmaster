<?php

/**
 * Partial of the event discovery widget
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
		<div id="event-discovery-config">
			<h2><?php esc_attr_e( 'Event Discovery Widget', $this->plugin_name ); ?></h2>
			<p><?php esc_attr_e( 'You can use the widget configurator below to customize the layout of the widget.', $this->plugin_name ); ?></p>
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
		                            <div class="col-lg-12 base-margin-bottom">
		                                <label>Period</label>
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
											<div class="col-lg-3 col-sm-2 col-xs-6 widget__various-min-width">
												<input id="w-period-custom" type="radio" value="custom" name="w-period">
												<label for="w-period-custom"><?php esc_attr_e( 'Custom', $this->plugin_name ); ?></label>
											</div>
		                                </div>
		                            </div>
									<div class="custom-dates-wrapper display-none">
										<div class="col-lg-12">
											<label for="w-startdatetime"><?php esc_attr_e( 'Date start', $this->plugin_name ); ?></label>
											<div class="position-relative">
												<input type="text" id="w-startdatetime" name="w-startdatetime">
												<span class="dt-ico" data-input-id="w-startdatetime"></span>
											</div>
										</div>
										<div class="col-lg-12">
											<label for="w-enddatetime"><?php esc_attr_e( 'Date end', $this->plugin_name ); ?></label>
											<div class="position-relative">
												<input type="text" id="w-enddatetime" name="w-enddatetime">
												<span class="dt-ico" data-input-id="w-enddatetime"></span>
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
	                                                            <option value=""><?php esc_attr_e( 'Select Country', $this->plugin_name ); ?></option>
                                                            </select>
                                                            <input type="hidden" id="h-countryCode" name="h-countryCode" value="US">
                                                        <div class="custom_select__arrow"></div></div>
                                                    </div>
                                                </div>
                                                <div class="row row-native">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label for="w-postalcode">Postal Code</label>
                                                            <input type="text" id="w-postalcode" name="w-postalcode" value="">
                                                        <input type="hidden" id="h-postalcode" name="h-postalcode" value="">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <label for="w-city">City</label>
                                                        <input type="text" id="w-city" name="w-city" value="Los Angeles">
                                                        <input type="hidden" id="h-city" name="h-city" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget__latlong hidn">
                                                <p><?php esc_attr_e( 'You can use Geoposition or', $this->plugin_name ); ?> <span><?php esc_attr_e( 'input Location data', $this->plugin_name ); ?></span></p>
                                                <div class="row row-native">
                                                    <div class="col-lg-6 col-md-12 col-sm-12 latlong-holder">
                                                     <label for="w-latlong"><?php esc_attr_e( 'Geoposition', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(Latitude, Longitude)', $this->plugin_name ); ?></span></label>
                                                    <input type="text" id="w-latlong" name="w-latlong" value="">
                                                        <a href="#" id="js_widget_modal_map__open" class="latlong-picker" data-selector="map-open"></a>
                                                    <input type="hidden" id="h-latlong" name="h-latlong" value="34.0390107, -118.2672801">
                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                                        <label for="w-radius">
                                                            Radius <span class="config_field__description"><?php esc_attr_e( '(miles)', $this->plugin_name ); ?></span>
                                                        </label>
                                                        <div class="js_numeric-input-group"><input class="js_widget__number js_numeric_input text-center" type="number" id="w-radius" name="w-radius" value="25" min="1" max="19999" inputmode="numeric"><span class="arrow arrow__inc"></span><span class="arrow arrow__dec"></span></div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

		                        <div class="row row-native">
		                            <div class="col-lg-6 col-md-6 col-sm-3">
		                                <label for="w-attractionid"><?php esc_attr_e( 'Attraction ID', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-attractionid" name="w-attractionid" value="">
		                            </div>
		                            <div class="col-lg-6 col-md-6 col-sm-3">
		                                <label for="w-promoterid"><?php esc_attr_e( 'Promoter ID', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-promoterid" name="w-promoterid" value="">
		                            </div>
		                            <div class="col-lg-6 col-md-6 col-sm-3">
		                                <label for="w-venueid"><?php esc_attr_e( 'Venue ID', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-venueid" name="w-venueid" value="">
		                            </div>
		                            <div class="col-lg-6 col-md-6 col-sm-3">
		                                <label for="w-source"><?php esc_attr_e( 'Source', $this->plugin_name ); ?></label>
		                                <select id="w-source" class="custom_select__field" name="w-source" tabindex="0">
											<option value="" label="none">none</option>
											<option value="ticketmaster">ticketmaster</option>
											<option value="ticketweb">ticketweb</option>
											<option value="tmr">ticketmaster resale platform</option>
											<option value="universe">universe</option>
											<option value="frontgate">frontgate</option>
										</select>
		                            </div>
		                            <div class="col-lg-12 col-md-6 col-sm-3">
		                                <label for="w-classificationname"><?php esc_attr_e( 'Classification Name', $this->plugin_name ); ?></label>
		                                <input type="text" id="w-classificationname" name="w-classificationname" value="" class="js_lazy-selector-classification">
		                            </div>
									<div class="col-lg-12 col-md-12 col-sm-12">
										<label for="w-sorting"><?php esc_attr_e( 'Sorting Order', $this->plugin_name ); ?></label>
										<div class="js_custom_select custom_select">
											<select id="w-sorting" class="custom_select__field" name="w-sorting" tabindex="0">
												<option value="groupByName"><?php esc_attr_e( 'Group by name', $this->plugin_name ); ?></option>
												<option value="dateAscending"><?php esc_attr_e( 'Date ascending', $this->plugin_name ); ?></option>
											</select>
										</div>
									</div>
		                        </div>

		                        <div class="row row-native">
		                            <div class="col-lg-12 col-md-6 col-sm-6">
		                                <label for="w-size">
			                                <?php esc_attr_e( 'Event Count', $this->plugin_name ); ?> <span class="config_field__description">(1-100)</span>
		                                </label>
		                            </div>
		                            <div class="col-lg-3 col-md-2 col-sm-2 widget__various-width">
		                                <input class="js_widget__number js_numeric_input text-center double-margin-bottom" type="number" id="w-size" name="w-size" value="25" required="">
		                            </div>
		                        </div>
		                    </div>

		                    <div class="tab-pane fade" id="widget-config-styling">
		                        <div class="row row-native">
		                            <div class="col-lg-12 col-md-12 col-sm-12 col-sm-theme">
		                                <label><?php esc_attr_e( 'Themes', $this->plugin_name ); ?></label>
		                                <div class="tab-buttons">
		                                    <input checked="" id="w-theme-simple" type="radio" value="simple" name="w-theme">
		                                    <label for="w-theme-simple"><?php esc_attr_e( 'Poster', $this->plugin_name ); ?></label>
		                                    <input id="w-theme-oldschool" type="radio" value="oldschool" name="w-theme">
		                                    <label for="w-theme-oldschool"><?php esc_attr_e( 'Oldskool', $this->plugin_name ); ?></label>
		                                    <input id="w-theme-newschool" type="radio" value="newschool" name="w-theme">
		                                    <label for="w-theme-newschool"><?php esc_attr_e( 'Color Block', $this->plugin_name ); ?></label>
		                                    <input id="w-theme-listview" type="radio" value="listview" name="w-theme">
		                                    <label for="w-theme-listview"><?php esc_attr_e( 'List View', $this->plugin_name ); ?></label>
											<input id="w-theme-listview-thumbnails" type="radio" value="listviewthumbnails" name="w-theme">
											<label for="w-theme-listview-thumbnails"><?php esc_attr_e( 'List View Thumbnails', $this->plugin_name ); ?></label>
                                            <input id="w-theme-grid" type="radio" value="grid" name="w-theme">
                                            <label for="w-theme-grid"><?php esc_attr_e( 'Grid'); ?></label>
                                        </div>
		                            </div>

		                            <div class="col-lg-12 col-md-12 col-sm-12 col-sm-color_scheme">
		                                <div class="widget__color_scheme_control">
		                                    <label><?php esc_attr_e( 'Color Scheme', $this->plugin_name ); ?></label>
		                                    <div class="tab-buttons">
		                                        <input checked="" id="w-colorscheme-light" type="radio" value="light" name="w-colorscheme">
		                                        <label for="w-colorscheme-light"><?php esc_attr_e( 'Light', $this->plugin_name ); ?></label>
		                                        <input id="w-colorscheme-dark" type="radio" value="dark" name="w-colorscheme">
		                                        <label class="widget__dark-theme-selector display-none" for="w-colorscheme-dark"><?php esc_attr_e( 'Dark', $this->plugin_name ); ?></label>
												<input id="w-colorscheme-custom" type="radio" value="custom" name="w-colorscheme">
												<label for="w-colorscheme-custom"><?php esc_attr_e( 'Custom', $this->plugin_name ); ?></label>
		                                    </div>
		                                </div>
		                            </div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-sm-layout widget__color_scheme_custom display-none">
										<div class="row row-native">
											<div id="w-titleColor-container" class="col-lg-12">
												<label for="w-titleColor">
													<?php esc_attr_e( 'Title color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-titleColor" name="w-titleColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
											</div>
											<div id="w-titleHoverColor-container" class="col-lg-12">
												<label for="w-titleHoverColor">
													<?php esc_attr_e( 'Title hover color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-titleHoverColor" name="w-titleHoverColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
											</div>
											<div id="w-arrowColor-container" class="col-lg-12">
												<label for="w-arrowColor">
													<?php esc_attr_e( 'Arrow color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-arrowColor" name="w-arrowColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
											</div>
											<div id="w-arrowHoverColor-container" class="col-lg-12">
												<label for="w-arrowHoverColor">
													<?php esc_attr_e( 'Arrow hover color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-arrowHoverColor" name="w-arrowHoverColor" class="color-picker" type="text" size="7" min="7" max="7" value="#009cde" data-default-value="#009cde">
											</div>
											<div id="w-dateColor-container" class="col-lg-12">
												<label for="w-dateColor">
													<?php esc_attr_e( 'Date color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-dateColor" name="w-dateColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
											</div>
											<div id="w-descriptionColor-container" class="col-lg-12">
												<label for="w-descriptionColor">
													<?php esc_attr_e( 'Venue color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-descriptionColor" name="w-descriptionColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
											</div>
											<div id="w-counterColor-container" class="col-lg-12">
												<label for="w-counterColor">
													<?php esc_attr_e( 'Counter color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-counterColor" name="w-counterColor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3" data-default-value="#b7c9d3">
											</div>
											<div id="w-bordercolor-container" class="col-lg-12">
												<label for="w-bordercolor">
													<?php esc_attr_e( 'Border color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-bordercolor" name="w-bordercolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3" data-default-value="#b7c9d3">
											</div>
											<div id="w-backgroundcolor-container" class="col-lg-12">
												<label for="w-backgroundcolor">
													<?php esc_attr_e( 'Background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
												</label>
												<input id="w-backgroundcolor" name="w-backgroundcolor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3" data-default-value="#b7c9d3">
											</div>
                                            <div id="w-buyButtonBackgroundColor-container" class="col-lg-12">
                                                <label for="w-buyButtonBackgroundColor">
	                                                <?php esc_attr_e( 'Buy button background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-buyButtonBackgroundColor" name="w-buyButtonBackgroundColor" class="color-picker" type="text" size="7" min="7" max="7" value="#009cde" data-default-value="#009cde">
                                            </div>
                                            <div id="w-buyButtonBackgroundHoverColor-container" class="col-lg-12">
                                                <label for="w-buyButtonBackgroundHoverColor">
	                                                <?php esc_attr_e( 'Buy button hover background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-buyButtonBackgroundHoverColor" name="w-buyButtonBackgroundHoverColor" class="color-picker" type="text" size="7" min="7" max="7" value="#2A7CC7" data-default-value="#2A7CC7">
                                            </div>
                                            <div id="w-buyButtonTextColor-container" class="col-lg-12">
                                                <label for="w-buyButtonTextColor">
	                                                <?php esc_attr_e( 'Buy button text color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-buyButtonTextColor" name="w-buyButtonTextColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
                                            </div>
                                            <div id="w-poweredByBackgroundColor-container" class="col-lg-12">
                                                <label for="w-poweredByBackgroundColor">
	                                                <?php esc_attr_e( '"Powered by" section background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-poweredByBackgroundColor" name="w-poweredByBackgroundColor" class="color-picker" type="text" size="7" min="7" max="7" value="#b7c9d3" data-default-value="#b7c9d3">
                                            </div>

                                            <div id="w-showMoreButtonBackgroundColor-container" class="col-lg-12">
                                                <label for="w-showMoreButtonBackgroundColor">
	                                                <?php esc_attr_e( '"SHOW MORE" button background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-showMoreButtonBackgroundColor" name="w-showMoreButtonBackgroundColor" class="color-picker" type="text" size="7" min="7" max="7" value="#2888b1" data-default-value="#2888b1">
                                            </div>

                                            <div id="w-showMoreButtonBackgroundHoverColor-container" class="col-lg-12">
                                                <label for="w-showMoreButtonBackgroundHoverColor">
	                                                <?php esc_attr_e( '"SHOW MORE" button hover background color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-showMoreButtonBackgroundHoverColor" name="w-showMoreButtonBackgroundHoverColor" class="color-picker" type="text" size="7" min="7" max="7" value="#1e779c" data-default-value="#1e779c">
                                            </div>

                                            <div id="w-showMoreButtonTextColor-container" class="col-lg-12">
                                                <label for="w-showMoreButtonTextColor">
	                                                <?php esc_attr_e( '"SHOW MORE" button text color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-showMoreButtonTextColor" name="w-showMoreButtonTextColor" class="color-picker" type="text" size="7" min="7" max="7" value="#ffffff" data-default-value="#ffffff">
                                            </div>

                                            <div id="w-loadingEventSpinnerColor-container" class="col-lg-12">
                                                <label for="w-loadingEventSpinnerColor">
	                                                <?php esc_attr_e( 'Events loader color:', $this->plugin_name ); ?> <span class="config_field__description"></span>
                                                </label>
                                                <input id="w-loadingEventSpinnerColor" name="w-loadingEventSpinnerColor" class="color-picker" type="text" size="7" min="7" max="7" value="#2888b1" data-default-value="#2888b1">
                                            </div>
                                        </div>
									</div>

                                    <div id="layout-options-block" class="col-lg-12 col-md-12 col-sm-12 col-sm-layout">
		                                <div class="row base-margin-bottom">
		                                    <label><?php esc_attr_e( 'Layout', $this->plugin_name ); ?></label>
		                                    <div class="col-lg-12 js-fixed-size-buttons radio-buttons">
		                                        <div class="row">
		                                            <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
		                                                <input id="w-fixed-300x600" type="radio" value="xxl" name="w-proportion">
		                                                <label for="w-fixed-300x600">300x600</label>
		                                            </div>
		                                            <div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
		                                                <input id="w-fixed-300x250" type="radio" value="m" name="w-proportion">
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
													<div class="col-lg-4 col-sm-2 col-xs-2  widget__various-width">
														<input id="w-layout-fullwidth" type="radio" value="fullwidth" name="w-layout">
														<label for="w-layout-fullwidth"><?php esc_attr_e( 'Fullwidth', $this->plugin_name ); ?></label>
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
										<div class="col-xs-6">
										  <div class="bootstrap_slider bootstrap_slider-horizontal">
										    <input id="w-width" name="w-width" type="text" min="350" max="500" value="350" />
										  </div>
										</div>
										<div class="col-xs-6">
										  <span class="config_field__description max"><?php esc_attr_e( 'max width is 1920 px', $this->plugin_name ); ?></span>
									    </div>
		                              </div>
									</div>

                                    <div id="w-minHeight-container" class="col-lg-12" style="display: none">
                                        <label for="w-minHeight">
	                                        <?php esc_attr_e( 'Min height', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
                                        </label>
                                        <div class="row row-native">
                                            <div class="col-xs-6">
                                                <input id="w-minHeight" name="w-minHeight" type="number" value="600" style="text-align: center"/>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="config_field__description"><?php esc_attr_e( 'Min height of the widget to which he could shrink', $this->plugin_name ); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="w-maxHeight-container" class="col-lg-12" style="display: none">
                                        <label for="w-maxHeight">
	                                        <?php esc_attr_e( 'Max height', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
                                        </label>
                                        <div class="row row-native">
                                            <div class="col-xs-6">
                                                <input id="w-maxHeight" name="w-maxHeight" type="number" value="600" style="text-align: center"/>
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="config_field__description"><?php esc_attr_e( 'Max height of the widget to which he could stretch', $this->plugin_name ); ?></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
		                              <label for="w-borderradius">
											<?php esc_attr_e( 'Corner Radius', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
		                              </label>
									  <div class="row row-native">
									    <div class="col-xs-6 bootstrap_slider bootstrap_slider-horizontal">
                                          <input id="w-borderradius" class="text-center" name="w-borderradius" type="number" min="0" max="50" value="4" />
		                                </div>
									    <div class="col-xs-6 double-margin-bottom">
									      <span class="config_field__description max"><?php esc_attr_e( 'Max radius is 50 px', $this->plugin_name ); ?></span>
									    </div>
									  </div>
		                            </div>

                                    <div class="col-lg-12">
                                        <label for="w-border">
	                                        <?php esc_attr_e( 'Border Width', $this->plugin_name ); ?> <span class="config_field__description"><?php esc_attr_e( '(px)', $this->plugin_name ); ?></span>
                                        </label>
                                        <div class="row row-native">
                                            <div class="col-xs-6">
                                                <input id="w-border" class="text-center" name="w-border" type="number" min="0" max="5" value="0" />
                                            </div>
                                            <div class="col-xs-6">
                                                <span class="config_field__description"><?php esc_attr_e( 'Max width is 5 px', $this->plugin_name ); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="w-gridColumns-container" class="col-lg-12" style="display: none;">
                                        <label for="w-gridColumns">
                                            <?php esc_attr_e( 'Grid columns'); ?>
                                        </label>
                                        <div class="row row-native">
                                            <div class="col-lg-6">
                                                <input id="w-gridColumns" class="text-center" name="w-gridColumns" type="number" min="2" max="4" value="3" />
                                            </div>
                                            <div class="col-lg-6">
                                                <span class="config_field__description"><?php esc_attr_e('Amount of columns in a grid (2-4)'); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
										<label for="w-titlelink"><?php esc_attr_e( 'Title link behaviour', $this->plugin_name ); ?></label>
										<div class="js_custom_select custom_select">
											<select id="w-titlelink" class="custom_select__field" name="w-titlelink" tabindex="-1">
												<option value="off"><?php esc_attr_e( 'Open title link in new tab', $this->plugin_name ); ?></option>
												<option value="on"><?php esc_attr_e( 'Open title link in current tab', $this->plugin_name ); ?></option>
											</select>
										</div>
									</div>

                                    <div class="col-lg-12">
                                        <label for="w-branding"><?php esc_attr_e( 'Branding', $this->plugin_name ); ?></label>
                                        <div class="js_custom_select custom_select">
                                            <select id="w-branding" class="custom_select__field" name="w-branding" tabindex="-1">
                                                <option value="Ticketmaster"><?php esc_attr_e( 'Ticketmaster', $this->plugin_name ); ?></option>
                                                <option value="TicketWeb"><?php esc_attr_e( 'TicketWeb', $this->plugin_name ); ?></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12" id="w-showFullEventsNames-container" style="display: none">
                                        <input id="w-showFullEventsNames" type="checkbox" name="w-showFullEventsNames">
                                        <label for="w-showFullEventsNames"><?php esc_attr_e( 'Show full events names', $this->plugin_name ); ?></label>
                                    </div>

                                    <div class="col-lg-12" id="w-showLoadMoreButton-container" style="display: none">
                                        <input id="w-showLoadMoreButton" type="checkbox" name="w-showLoadMoreButton">
                                        <label for="w-showLoadMoreButton"><?php esc_attr_e( 'Display "SHOW MORE" button', $this->plugin_name ); ?></label>
                                    </div>

                                    <div class="col-lg-12" id="w-enableInfinityScroll-container" style="display: none">
                                        <input id="w-enableInfinityScroll" type="checkbox" name="w-enableInfinityScroll">
                                        <label for="w-enableInfinityScroll"><?php esc_attr_e( 'Enable infinity scroll', $this->plugin_name ); ?></label>
                                    </div>

                                </div>
		                    </div>

		                    <div class="row row-native visible-lg">
		                        <div class="col-lg-6 col-md-3 col-sm-3">
		                            <button w-widget-type="event-discovery" type="button" class="js_get_widget_code btn btn-block button button-blue widget_config__btn"><?php esc_attr_e( 'ADD WIDGET', $this->plugin_name ); ?></button>
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

		        <div id="widget-constructor" class="col-lg-8 col-lg-widget">
		            <div class="widget-container-wrapper" data-min="350" data-max="1012" style="margin-top: 0px;">
		                <div class="widget-container widget-container--discovery">
		                    <div w-type="event-discovery" w-tmapikey="pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz" w-googleapikey="AIzaSyBQrJ5ECXDaXVlICIdUBOe8impKIGHDzdA" w-keyword="" w-theme="simple" w-colorscheme="light" w-width="350" w-height="600" w-size="25" w-border="0" w-borderradius="4" w-postalcode="90015" w-radius="25" w-countrycode="US" w-city="Los Angeles" w-period="week" w-layout="vertical" w-attractionid="" w-promoterid="" w-venueid="" w-affiliateid="" w-segmentid="" w-proportion="custom" w-titlelink="off" w-sorting="groupByName"></div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
