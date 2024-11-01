var coreCountdownWidgetConfig =
/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

exports.default = function (_ref) {
  var $ = _ref.jQuery,
      onChangeState = _ref.onChangeState;

  onChangeState = onChangeState || function () {};

  var DEFAULT_BORDER_RADIUS = 4;
  var DEFAULT_WIDTH = 300;

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

  var $getCodeButton = $('.js_get_widget_code');
  var widgetNode = document.querySelector("div[w-tmapikey]");
  var $tabButtons = $('.js-tab-buttons');
  var $layoutBox = $('#js-layout-box');
  var $configForm = $(".main-widget-config-form");
  var $widgetModal = $('#js_widget_modal');
  var $widgetModalNoCode = $('#js_widget_modal_no_code');

  //variables for fixed widget
  var $window = $(window);
  var $containerWidget = $(".widget-container-wrapper");
  var $configBlock = $(".config-block");
  var desktopWidth = 1200;
  var threshold_offset = 50;

  var window_min = 0;
  var window_max = 0;
  /*
   set the container's maximum and minimum limits as well as movement thresholds
   */
  function setLimits() {
    //max and min container movements
    var topCss = $containerWidget.css("top") > 0 ? parseInt($containerWidget.css("top")) : 0;
    var headerOffset = $('.top-bar').height() + /*padding of top-bar*/8 + /*bottom-margin*/10;
    var max_move = $configBlock.offset().top + $configBlock.height() - $containerWidget.height() - topCss - headerOffset;
    var min_move = $configBlock.offset().top - headerOffset;

    $containerWidget.data('min', min_move).data('max', max_move);

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
      if ($window.scrollTop() >= window_min && $window.scrollTop() < window_max) {
        if ($containerWidget.height() < $configBlock.height() && innerWidth >= desktopWidth) {
          //reset the limits (optional)
          setLimits();
          //move the container
          containerMove();
        }
      }
      j++;
    }
    if (j === 0) updateScroll();

    setTimeout(function () {
      if (innerWidth < desktopWidth && $containerWidget.height() > $configBlock.height()) {
        containerMove_clearOffset();
        updateScroll();
      }
      if ($containerWidget.height() < $configBlock.height() || innerWidth >= desktopWidth) {
        if (innerWidth < desktopWidth) {
          containerMove_clearOffset();
        }
        updateScroll();
      }
    }, 200);
  }

  $window.on("scroll resize", windowScroll);

  /**
   * Clear top offset of widget container
   */
  function containerMove_clearOffset() {
    $containerWidget.css("margin-top", 0);
  }
  /**
   * Handles moving the container if needed.
   **/
  function containerMove() {
    var marginTop = 0;
    var windowScrollTop = $window.scrollTop();

    var _$containerWidget$dat = $containerWidget.data(),
        min = _$containerWidget$dat.min,
        max = _$containerWidget$dat.max;

    //if the window scroll is within the min and max (the container will be 'sticky';


    if (windowScrollTop >= min && windowScrollTop <= max) {
      //if the window scroll is below the minimum move it down!
      marginTop = windowScrollTop - min;
    } else if (windowScrollTop > max) {
      marginTop = max - min;
    }
    $containerWidget.css('marginTop', marginTop > 0 ? marginTop : 0);
  }

  /**
   * Toggle 'width slider' and width
   * @param targetValue(string) -
   * @param widgetNode(object) - current widget
   */
  function fullWidth(targetValue, widgetNode) {
    var widthSlider = $('.js_widget_width_slider');
    var widgetContainerWrapper = $containerWidget;
    var widgetContainer = $(".widget-container", widgetContainerWrapper);
    var $border_slider = $('.js_widget_border_slider');

    if (targetValue === 'fullwidth') {
      widthSlider.slideUp("fast");
      // $borderRadiusController.slider('setValue', 0);
      widgetContainerWrapper.css({ width: "100%" });
      widgetContainer.css({ width: '100%' });
      // widgetNode.setAttribute('w-height', 700);
    } else {
      $border_slider.slideDown("fast");
      // $borderRadiusController.slider('setValue', 4);
      widgetContainerWrapper.css({ width: 'auto' });
      widgetContainer.css({ width: 'auto' });
      if (targetValue === 'custom') {
        widthSlider.slideDown("fast");
      }
      //resetWidget($configForm );
    }
  };

  function changeState(event) {
    if (!event.target.name) {
      return;
    }
    var targetValue = event.target.value;
    var targetName = event.target.name;

    if (targetName === "w-layout") {
      var sizeConfig = themeConfig.simple_countdown.initSliderSize;

      if (targetValue === 'horizontal') {
        sizeConfig = {
          width: 620,
          height: 252,
          maxWidth: 900,
          minWidth: 620
        };
      }

      widgetNode.setAttribute('w-width', sizeConfig.width);
      widgetNode.setAttribute('w-height', sizeConfig.height);
      document.getElementById('w-width').value = sizeConfig.width;
    }

    //Check fixed sizes for 'simple_countdown' theme
    if (targetName === "w-proportion") {
      var widthSlider = $('.js_widget_width_slider'); //if init it on top -> then see bug on Vertical/Horizontal layout change
      var _sizeConfig = {
        width: themeConfig.simple_countdown.sizes[targetValue].width,
        height: themeConfig.simple_countdown.sizes[targetValue].height,
        maxWidth: 600,
        minWidth: 350
      };

      fullWidth(targetValue, widgetNode);

      //set layout
      widgetNode.setAttribute('w-layout', themeConfig.simple_countdown.sizes[targetValue].layout);

      if (targetValue !== 'custom') {
        $tabButtons.slideUp("fast");
        widthSlider.slideUp("fast");
      } else {
        $tabButtons.slideDown("fast");
        widthSlider.slideDown("fast");
        $('input:radio[name="w-layout"][value="vertical"]', $tabButtons).prop('checked', true);

        _sizeConfig = { //default size
          width: themeConfig.simple_countdown.initSliderSize.width, //350
          height: themeConfig.simple_countdown.initSliderSize.height, //600
          maxWidth: themeConfig.simple_countdown.initSliderSize.maxWidth, //500
          minWidth: themeConfig.simple_countdown.initSliderSize.minWidth // 350
        };
      }

      widgetNode.setAttribute('w-width', _sizeConfig.width);
      document.getElementById('w-width').value = _sizeConfig.width;
      widgetNode.setAttribute('w-height', _sizeConfig.height);
    }

    onChangeState({ targetName: targetName });

    widgetNode.setAttribute(event.target.name, event.target.value); //set attr in widget

    widget.update();
    windowScroll(); //recalculate widget container position
  };

  function resetWidget(configForm, excludeOption) {
    var widthSlider = $('.js_widget_width_slider');
    var widgetContainerWrapper = $('.widget-container-wrapper');
    var $tabButtons = $('.js-tab-buttons');
    var height = 600;
    var theme = void 0;
    var layout = void 0;

    widgetContainerWrapper.removeAttr('style');

    configForm.find("input[type='text']").each(function () {
      var $self = $(this);
      var data = $self.data();
      var value = data.userAPIkey || data.defaultValue || '';

      if (data.sliderValue) {
        value = data.sliderValue;
        $self.slider({
          setValue: value,
          max: data.sliderMax,
          min: data.sliderMin
        }).slider('refresh');
      } else {
        $self.val(value);
      }

      widgetNode.setAttribute($self.attr('name'), value);
    });

    configForm.find("input[type='radio']").each(function () {
      var $self = $(this);
      if ($self.data('is-checked')) {
        var name = $self.attr('name');
        var val = $self.val();

        if (name === 'w-theme') {
          theme = val;
        } else if (name === 'w-layout') {
          layout = val;
        } else if (name === 'w-proportion') {
          $layoutBox.slideDown("fast");
          $tabButtons.slideDown("fast");
          widthSlider.slideDown("fast");
        }
        $self.prop('checked', true);
        widgetNode.setAttribute($self.attr('name'), val);
      }
    });

    if (typeof excludeOption !== 'undefined' && typeof excludeOption.id !== 'undefined') {
      widgetNode.setAttribute('w-id', excludeOption.id); //set val in widget
      $('#w-id').val(excludeOption.id); //set val in cofigurator
    }
    $layoutBox.slideDown("fast");
    $tabButtons.slideDown("fast");
    widthSlider.slideDown("fast");

    if (layout === 'horizontal') {
      height = 252;
    }
    widgetNode.setAttribute('w-height', height);
    widgetNode.setAttribute('w-width', DEFAULT_WIDTH);

    document.getElementById('w-borderradius').value = DEFAULT_BORDER_RADIUS;
    widgetNode.setAttribute('w-borderradius', DEFAULT_BORDER_RADIUS);

    widget.update();
  };

  function init() {
    //sets the limits for the first load
    setLimits();

    //do one container move on load
    containerMove();
  };

  /**
   * Events
   */
  function addEvents() {

    $configForm.on("change", changeState);
    // Mobile devices. Force 'change' by 'Go' press

    $configForm.on("submit", function (e) {
      $configForm.find('input:focus').trigger('blur');
      e.preventDefault();
    });

    /*set tooltip value above slider*/
    $configForm.find("input[type='text']").each(function () {
      var $self = $(this);
      $self.data('default-value', $self.val());
    });

    $configForm.find("input[type='radio']").each(function () {
      var $self = $(this);
      if ($self.is(':checked')) $self.data('is-checked', 'checked');
    });

    $('.js_reset_widget').on('click', function () {
      resetWidget($configForm);
    });

    $('#js_widget_modal__close').on('click', function () {
      $widgetModal.modal('hide');
    });

    $('#js_widget_modal_no_code__close').on('click', function () {
      $widgetModalNoCode.modal('hide');
    });

    $('#js_styling_nav_tab').on('shown.bs.tab', function (e) {
      /* $widthController.slider('relayout'); */
      /* $borderRadiusController.slider('relayout'); */
      windowScroll(); //recalculate widget container position
    });

    document.getElementById('w-width').addEventListener('blur', function (e) {
      if (this.value < 350 || this.value > 1920) {
        this.value = 350;
        var _widgetNode = document.querySelector("div[w-tmapikey]");
        _widgetNode.setAttribute('w-width', '350');
        document.querySelector('.events-root-container').style.width = '350px';
        widget.update();
      }
    });

    document.getElementById('w-borderradius').addEventListener('blur', function (e) {
      if (this.value < 0 || this.value > 50) {
        this.value = 4;
        var _widgetNode2 = document.querySelector("div[w-tmapikey]");
        _widgetNode2.setAttribute('w-borderradius', '4');
        widget.update();
      }
    });
  }

  addEvents();

  init();
};

/***/ })
/******/ ]);
//# sourceMappingURL=core-countdown-widget-config.js.map