var coreCalendarWidgetConfig =
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
      defaultApiKey = _ref.defaultApiKey;


  function getHeightByTheme(theme) {
    return theme === 'simple' ? 286 : 339;
  }

  function getBorderByTheme(theme) {
    switch (theme) {
      case 'simple':
        return 0;
        break;
      default:
        return 2;
    }
  }

  function getTmApiKey() {
    return document.getElementById('w-tm-api-key').value;
  }

  var widget = widgetsCalendar[0],
      weekScheduler = weekSchedulers[0],
      monthScheduler = monthSchedulers[0],
      yearScheduler = yearSchedulers[0],
      themeConfig = {
    sizes: {
      standart: {
        width: 298,
        height: 400,
        layout: 'vertical',
        border: 1
      }
    },
    initSliderSize: {
      width: 298,
      height: 330,
      maxWidth: 300,
      minWidth: 300
    }
  },
      isPostalCodeChanged = false;

  var $colorSchemeSelector = $('.widget__color_scheme_control');

  var changeState = function changeState(event) {
    if (!event.target.name || event.target.name === "w-googleapikey") return;
    var widgetNode = document.querySelector("div[w-tmapikey]"),
        cleanStyles = [document.querySelector(".tabs"), document.querySelector(".tabs-container"), document.querySelectorAll(".tab"), document.querySelectorAll(".tb"), document.querySelectorAll(".selector-title")],
        targetValue = event.target.value,
        targetName = event.target.name;

    if (targetName === "w-tm-api-key") {
      document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', targetValue);

      if (sessionStorage.getItem('tk-api-key')) {
        document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
        document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
      }
      if (document.getElementById('w-tm-api-key').value == '') {
        if (sessionStorage.getItem('tk-api-key')) {
          document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
          document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
        } else {
          document.getElementById('w-tm-api-key').value = defaultApiKey;
          document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', defaultApiKey);
        }
      }
    }

    if (targetName === "w-keyword") {
      isPostalCodeChanged = true;
      if (document.getElementById('w-keyword').value == '') {
        document.getElementById('w-postalcode').value = '90015';
        document.querySelector('[w-type="calendar"]').setAttribute('w-country', 'US');
        document.querySelector('[w-type="calendar"]').setAttribute('w-latlong', '34.0390107,-118.2672801');
      }
    }

    if (targetName === "w-postalcode") {
      widgetNode.setAttribute('w-country', '');
      isPostalCodeChanged = true;
      if (document.getElementById('w-keyword').value == '' && document.getElementById('w-postalcode').value == '') {
        document.getElementById('w-postalcode').value = '90015';
        document.querySelector('[w-type="calendar"]').setAttribute('w-country', 'US');
        document.querySelector('[w-type="calendar"]').setAttribute('w-latlong', '34.0390107,-118.2672801');
      }
      if (document.getElementById('w-postalcode').value.length <= 3) document.getElementById('w-postalcode').value = '90015';;
    }

    if (targetName === "w-radius") {
      if (document.getElementById('w-radius').value == '') document.getElementById('w-radius').value = '5';
    }

    if (targetName === "w-countryCode") {
      document.querySelector('[w-type="calendar"]').removeAttribute('w-latlong');
      if (widgetNode.getAttribute('w-countrycode') != targetValue) {
        document.getElementById("w-city").value = '';
        widgetNode.setAttribute('w-city', '');
        if (targetValue == 'US') {
          document.getElementById("w-city").value = 'Los Angeles';
          widgetNode.setAttribute('w-city', 'Los Angeles');
        }
      }
    }

    if (targetName === "w-city") {
      if (targetValue == '') {
        event.target.parentNode.classList.add("required");
        document.querySelector('.js_get_widget_code').classList.add('disabled');
        return;
      } else {
        event.target.parentNode.classList.remove("required");
        document.querySelector('.js_get_widget_code').classList.remove('disabled');
      }
    }

    if (targetName === "w-theme") {
      if (targetValue === 'simple') {
        $colorSchemeSelector.hide();
      } else {
        $colorSchemeSelector.show();
      }

      if (widgetNode.getAttribute('w-layout') === 'horizontal') {
        widgetNode.setAttribute('w-height', getHeightByTheme(targetValue));
      }
      widgetNode.setAttribute('w-border', getBorderByTheme(targetValue));
    }

    if (targetName === "w-colorscheme") {
      if (targetValue === 'custom') {
        $(".widget__color_scheme_custom").show();
      } else {
        $('.widget__color_scheme_custom').hide();
        widgetNode.removeAttribute('w-background');
        widgetNode.removeAttribute('w-textcolor');
        widgetNode.removeAttribute('w-bordercolor');
        widgetNode.removeAttribute('w-tabsbordercolor');
        widgetNode.removeAttribute('w-tabsbordercolor');
        widgetNode.removeAttribute('w-tabcolor');
        widgetNode.removeAttribute('w-tabbackground');
        widgetNode.removeAttribute('w-hovertabcolor');
        widgetNode.removeAttribute('w-hovertabbackground');
        widgetNode.removeAttribute('w-selectorcolorhover');
        widgetNode.removeAttribute('w-datesbackground');
        widgetNode.removeAttribute('w-datescolor');
        widgetNode.removeAttribute('w-datescolorhover');
        var customSheet = document.querySelector('div[w-type="calendar"]').getElementsByTagName('style')[0];
        if (customSheet != undefined) {
          customSheet.parentNode.removeChild(customSheet);
        }
      }
    }

    if (targetName === "w-background") {
      widgetNode.setAttribute('w-background', this.value);
    }

    if (targetName === "w-textcolor") {
      widgetNode.setAttribute('w-textcolor', this.value);
    }

    if (targetName === "w-bordercolor") {
      widgetNode.setAttribute('w-bordercolor', this.value);
    }

    if (targetName === "w-tabsbordercolor") {
      widgetNode.setAttribute('w-tabsbordercolor', this.value);
    }

    if (targetName === "w-tabcolor") {
      widgetNode.setAttribute('w-tabcolor', this.value);
    }

    if (targetName === "w-tabbackground") {
      widgetNode.setAttribute('w-tabbackground', this.value);
    }

    if (targetName === "w-hovertabcolor") {
      widgetNode.setAttribute('w-hovertabcolor', this.value);
    }

    if (targetName === "w-hovertabbackground") {
      widgetNode.setAttribute('w-hovertabbackground', this.value);
    }

    if (targetName === "w-selectorcolorhover") {
      widgetNode.setAttribute('w-selectorcolorhover', this.value);
    }

    if (targetName === "w-datesbackground") {
      widgetNode.setAttribute('w-datesbackground', this.value);
    }

    if (targetName === "w-datescolor") {
      widgetNode.setAttribute('w-datescolor', this.value);
    }

    if (targetName === "w-datescolorhover") {
      widgetNode.setAttribute('w-datescolorhover', this.value);
    }

    if (targetName === "w-layout") {
      var sizeConfig = themeConfig.initSliderSize;
      if (targetValue === 'horizontal') {
        sizeConfig = {
          width: 620,
          height: getHeightByTheme(widgetNode.getAttribute('w-theme')),
          maxWidth: 900,
          minWidth: 620
        };
      }

      widgetNode.setAttribute('w-width', sizeConfig.width);
      widgetNode.setAttribute('w-height', sizeConfig.height);
    }

    widgetNode.setAttribute(event.target.name, event.target.value);
    widget.update();
    var spinner = document.querySelector('.events-root-container .spinner-container');
    spinner.classList.add('hide');
    setTimeout(function () {
      weekScheduler.update();
      monthScheduler.update();
      yearScheduler.update();
    }, 500);
  };

  var resetWidget = function resetWidget(configForm) {
    var widgetNode = document.querySelector("div[w-tmapikey]"),
        radiusParam = document.querySelector("div[w-radius]"),
        height = 600,
        theme = void 0,
        layout = void 0;

    configForm.find("input[type='text'], input[type='number']").each(function () {
      var $self = $(this),
          data = $self.data(),
          value = data.defaultValue;
      $self.val(value);

      ["#w-countryCode", "#w-source"].map(function (item) {
        $(item).prop("selectedIndex", 0);
      });

      widgetNode.setAttribute($self.attr('name'), value);
      if ($self.attr('name') === 'w-tm-api-key') widgetNode.removeAttribute($self.attr('name'));
    });

    configForm.find("input[type='radio']").each(function () {
      var $self = $(this);
      if ($self.data('is-checked')) {
        var name = $self.attr('name'),
            val = $self.val();
        if (name === 'w-theme') {
          theme = val;
        } else if (name === 'w-layout') {
          layout = val;
        }
        $self.prop('checked', true);
        widgetNode.setAttribute($self.attr('name'), val);
      }
    });

    if (layout === 'horizontal') {
      height = getHeightByTheme(theme);
    }
    // widgetNode.setAttribute('w-height', height);
    widgetNode.setAttribute('w-height', '400');
    // widgetNode.setAttribute('w-border', 0);

    $('.country-select .js_custom_select').removeClass('custom_select-opened'); //reset custom select
    $('#w-country').children().remove().end().append('<option selected value="US">United States</option>');
    $('#w-country').attr('disabled', 'disabled');
    $('.custom_select__list li').removeClass('custom_select__item-active'); //reset custom select
    radiusParam.setAttribute('w-radius', '25');
    $('#w-tm-api-key').val(defaultApiKey); //set apikey
    widget.onLoadCoordinate();
    widget.update();
  };

  var $configForm = $(".main-widget-config-form");

  $configForm.on("change", changeState);
  // Mobile devices. Force 'change' by 'Go' press
  $configForm.on("submit", function (e) {
    $configForm.find('input:focus').trigger('blur');
    e.preventDefault();
  });

  $configForm.find("input[type='text'], input[type='number']").each(function () {
    var $self = $(this);
    $self.data('default-value', $self.val());
  });

  $configForm.find("input[type='radio']").each(function () {
    var $self = $(this);
    if ($self.is(':checked')) $self.data('is-checked', 'checked');
  });

  if (sessionStorage.getItem('tk-api-key')) {
    document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
    document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
  }
  if (document.getElementById('w-tm-api-key').value == '') {
    if (sessionStorage.getItem('tk-api-key')) {
      document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
      document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
    } else {
      document.getElementById('w-tm-api-key').value = defaultApiKey;
      document.querySelector('[w-type="calendar"]').setAttribute('w-tmapikey', defaultApiKey);
    }
  }

  $('.js_reset_widget').on('click', function () {
    resetWidget($configForm);
  });

  $('.js_widget__number').on('change', function (e) {
    var $self = $(this),
        val = $self.val().trim(),
        max = parseInt($self.attr('max')),
        min = parseInt($self.attr('min')),
        required = !!$self.attr('required'),
        regNumberOrEmpty = /^(\s*|\d+)$/,
        errorCssClass = 'error';

    // if(val === '') $self.val('');

    if (max && val > max || min && val < min || required && val === '' || !regNumberOrEmpty.test(val)) {
      $self.addClass(errorCssClass);
      e.preventDefault();
      e.stopPropagation();
    } else {
      $self.removeClass(errorCssClass);
    }
  });

  $('.widget__location span').on('click', function () {
    $('.widget__location').addClass('hidn');
    $('.widget__latlong').removeClass('hidn');
    document.getElementById('h-countryCode').value = document.getElementById('w-countryCode').value;
    document.getElementById('h-city').value = document.getElementById('w-city').value;
    document.getElementById('w-latlong').value = document.getElementById('h-latlong').value;
    widget.config.latlong = document.getElementById('w-latlong').value.replace(/\s+/g, '');
    document.querySelector('[w-type="calendar"]').setAttribute('w-latlong', widget.config.latlong);
    document.querySelector('[w-type="calendar"]').removeAttribute('w-countrycode');
    document.querySelector('[w-type="calendar"]').removeAttribute('w-city');
    widget.config.countrycode = '';
    widget.config.postalcode = '';
    widget.config.city = '';
    widget.update();
    var spinner = document.querySelector('.events-root-container .spinner-container');
    spinner.classList.add('hide');
    setTimeout(function () {
      weekScheduler.update();
      monthScheduler.update();
      yearScheduler.update();
    }, 500);
  });

  $('.widget__latlong span').on('click', function () {
    $('.widget__latlong').addClass('hidn');
    $('.widget__location').removeClass('hidn');
    document.getElementById('h-latlong').value = document.getElementById('w-latlong').value.replace(/\s+/g, '');
    document.getElementById('w-latlong').value = '';
    document.querySelector('[w-type="calendar"]').removeAttribute('w-latlong');
    document.getElementById('w-countryCode').value = document.getElementById('h-countryCode').value;
    document.getElementById('w-city').value = document.getElementById('h-city').value;
    widget.config.countrycode = document.getElementById('w-countryCode').value;
    widget.config.city = document.getElementById('w-city').value;
    document.querySelector('[w-type="calendar"]').setAttribute('w-countrycode', widget.config.countrycode);
    document.querySelector('[w-type="calendar"]').setAttribute('w-city', widget.config.city);
    widget.config.latlong = '';
    widget.update();
    var spinner = document.querySelector('.events-root-container .spinner-container');
    spinner.classList.add('hide');
    setTimeout(function () {
      weekScheduler.update();
      monthScheduler.update();
      yearScheduler.update();
    }, 500);
  });

  widget.onLoadCoordinate = function (results) {
    var countryShortName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';

    widget.config['country'] = countryShortName;
    if (isPostalCodeChanged) {
      isPostalCodeChanged = false;

      var $countrySelect = $('#w-country'),
          $ul = $("#w-country .js_widget_custom__list"),
          options = "<option selected value=''>All</option>";

      $countrySelect.html('');
      $ul.html(''); //clear custom select list
      $countrySelect.prop('disabled', !results);

      if (results) {
        var status = void 0;
        if (results.length <= 1) status = true;else status = false;
        $countrySelect.prop('disabled', status);
        // $countrySelect.prop('disabled', !results.length);
        options = '';
        for (var i in results) {
          var result = results[i];
          if (result.address_components) {
            var country = result.address_components[result.address_components.length - 1];
            if (country) {
              var isSelected = country.short_name === countryShortName ? 'selected' : '';
              options += '<option ' + isSelected + ' value="' + country.short_name + '">' + country.long_name + '</option>';
            }
          }
        }
      }

      $countrySelect.append(options);
      addCustomList($ul, '#w-country', countryShortName);
    }
  };

  function addCustomList(listWrapperElement, listWrapperId, activeVal) {
    var $listOption = $(listWrapperId).find('option'),
        //update list
    $placeholder = $(".country-select").find(".custom_select__placeholder"),

    // $ul = listWrapperElement;
    $ul = $('.country-select .custom_select__list');

    $placeholder.val($listOption.html());

    $($ul).html('');

    $listOption.each(function () {
      var data = {
        value: $(this).val()
      };
      $ul.append('<li class="custom_select__item ' + (activeVal === data.value ? 'custom_select__item-active' : '') + '" data-value="' + data.value + '">' + $(this).text() + '</li>');
    });
  }

  document.getElementById('w-borderradius').addEventListener('blur', function (e) {
    if (this.value < 0 || this.value > 50) {
      this.value = 4;
      var widgetNode = document.querySelector("div[w-tmapikey]");
      widgetNode.setAttribute('w-borderradius', '4');
      widget.update();
    }
  });

  $('input.color-picker').minicolors();
};

/***/ })
/******/ ]);
//# sourceMappingURL=core-calendar-widget-config.js.map