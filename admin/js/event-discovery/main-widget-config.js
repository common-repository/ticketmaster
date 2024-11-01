(function ( $ ) {

  'use strict';

  const ATTRIBUTE_NAMES = {
    ID: 'w-id',
    WIDGET_TYPE: 'w-type',
    DEFAULT_VALUE: 'data-default-value',
    WIDGET_THEME: 'w-theme',
    WIDGET_LAYOUT: 'w-layout',
    WIDGET_HEIGHT: 'w-height',
    WIDGET_BORDER: 'w-border',
    WIDGET_EVENTS_PERIOD: 'w-period',
    WIDGET_EVENTS_DATE_FROM: 'w-startdatetime',
    WIDGET_EVENTS_DATE_TO: 'w-enddatetime',

    TITLE_COLOR: 'w-titleColor',
    TITLE_HOVER_COLOR: 'w-titleHoverColor',
    ARROW_COLOR: 'w-arrowColor',
    ARROW_HOVER_COLOR: 'w-arrowHoverColor',
    EVENT_DATE_COLOR: 'w-dateColor',
    EVENT_DESCRIPTION_COLOR: 'w-descriptionColor',
    EVENTS_COUNTER_COLOR: 'w-counterColor',
    BORDER_COLOR: 'w-bordercolor',
    BACKGROUND_COLOR: 'w-backgroundcolor'
  };

  const ATTRIBUTE_VALUES = {
    WIDGET_THEME: {
      SIMPLE: 'simple',
      OLD_SCHOOL: 'oldschool',
      NEW_SCHOOL: 'newschool',
      LIST_VIEW: 'listview',
      LIST_VIEW_THUMBNAILS: 'listviewthumbnails',
    },
    WIDGET_LAYOUT: {
      HORIZONTAL: 'horizontal'
    },
    WIDGET_EVENTS_PERIOD: {
      CUSTOM: 'custom'
    }
  };

  const CUSTOM_THEME_ATTRIBUTES = [
    ATTRIBUTE_NAMES.TITLE_COLOR,
    ATTRIBUTE_NAMES.TITLE_HOVER_COLOR,
    ATTRIBUTE_NAMES.ARROW_COLOR,
    ATTRIBUTE_NAMES.ARROW_HOVER_COLOR,
    ATTRIBUTE_NAMES.EVENT_DATE_COLOR,
    ATTRIBUTE_NAMES.EVENT_DESCRIPTION_COLOR,
    ATTRIBUTE_NAMES.EVENTS_COUNTER_COLOR,
    ATTRIBUTE_NAMES.BORDER_COLOR,
    ATTRIBUTE_NAMES.BACKGROUND_COLOR
  ];

  const AVAILABLE_CUSTOM_FIELDS_FOR_THEME = {
    'simple': without(CUSTOM_THEME_ATTRIBUTES, ATTRIBUTE_NAMES.BACKGROUND_COLOR),
    'oldschool': CUSTOM_THEME_ATTRIBUTES,
    'newschool': CUSTOM_THEME_ATTRIBUTES,
    'listview': without(CUSTOM_THEME_ATTRIBUTES, ATTRIBUTE_NAMES.ARROW_COLOR, ATTRIBUTE_NAMES.ARROW_HOVER_COLOR),
    'listviewthumbnails': without(CUSTOM_THEME_ATTRIBUTES, ATTRIBUTE_NAMES.ARROW_COLOR, ATTRIBUTE_NAMES.ARROW_HOVER_COLOR)
  };

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

  function getGooleApiKey(code) {
    return code || "AIzaSyBQrJ5ECXDaXVlICIdUBOe8impKIGHDzdA";
  }

  var widget = widgetsLib.widgetsEventDiscovery[0],
      themeConfig = {
    sizes: {
      s: {
        width: 160,
        height: 300,
        layout: 'horizontal'
      },
      m: {
        width: 300,
        height: 250,
        layout: 'vertical'
      },
      l: {
        width: 160,
        height: 300,
        layout: 'horizontal'
      },
      xl: {
        width: 160,
        height: 300,
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
      }
    },
    initSliderSize: {
      width: 350,
      height: 600,
      maxWidth: 500,
      minWidth: 350
    }
  },
      isPostalCodeChanged = false;

  const $darkSchemeSelector = $('.widget__dark-theme-selector');
  const $customColorSchemeSelector = $('.widget__color_scheme_custom');
  const widgetNode = document.querySelector('div[w-type="event-discovery"]');
  const $customDatesWrapper = $('.custom-dates-wrapper');

  var selectedColorTheme = ATTRIBUTE_VALUES.WIDGET_THEME.SIMPLE;


  $('#js_styling_nav_tab').on('shown.bs.tab', function (e) {
    windowScroll(); //recalculate widget container position
  });

  //variables for fixed widget
  var $window = $(window),
      $containerWidget = $(".widget-container-wrapper"),
      $configBlock = $(".config-block"),
      window_min = 0,
      window_max = 0,
      desktopWidth = 1200,
      threshold_offset = 50;
  /*
   set the container's maximum and minimum limits as well as movement thresholds
   */
  function setLimits() {
    //max and min container movements
    var topCss = $containerWidget.css("top") > 0 ? parseInt($containerWidget.css("top")) : 0;
    var headerOffset = $('.top-bar').height() + /*padding of top-bar*/8 + /*bottom-margin*/10;
    var max_move = $configBlock.offset().top + $configBlock.height() - $containerWidget.height() - topCss - headerOffset;
    var min_move = $configBlock.offset().top - headerOffset;

    $containerWidget.attr("data-min", min_move).attr("data-max", max_move);
    //window thresholds so the movement isn't called when its not needed!
    window_min = min_move - threshold_offset;
    window_max = max_move + $containerWidget.height() + threshold_offset;
  }
  //sets the limits for the first load
  setLimits();

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

  $window.on("scroll load resize", windowScroll);

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
        var wst = $window.scrollTop(),
            _$containerWidget$dat = $containerWidget.data(),
            min = _$containerWidget$dat.min - 30,
            max = _$containerWidget$dat.max;
        
        //if the window scroll is within the min and max (the container will be 'sticky';
        if (wst >= min && wst <= max) {
            //if the window scroll is below the minimum move it down!
            marginTop = wst - min;
        } else if (wst > max) {
            marginTop = max - min;
        }
        $containerWidget.css('marginTop', marginTop > 0 ? marginTop : 0);
    }
    //do one container move on load
    containerMove();

  var replaceApiKey = function replaceApiKey(options) {
    var userKey = options.userKey || sessionStorage.getItem('tk-api-key');

    if (userKey !== null) {
      var inputApiKey = options.inputApiKey;
      var widgetNode = options.widgetNode;
      var _widget = options.widget;

      inputApiKey.attr('value', userKey).val(userKey);
      widgetNode.setAttribute("w-tm-api-key", userKey);
      _widget.update();
    }
  };
  replaceApiKey({
    inputApiKey: $('#w-tm-api-key'),
    widgetNode: document.querySelector("div[w-tmapikey]"),
    widget: widget
  });

  /**
   * check if user logged just before enter widget page
   */
  $window.on('login', function (e, data) {
    replaceApiKey({
      userKey: data.key,
      inputApiKey: $('#w-tm-api-key'),
      widgetNode: document.querySelector("div[w-tmapikey]"),
      widget: widget
    });
  });

  function handleCustomColorSchemeClick(event) {
    if (event.target.name === 'w-colorscheme') {
      if (event.target.value === 'custom') {
        $customColorSchemeSelector.show();
      } else {
        $customColorSchemeSelector.hide();
        clearCustomStyles();
        resetCustomColorInputs();
      }
    }
  }

  function resetCustomColorInputs() {
    CUSTOM_THEME_ATTRIBUTES.forEach(function (custom) {
      var $customColorInput = $('#' + custom);
      $customColorInput.minicolors('value', $customColorInput.attr(_attributeNames.ATTRIBUTE_NAMES.DEFAULT_VALUE));
    });
  }

  function handleCustomFieldClick(event) {
    var widgetNode = document.querySelector('div[w-type="event-discovery"]');
    var _event$target = event.target,
        targetName = _event$target.name,
        targetValue = _event$target.value;

    CUSTOM_THEME_ATTRIBUTES.forEach(function (themeAttribute) {
      if (targetName === themeAttribute) {
        widgetNode.setAttribute(themeAttribute, targetValue);
      }
    });
  }

  function clearCustomStyles() {
    var widgetNode = document.querySelector('div[w-type="event-discovery"]');
    var customSheet = widgetNode.getElementsByTagName('style')[0];

    CUSTOM_THEME_ATTRIBUTES.forEach(function (customAttribute) {
      return widgetNode.removeAttribute(customAttribute);
    });

    if (customSheet !== undefined) {
      customSheet.parentNode.removeChild(customSheet);
    }
  }

  function handleThemeClick(_ref) {
    var _ref$target = _ref.target,
        targetName = _ref$target.name,
        newTheme = _ref$target.value;

    if (targetName === ATTRIBUTE_NAMES.WIDGET_THEME) {
      if (newTheme === ATTRIBUTE_VALUES.WIDGET_THEME.SIMPLE) {
        $darkSchemeSelector.hide();
      } else {
        $darkSchemeSelector.show();
      }

      if (widgetNode.getAttribute(ATTRIBUTE_NAMES.WIDGET_LAYOUT) === ATTRIBUTE_VALUES.WIDGET_LAYOUT.HORIZONTAL) {
        widgetNode.setAttribute(ATTRIBUTE_NAMES.WIDGET_HEIGHT, getHeightByTheme(newTheme));
      }
      widgetNode.setAttribute(ATTRIBUTE_NAMES.WIDGET_BORDER, getBorderByTheme(newTheme));

      updateCustomColorFields(selectedColorTheme, newTheme);
      selectedColorTheme = newTheme;
    }
  }

  function updateCustomColorFields(oldTheme, newTheme) {
    var currentCustomFieldsForTheme = AVAILABLE_CUSTOM_FIELDS_FOR_THEME[oldTheme];
    var newCustomFieldsForTheme = AVAILABLE_CUSTOM_FIELDS_FOR_THEME[newTheme];
    var fieldsToRemove = difference(currentCustomFieldsForTheme, newCustomFieldsForTheme);
    var fieldsToAdd = difference(newCustomFieldsForTheme, currentCustomFieldsForTheme);

    fieldsToRemove.forEach(function (field) {
      $('#' + field + '-container').hide();
      widgetNode.removeAttribute(field);
    });
    fieldsToAdd.forEach(function (field) {
      $('#' + field + '-container').show();
    });
  }

  function handlePeriodClick(_ref2) {
    var _ref2$target = _ref2.target,
        targetName = _ref2$target.name,
        newDatePeriod = _ref2$target.value;

    if (targetName === ATTRIBUTE_NAMES.WIDGET_EVENTS_PERIOD) {
      if (newDatePeriod === ATTRIBUTE_VALUES.WIDGET_EVENTS_PERIOD.CUSTOM) {
        $customDatesWrapper.show();
      } else {
        $customDatesWrapper.hide();
        [ATTRIBUTE_NAMES.WIDGET_EVENTS_DATE_FROM, ATTRIBUTE_NAMES.WIDGET_EVENTS_DATE_TO].forEach(function (attr) {
          widgetNode.removeAttribute(attr);
          $('#' + attr).val('');
        });
      }
    }
  }

  var changeState = function changeState(event) {
    if (!event.target.name || event.target.name === "w-googleapikey") return;

    var widgetNode = document.querySelector("#widget-constructor div[w-tmapikey]"),
        targetValue = event.target.value,
        targetName = event.target.name,
        $tabButtons = $('.js-tab-buttons');

    if (targetName === "w-tm-api-key") {
      document.querySelector('[w-type="event-discovery"]').setAttribute('w-tmapikey', targetValue);

      if (sessionStorage.getItem('tk-api-key')) {
          document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
          document.querySelector('[w-type="event-discovery"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
        }
      if (document.getElementById('w-tm-api-key').value == '') {
          if (sessionStorage.getItem('tk-api-key')) {
            document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
            document.querySelector('[w-type="event-discovery"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
          } 
          else {
            document.getElementById('w-tm-api-key').value = 'pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz';
            document.querySelector('[w-type="event-discovery"]').setAttribute('w-tmapikey', 'pLOeuGq2JL05uEGrZG7DuGWu6sh2OnMz');
          }
       }
    }

    if (targetName === "w-postalcode") {
      widgetNode.setAttribute('w-country', '');
      isPostalCodeChanged = true;
    }

    if (targetName === "w-size") {
      if (parseInt(event.target.value) > 100) event.target.value = "25";
    }

    if (targetName === "w-countryCode") {
        if (widgetNode.getAttribute('w-countrycode') != targetValue) {
            document.getElementById("w-city").value = '';
            widgetNode.setAttribute('w-city', '');
        }
    }


    handleCustomColorSchemeClick(event);
    handleCustomFieldClick(event);
    handleThemeClick(event);
    handlePeriodClick(event);

    if (targetName === "w-theme") {
      if (targetValue === 'simple') {
        $darkSchemeSelector.hide();
      } else {
        $darkSchemeSelector.show();
      }

      if (widgetNode.getAttribute('w-layout') === 'horizontal') {
        widgetNode.setAttribute('w-height', getHeightByTheme(targetValue));
      }
      widgetNode.setAttribute('w-border', getBorderByTheme(targetValue));
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

    //Check fixed sizes for 'simple' theme
    if (targetName === "w-proportion") {
      var widthSlider = $('.js_widget_width_slider');
      var _sizeConfig = {
        width: themeConfig.sizes[targetValue].width,
        height: themeConfig.sizes[targetValue].height,
        maxWidth: 600,
        minWidth: 350
      };

      //set layout
      widgetNode.setAttribute('w-layout', themeConfig.sizes[targetValue].layout);

      if (targetValue !== 'custom') {
        $tabButtons.slideUp("fast");
        widthSlider.slideUp("fast");
      } else {
        $tabButtons.slideDown("fast");
        widthSlider.slideDown("fast");
        $('input:radio[name="w-layout"][value="vertical"]', $tabButtons).prop('checked', true);

        _sizeConfig = { //default size
          width: themeConfig.initSliderSize.width, //350
          height: themeConfig.initSliderSize.height, //600
          maxWidth: themeConfig.initSliderSize.maxWidth, //500
          minWidth: themeConfig.initSliderSize.minWidth // 350
        };
      }

      widgetNode.setAttribute('w-width', _sizeConfig.width);
      widgetNode.setAttribute('w-height', _sizeConfig.height);
    }

    widgetNode.setAttribute(event.target.name, event.target.value);
    document.getElementById('w-width').value = widgetNode.getAttribute('w-width');
    document.getElementById('w-borderradius').value = widgetNode.getAttribute('w-borderradius');
    widget.update();

    windowScroll(); //recalculate widget container position
  };

  var resetWidget = function resetWidget(configForm) {
    var widgetNode = document.querySelector("div[w-tmapikey]"),
        height = 600,
        theme = void 0,
        layout = void 0;
    var widthSlider = $('.js_widget_width_slider'),
        $tabButtons = $('.js-tab-buttons');

    configForm.find("input[type='text'], input[type='number']").each(function () {
      var $self = $(this),
          data = $self.data(),
          value = data.defaultValue;

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
        var name = $self.attr('name'),
            val = $self.val();
        if (name === 'w-theme') {
          theme = val;
        } else if (name === 'w-layout') {
          layout = val;
        } else if (name === 'w-proportion') {
          $tabButtons.slideDown("fast");
          widthSlider.slideDown("fast");
        }
        $self.prop('checked', true);
        widgetNode.setAttribute($self.attr('name'), val);
      }
    });

    if (layout === 'horizontal') {
      height = getHeightByTheme(theme);
    }
    widgetNode.setAttribute('w-height', height);
    widgetNode.setAttribute('w-border', 0);
    $('.widget__color_scheme_control').css('display', 'none');

    $('.country-select .js_custom_select').removeClass('custom_select-opened'); //reset custom select
    $('#w-country').children().remove().end().append('<option selected value="US">United States</option>');
    $('#w-country').attr('disabled', 'disabled');
    widget.onLoadCoordinate();
    widget.update();
  };

  var $configForm = $(".main-widget-config-form"),
      $widgetModal = $('#js_widget_modal'),
      $widgetModalNoCode = $('#js_widget_modal_no_code');

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

  $('.js_get_widget_code').on('click', function () {
    var codeCont = document.querySelector(".language-html.widget_dialog__code");
    var htmlCode = document.createElement("div");
    for (var key in widget.config) {
      if (key !== 'latlong') {
        htmlCode.setAttribute("w-" + key, widget.config[key]);
      }
    }
    // Use only Key from config form
    htmlCode.setAttribute('w-googleapikey', getGooleApiKey());
    var tmp = document.createElement("div");
    tmp.appendChild(htmlCode);
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

  $('#w-radius').on('blur', function (e) {
    if (parseInt($(this).val()) >= 19999) $(this).val('19999');
    if (parseInt($(this).val()) <= 0) $(this).val('25');
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

  widget.onLoadCoordinate = function (results) {
    var countryShortName = arguments.length <= 1 || arguments[1] === undefined ? '' : arguments[1];

    widget.config['country'] = countryShortName;
    if (isPostalCodeChanged) {
      isPostalCodeChanged = false;

      var $countrySelect = $('#w-country'),
          $ul = $(".js_widget_custom__list"),
          options = "<option selected value=''>All</option>";

      $countrySelect.html('');
      $ul.html(''); //clear custom select list
      $countrySelect.prop('disabled', !results);
      if (results) {
        $countrySelect.prop('disabled', !results.length);
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
        $ul = listWrapperElement;

    $placeholder.val($listOption.html());

    $listOption.each(function () {
      var data = {
        value: $(this).val()
      };
      $ul.append('<li class="custom_select__item ' + (activeVal === data.value ? 'custom_select__item-active' : '') + '" data-value="' + data.value + '">' + $(this).text() + '</li>');
    });
  }

    $('#js_widget_modal_map__open').on('click', function (e) {
        e.preventDefault();
    });

    $('#js_widget_modal_map__close').on('click', function () {
        document.querySelector('[w-type="event-discovery"]').setAttribute('w-latlong', document.getElementById('w-latlong').value.replace(/\s+/g, ''));
        widget.update();
    });

    $('.widget__location span').on('click', function () {
        $('.widget__location').addClass('hidn');
        $('.widget__latlong').removeClass('hidn');
        document.getElementById('h-countryCode').value = document.getElementById('w-countryCode').value;
        document.getElementById('h-postalcode').value = document.getElementById('w-postalcode').value;
        document.getElementById('h-city').value = document.getElementById('w-city').value;
        document.getElementById('w-latlong').value = document.getElementById('h-latlong').value;
        widget.config.latlong = document.getElementById('w-latlong').value.replace(/\s+/g, '');
        document.querySelector('[w-type="event-discovery"]').setAttribute('w-latlong', widget.config.latlong);
        document.querySelector('[w-type="event-discovery"]').removeAttribute('w-countrycode');
        document.querySelector('[w-type="event-discovery"]').removeAttribute('w-postalcode');
        document.querySelector('[w-type="event-discovery"]').removeAttribute('w-city');
        widget.config.countrycode = '';
        widget.config.postalcode = '';
        widget.config.city = '';
        widget.update();
    });

    $('.widget__latlong span').on('click', function () {
        $('.widget__latlong').addClass('hidn');
        $('.widget__location').removeClass('hidn');
        document.getElementById('h-latlong').value = document.getElementById('w-latlong').value.replace(/\s+/g, '');
        document.getElementById('w-latlong').value = '';
        document.querySelector('[w-type="event-discovery"]').removeAttribute('w-latlong');
        document.getElementById('w-countryCode').value = document.getElementById('h-countryCode').value;
        document.getElementById('w-postalcode').value = document.getElementById('h-postalcode').value;
        document.getElementById('w-city').value = document.getElementById('h-city').value;
        widget.config.countrycode = document.getElementById('w-countryCode').value;
        widget.config.postalcode = document.getElementById('w-postalcode').value;
        widget.config.city = document.getElementById('w-city').value;
        document.querySelector('[w-type="event-discovery"]').setAttribute('w-countrycode', widget.config.countrycode);
        document.querySelector('[w-type="event-discovery"]').setAttribute('w-postalcode', widget.config.postalcode);
        document.querySelector('[w-type="event-discovery"]').setAttribute('w-city', widget.config.city);
        widget.config.latlong = '';
        widget.update();
    });
  
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
  })

  var countriesList = 'Select Country';
  $.ajax({
      type: "POST",
      url: "/wp-content/plugins/ticketmaster/admin/data/countryCode.json",
      dataType: "json",
      beforeSend: function() {
      },
      cache: !1,
      success: function(data) {
          $.each( data.CountryCode, function (i, item) {
            var countryCode = item.substring(0, 2);
            var countryName = item.substring(4, item.length-1);
            countriesList += "<option value='" + countryCode + "'>" + countryName + "</option>";
          });
          $('#w-countryCode').html(countriesList);
      },
      error: function() {
          countriesList += "<option value=''>Ajax error!</option>";
          $('#w-countryCode').html(countriesList);
      }
  })

  document.getElementById('w-width').addEventListener('blur', function(e) {
       if(this.value < 350 || this.value > 1920) {
         this.value = 350;
         var widgetNode = document.querySelector("div[w-tmapikey]");
         widgetNode.setAttribute('w-width', '350');
         document.querySelector('.events-root-container').style.width = '350px';
         widget.update();
       }
   });

   document.getElementById('w-borderradius').addEventListener('blur', function(e) {
        if(this.value < 0 || this.value > 50) {
            this.value = 4;
            var widgetNode = document.querySelector("div[w-tmapikey]");
            widgetNode.setAttribute('w-borderradius', '4');
            widget.update();
        }
    });

    document.getElementById('w-googleapikey').addEventListener('blur', function(e) {
        var widgetNode = document.querySelector("div[w-tmapikey]");
        widgetNode.setAttribute('w-googleapikey', $(this).val());
        widget.update();
    });

  $('.color-picker').minicolors();
  $('.dt-ico').each(function (idx, iconElement) {
    iconElement.addEventListener('click', function () {
      NewCssCal($(iconElement).attr('data-input-id'), 'yyyyMMdd', 'dropdown');
    });
  });
})( jQuery );