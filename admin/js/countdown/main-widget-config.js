(
	function ( $ ) {

		'use strict';

		var widget = widgetsLib.widgetsCountdown[0];
		var themeConfig = {
			simple_countdown: {
				sizes: {
					s: {
						width: 180,
						height: 150,
						layout: 'horizontal'
					},
					m: {
						width: 300,
						height: 250,
						layout: 'vertical'
					},
					l: {
						width: 160,
						height: 600,
						layout: 'horizontal'
					},
					xl: {
						width: 728,
						height: 90,
						layout: 'horizontal'
					},
					xxl: {
						width: 300,
						height: 600,
						layout: 'vertical'
					},
					custom: {
						width: 350,
						height: 600,
						layout: 'vertical'
					},
					fullwidth: {
						width: '100%',
						height: 700,
						layout: ''
					}
				},
				initSliderSize: {
					width: 350,
					height: 600,
					maxWidth: 500,
					minWidth: 350
				}
			}
		};

		/*
		var $widthController = $( '#w-width' ).slider( {
				tooltip: 'always',
				handle: 'square'
			} ),
			$borderRadiusController = $( '#w-borderradius' ).slider( {
				tooltip: 'always',
				handle: 'square'
			} ),
		*/
		var	$getCodeButton = $( '.js_get_widget_code' ),
			widgetNode = document.querySelector( "div[w-tmapikey]" ),
			$tabButtons = $( '.js-tab-buttons' ),
			$layoutBox = $( '#js-layout-box' );

		var $configForm = $( ".main-widget-config-form" ),
			$widgetModal = $( '#js_widget_modal' ),
			$widgetModalNoCode = $( '#js_widget_modal_no_code' );

		//variables for fixed widget
		var $window = $( window ),
			$containerWidget = $( ".widget-container-wrapper" ),
			$configBlock = $( ".config-block" ),
			window_min = 0,
			window_max = 0,
			desktopWidth = 1200,
			threshold_offset = 50;
		/*
		 set the container's maximum and minimum limits as well as movement thresholds
		 */
		function setLimits() {
			//max and min container movements
			var topCss = $containerWidget.css( "top" ) > 0 ? parseInt( $containerWidget.css( "top" ) ) : 0;
			var headerOffset = $( '.top-bar' )
				                   .height() + /*padding of top-bar*/8 + /*bottom-margin*/10;
			var max_move = $configBlock.offset().top + $configBlock.height() - $containerWidget.height() - topCss - headerOffset;
			var min_move = $configBlock.offset().top - headerOffset;

			$containerWidget.attr( "data-min", min_move )
			                .attr( "data-max", max_move );
			//window thresholds so the movement isn't called when its not needed!
			window_min = min_move - threshold_offset;
			window_max = max_move + $containerWidget.height() + threshold_offset;
		}

		/*
		 widget container scroll handler
		 */
		function windowScroll() {
			var innerWidth = window.innerWidth;
			var j = 0;

			function updateScroll() {
				//if the window is within the threshold, begin movements
				if ( $window.scrollTop() >= window_min && $window.scrollTop() < window_max ) {
					if ( $containerWidget.height() < $configBlock.height() && innerWidth >= desktopWidth ) {
						//reset the limits (optional)
						setLimits();
						//move the container
						containerMove();
					}
				}
				j ++;
			}

          if ( j === 0 ) {
            updateScroll();
          }

          setTimeout( function () {
				if ( innerWidth < desktopWidth && $containerWidget.height() > $configBlock.height() ) {
					containerMove_clearOffset();
					updateScroll();
				}
				if ( $containerWidget.height() < $configBlock.height() || innerWidth >= desktopWidth ) {
					if ( innerWidth < desktopWidth ) {
						containerMove_clearOffset();
					}
					updateScroll();
				}
			}, 200 );
		}

		$window.on( "scroll resize", windowScroll );

		/**
		 * Clear top offset of widget container
		 */
		function containerMove_clearOffset() {
			$containerWidget.css( "margin-top", 0 );
		}

		/**
		 * Handles moving the container if needed.
		 **/
		function containerMove() {
			var wst = $window.scrollTop();
			//if the window scroll is within the min and max (the container will be "sticky";
			if ( wst >= $containerWidget.attr( "data-min" ) && wst <= $containerWidget.attr( "data-max" ) ) {
				//work out the margin offset
				var margin_top = $window.scrollTop() - $containerWidget.attr( "data-min" );
				//margin it down!
				$containerWidget.css( "margin-top", margin_top );
				//if the window scroll is below the minimum
			} else if ( wst <= $containerWidget.attr( "data-min" ) ) {
				//fix the container to the top.
				$containerWidget.css( "margin-top", 0 );
				//if the window scroll is above the maximum
			} else if ( wst > $containerWidget.attr( "data-max" ) ) {
				//fix the container to the top
				$containerWidget.css( "margin-top", $containerWidget.attr( "data-max" ) - $containerWidget.attr( "data-min" ) + "px" );
			}
		}

		var replaceApiKey = function replaceApiKey( options ) {
			var userKey = options.userKey || sessionStorage.getItem( 'tk-api-key' );

			if ( userKey !== null ) {
				var inputApiKey = options.inputApiKey;
				var _widgetNode = options.widgetNode;
				var _widget = options.widget;

				inputApiKey.attr( 'value', userKey )
				           .data( 'userAPIkey', userKey )
				           .val( userKey );
				_widgetNode.setAttribute( "w-tm-api-key", userKey );
				_widget.update();
			}
		};

		var changeState = function changeState( event ) {
			if ( ! event.target.name ) {
				return;
			}
			var targetValue = event.target.value,
				targetName = event.target.name;

			if ( targetName === "w-tm-api-key" ) {
				document.querySelector( '[w-type="countdown"]' )
				        .setAttribute( 'w-tmapikey', targetValue );

				if ( sessionStorage.getItem( 'tk-api-key' ) ) {
					document.getElementById( 'w-tm-api-key' ).value = sessionStorage.getItem( 'tk-api-key' );
					document.querySelector( '[w-type="countdown"]' )
					        .setAttribute( 'w-tmapikey', sessionStorage.getItem( 'tk-api-key' ) );
				}
				if ( document.getElementById( 'w-tm-api-key' ).value == '' ) {
					if ( sessionStorage.getItem( 'tk-api-key' ) ) {
						document.getElementById( 'w-tm-api-key' ).value = sessionStorage.getItem( 'tk-api-key' );
						document.querySelector( '[w-type="countdown"]' )
						        .setAttribute( 'w-tmapikey', sessionStorage.getItem( 'tk-api-key' ) );
					} else {
						document.getElementById( 'w-tm-api-key' ).value = 'pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz';
						document.querySelector( '[w-type="countdown"]' )
						        .setAttribute( 'w-tmapikey', 'pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz' );
					}
				}
			}

			if ( targetName === "w-theme" ) {
				var widthSlider = $( '.js_widget_width_slider' ),
					widgetContainerWrapper = $containerWidget,
					widgetContainer = $( ".widget-container", widgetContainerWrapper ),
					$border_slider = $( '.js_widget_border_slider' );

				if ( targetValue === "fullwidth" ) {
					$layoutBox.slideUp();
					widthSlider.slideUp( "fast" );
					$borderRadiusController.slider( 'setValue', 0 );
					widgetNode.setAttribute( 'w-borderradius', 0 );
					$border_slider.slideUp( "fast" );
					widgetContainerWrapper.css( {
						width: "100%"
					} );
					widgetContainer.css( {
						width: "100%"
					} );
					widgetNode.setAttribute( 'w-height', 700 );
				} else {
					var excludeOption = {
						id: widgetNode.getAttribute( 'w-id' )
					};
					resetWidget( $configForm, excludeOption );

					$layoutBox.slideDown( "fast" );
					widthSlider.slideDown( "fast" );
					$border_slider.slideDown( "fast" );
					$borderRadiusController.slider( 'setValue', 4 );
					widgetNode.setAttribute( 'w-borderradius', 4 );
					widgetContainerWrapper.css( {
						width: 'auto'
					} );
				}
			}

			if ( targetName === "w-layout" ) {
				var sizeConfig = themeConfig.simple_countdown.initSliderSize;

				if ( targetValue === 'horizontal' ) {
					sizeConfig = {
						width: 620,
						// height: getHeightByTheme(widgetNode.getAttribute('w-theme')),
						height: 252,
						maxWidth: 900,
						minWidth: 620
					};
				}

				/*
				$widthController.slider( {
					setValue: sizeConfig.width,
					max: sizeConfig.maxWidth,
					min: sizeConfig.minWidth
				} ).slider( 'refresh' );
				*/

				widgetNode.setAttribute( 'w-width', sizeConfig.width );
				widgetNode.setAttribute( 'w-height', sizeConfig.height );
			}

			//Check fixed sizes for 'simple_countdown' theme
			if ( targetName === "w-proportion" ) {
				var _widthSlider = $( '.js_widget_width_slider' );
				var _sizeConfig = {
					width: themeConfig.simple_countdown.sizes[targetValue].width,
					height: themeConfig.simple_countdown.sizes[targetValue].height,
					maxWidth: 600,
					minWidth: 350
				};

				//set layout
				widgetNode.setAttribute( 'w-layout', themeConfig.simple_countdown.sizes[targetValue].layout );

				if ( targetValue !== 'custom' ) {
					$tabButtons.slideUp( "fast" );
					_widthSlider.slideUp( "fast" );
				} else {
					$tabButtons.slideDown( "fast" );
					_widthSlider.slideDown( "fast" );
					$( 'input:radio[name="w-layout"][value="vertical"]', $tabButtons )
						.prop( 'checked', true );

					_sizeConfig = { //default size
						width: themeConfig.simple_countdown.initSliderSize.width, //350
						height: themeConfig.simple_countdown.initSliderSize.height, //600
						maxWidth: themeConfig.simple_countdown.initSliderSize.maxWidth, //500
						minWidth: themeConfig.simple_countdown.initSliderSize.minWidth // 350
					};
					/*
					$widthController.slider( {
						setValue: _sizeConfig.width,
						max: _sizeConfig.maxWidth,
						min: _sizeConfig.minWidth
					} ).slider( 'refresh' );
					*/
				}

				widgetNode.setAttribute( 'w-width', _sizeConfig.width );
				widgetNode.setAttribute( 'w-height', _sizeConfig.height );
			}

			widgetNode.setAttribute( event.target.name, event.target.value ); //set attr in widget
            document.getElementById('w-width').value = widgetNode.getAttribute('w-width');
            document.getElementById('w-borderradius').value = widgetNode.getAttribute('w-borderradius');
			widget.update();

			windowScroll(); //recalculate widget container position
		};

		var resetWidget = function resetWidget( configForm, excludeOption ) {
			var widthSlider = $( '.js_widget_width_slider' ),
				widgetContainerWrapper = $( '.widget-container-wrapper' ),
				height = 600,
				theme = void 0,
				layout = void 0,
				$tabButtons = $( '.js-tab-buttons' );

			widgetContainerWrapper.removeAttr( 'style' );

			configForm.find( "input[type='text']" ).each( function () {
				var $self = $( this ),
					data = $self.data(),
					value = data.userAPIkey || data.defaultValue || '';

				if ( data.sliderValue ) {
					value = data.sliderValue;
					$self.slider( {
						setValue: value,
						max: data.sliderMax,
						min: data.sliderMin
					} ).slider( 'refresh' );
				} else {
					$self.val( value );
				}

				widgetNode.setAttribute( $self.attr( 'name' ), value );
			} );

			configForm.find( "input[type='radio']" ).each( function () {
				var $self = $( this );
				if ( $self.data( 'is-checked' ) ) {
					var name = $self.attr( 'name' ),
						val = $self.val();
					if ( name === 'w-theme' ) {
						theme = val;
					} else if ( name === 'w-layout' ) {
						layout = val;
					} else if ( name === 'w-proportion' ) {
						$tabButtons.slideDown( "fast" );
						widthSlider.slideDown( "fast" );
					}
					$self.prop( 'checked', true );
					widgetNode.setAttribute( $self.attr( 'name' ), val );
				}
			} );

			if ( typeof excludeOption !== 'undefined' && typeof excludeOption.id !== 'undefined' ) {
				widgetNode.setAttribute( 'w-id', excludeOption.id ); //set val in widget
				$( '#w-id' ).val( excludeOption.id ); //set val in cofigurator
			}

			$tabButtons.slideDown( "fast" );
			widthSlider.slideDown( "fast" );
			$("#js-layout-box").slideDown( "fast" );
			$(".double-margin-bottom").slideDown( "fast" );

			if ( layout === 'horizontal' ) {
				//height = getHeightByTheme(theme);
				height = 252;
			}
			widgetNode.setAttribute( 'w-height', height );


			widget.update();
		};

		var init = function init() {
			//sets the limits for the first load
			setLimits();

			//do one container move on load
			containerMove();

			// replace Api-Key if user logged
			replaceApiKey( {
				inputApiKey: $( '#w-tm-api-key' ),
				widgetNode: widgetNode,
				widget: widget
			} );
		};

		/**
		 * Events
		 */
		$configForm.on( "change", changeState );
		// Mobile devices. Force 'change' by 'Go' press

		$configForm.on( "submit", function ( e ) {
			$configForm.find( 'input:focus' ).trigger( 'blur' );
			e.preventDefault();
		} );

		/*set tooltip value above slider*/
		$configForm.find( "input[type='text']" ).each( function () {
			var $self = $( this );
			$self.data( 'default-value', $self.val() );
		} );

		$configForm.find( "input[type='radio']" ).each( function () {
			var $self = $( this );
          if ( $self.is( ':checked' ) ) {
            $self.data( 'is-checked', 'checked' );
          }
        } );


      /**
       * check if user logged just before enter widget page
		 */
		$window.on( 'login', function ( e, data ) {
			replaceApiKey( {
				userKey: data.key,
				inputApiKey: $( '#w-tm-api-key' ),
				widgetNode: widgetNode,
				widget: widget
			} );
		} );

		$( '.js_reset_widget' ).on( 'click', function () {
			resetWidget( $configForm );
		} );

		$( '#js_widget_modal__close' ).on( 'click', function () {
			$widgetModal.modal( 'hide' );
		} );

		$( '#js_widget_modal_no_code__close' ).on( 'click', function () {
			$widgetModalNoCode.modal( 'hide' );
		} );

		$( '#js_styling_nav_tab' ).on( 'shown.bs.tab', function ( e ) {
			$widthController.slider( 'relayout' );
			$borderRadiusController.slider( 'relayout' );
			windowScroll(); //recalculate widget container position
		} );

		/*tabs*/
		$('.nav-tabs').on('click', 'a', function(e){
			e.preventDefault();
			//sellf = e.target;
			$('.nav-tabs li').removeClass('active');
			$(this).parent().addClass('active');
			var active = $(this).parent().index();
			$(this).parent().parent().next().children().removeClass('in');
			$(this).parent().parent().next().children().removeClass('active');
			$(this).parent().parent().next().children().eq(active).addClass('in');
			$(this).parent().parent().next().children().eq(active).addClass('active');
		});

		document.getElementById('w-width').addEventListener('blur', function(e) {
			if(this.value < 350 || this.value > 1920) {
				this.value = 350;
				let widgetNode = document.querySelector("div[w-tmapikey]");
				widgetNode.setAttribute('w-width', '350');
				document.querySelector('.events-root-container').style.width = '350px';
				widget.update();
			}
		});

		document.getElementById('w-borderradius').addEventListener('blur', function(e) {
				if(this.value < 0 || this.value > 50) {
					this.value = 4;
					let widgetNode = document.querySelector("div[w-tmapikey]");
					widgetNode.setAttribute('w-borderradius', '4');
					widget.update();
				}
			});

		init();
	}
)( jQuery );

