(function ( $ ) {

'use strict';

    var DEFAULT_API_KEY = "TQMbqzKDBbcCjAxC9SaKS1lg9D5Eousb";

    function getHeightByTheme(theme) {
        return theme === 'simple' ? 286 : 339;
    }

    function getBorderByTheme(theme) {
        switch (theme) {
            case 'simple':
                return 1;
                break;
            default:
                return 2;
        }
    }

    function getGooleApiKey(code) {
        return code || "AIzaSyBQrJ5ECXDaXVlICIdUBOe8impKIGHDzdA";
    }

    var widget = widgetsLib.widgetsMap[0],
        themeConfig = {
        sizes: {
            s: {
                width: 300,
                height: 250,
                layout: 'vertical'
            },
            m: {
                width: 300,
                height: 600,
                layout: 'horizontal'
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

    /*
    var $widthController = $('#w-width').slider({
        tooltip: 'always',
        handle: 'square'
    }),
        $borderRadiusController = $('#w-borderradius').slider({
        tooltip: 'always',
        handle: 'square'
    }),
    */
    var $colorSchemeSelector = $('.widget__color_scheme_control');

    $('#js_styling_nav_tab').on('shown.bs.tab', function (e) {
        // $widthController.slider('relayout');
        // $borderRadiusController.slider('relayout');
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

        $containerWidget.data('min', min_move).data('max', max_move);

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
                // console.log('*** ', j , innerWidth ,'<', desktopWidth );
                containerMove_clearOffset();
                updateScroll();
            }
            if ($containerWidget.height() < $configBlock.height() || innerWidth >= desktopWidth) {
                // console.log('ignore ',j);
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
        var userKey = options.userKey || sessionStorage.getItem('tk-api-key') || DEFAULT_API_KEY;

        if (userKey !== null) {
            var inputApiKey = options.inputApiKey,
                widgetNode = options.widgetNode,
                _widget = options.widget;

            inputApiKey.attr('value', userKey).val(userKey);
            widgetNode.setAttribute("w-tmapikey", userKey);
            _widget.update();
        }
    };
    replaceApiKey({
        inputApiKey: $('#w-tm-api-key'),
        widgetNode: document.querySelector("div[w-tmapikey]"),
        widget: widget
    });

    var changeState = function changeState(event) {
        if (!event.target.name) return;

        var widgetNode = document.querySelector("div[w-tmapikey]"),
            targetValue = event.target.value,
            targetName = event.target.name,
            $tabButtons = $('.js-tab-buttons');

        if (targetName === "w-tm-api-key") {
            document.querySelector('[w-type="map"]').setAttribute('w-tmapikey', targetValue);

            if (sessionStorage.getItem('tk-api-key')) {
                document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
                document.querySelector('[w-type="map"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
            }
            if (document.getElementById('w-tm-api-key').value == '') {
                if (sessionStorage.getItem('tk-api-key')) {
                    document.getElementById('w-tm-api-key').value = sessionStorage.getItem('tk-api-key');
                    document.querySelector('[w-type="map"]').setAttribute('w-tmapikey', sessionStorage.getItem('tk-api-key'));
                } else {
                    document.getElementById('w-tm-api-key').value = DEFAULT_API_KEY;
                    document.querySelector('[w-type="map"]').setAttribute('w-tmapikey', DEFAULT_API_KEY);
                }
            }
        }

        if (targetName === "w-latlong") {
            if (targetValue == '') {
                document.getElementById('w-latlong').value = document.getElementById('h-latlong').value;
                targetValue = document.getElementById('w-latlong').value;
            }
            document.querySelector('[w-type="map"]').setAttribute('w-latlong', targetValue.replace(/\s+/g, ''));
        }

        if (targetName === "w-postalcode") {
            widgetNode.setAttribute('w-country', '');
            widgetNode.setAttribute('w-postalcode', document.getElementById('w-postalcode').value);
            isPostalCodeChanged = true;
        }

        if (targetName === "w-countryCode") {
            if (widgetNode.getAttribute('w-countrycode') != targetValue) {
                document.getElementById("w-city").value = '';
                widgetNode.setAttribute('w-city', '');
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

            /*
            $widthController.slider({
                setValue: sizeConfig.width,
                max: sizeConfig.maxWidth,
                min: sizeConfig.minWidth
            }).slider('refresh');
            */

            document.querySelector('.map').style.width = sizeConfig.width + 'px';
            document.querySelector('.map').style.height = sizeConfig.height + 'px';
            widgetNode.setAttribute('w-width', sizeConfig.width);
            widgetNode.setAttribute('w-height', sizeConfig.height);
        }

        if (targetName === "w-width") {
            document.querySelector('.map').style.width = widgetNode.getAttribute('w-width') + 'px';
            document.querySelector('.map').style.height = widgetNode.getAttribute('w-height') + 'px';
            document.querySelector('.map').style.width = document.getElementById('w-width').value + 'px';
        }

        //Check fixed sizes for 'simple' theme
        if (targetName === "w-proportion") {
            var widthSlider = $('.js_widget_width_slider');
            var _sizeConfig = {
                width: themeConfig.sizes[targetValue].width,
                height: themeConfig.sizes[targetValue].height,
                maxWidth: 1200,
                minWidth: 350
            };

            document.querySelector('.map').style.width = themeConfig.sizes[targetValue].width + 'px';
            document.querySelector('.map').style.height = themeConfig.sizes[targetValue].height + 'px';

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
                /*
                $widthController.slider({
                    setValue: _sizeConfig.width,
                    max: _sizeConfig.maxWidth,
                    min: _sizeConfig.minWidth
                }).slider('refresh');
                */
            }

            widgetNode.setAttribute('w-width', _sizeConfig.width);
            widgetNode.setAttribute('w-height', _sizeConfig.height);
        }

        if (event.target.name != 'w-latlong') widgetNode.setAttribute(event.target.name, event.target.value);
        document.getElementById('w-width').value = widgetNode.getAttribute('w-width');
        document.getElementById('w-borderradius').value = widgetNode.getAttribute('w-borderradius');
        widget.update();
        windowScroll(); //recalculate widget container position
    };

    var resetWidget = function resetWidget(configForm) {
        var widgetNode = document.querySelector("div[w-tmapikey]"),
            width = 350,
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

            var activeItems = document.querySelectorAll('.custom_select__item.custom_select__item-active');
            var activeItemsLenght = activeItems.length;
            for (var i = 0; i < activeItemsLenght; ++i) {
                activeItems[i].classList.remove('custom_select__item-active');
            }

            ["#w-countryCode", "#w-source"].map(function (item) {
                $(item).prop("selectedIndex", -1);
            });
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
        widgetNode.setAttribute('w-width', width);
        widgetNode.setAttribute('w-height', height);
        widgetNode.setAttribute('w-border', 0);
        widgetNode.removeAttribute('w-countryCode');
        widgetNode.removeAttribute('w-source');

        $('.country-select .js_custom_select').removeClass('custom_select-opened'); //reset custom select
        document.querySelector('.map').style.width = '350px';
        document.querySelector('.map').style.height = '600px';
        widget.onLoadCoordinate();
        widget.update();
        // document.querySelector('.widget-container-wrapper').removeAttribute('style');
        containerMove();
    };

    var $configForm = $(".main-widget-config-form"),
        $widgetModal = $('#js_widget_modal'),
        $widgetModalNoCode = $('#js_widget_modal_no_code'),
        $widgetModalMap = $('#js_widget_modal_map');

    $configForm.on("change", changeState);
    // Mobile devices. Force 'change' by 'Go' press
    $configForm.on("submit", function (e) {
        $configForm.find('input:focus').trigger('blur');
        e.preventDefault();
    });

    $configForm.find("input[type='text'], input[type='number'], input[type='checkbox']").each(function () {
        var $self = $(this);
        $self.data('default-value', $self.val());
    });

    $configForm.find("input[type='radio']").each(function () {
        var $self = $(this);
        if ($self.is(':checked')) $self.data('is-checked', 'checked');
    });

    $('.js_get_widget_code').on('click', function () {
        var googleKey = 'YOUR_GOOGLE_API_KEY';
        var codeCont = document.querySelector(".language-html.widget_dialog__code");
        var htmlCode = document.createElement("div");
        for (var key in widget.config) {
            htmlCode.setAttribute("w-" + key, widget.config[key]);
        }
        // Use only Key from config form
        htmlCode.setAttribute('w-googleapikey', getGooleApiKey());
        htmlCode.setAttribute('w-latlong', document.getElementById('w-latlong').value.replace(/\s+/g, ''));
        if (document.getElementById('w-googleapikey').value != '') {
            googleKey = document.getElementById('w-googleapikey').value;
            htmlCode.setAttribute('w-googleapikey', googleKey);
        } else {
            htmlCode.setAttribute('w-googleapikey', googleKey);
        }
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

    $('#js_widget_modal_map__open').on('click', function (e) {
        e.preventDefault();
        // $widgetModalMap.modal();
    });

    $('#js_widget_modal_map__close').on('click', function () {
        // $widgetModalMap.modal('hide');
        document.querySelector('[w-type="map"]').setAttribute('w-latlong', document.getElementById('w-latlong').value.replace(/\s+/g, ''));
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
        document.querySelector('[w-type="map"]').setAttribute('w-latlong', widget.config.latlong);
        document.querySelector('[w-type="map"]').removeAttribute('w-countrycode');
        document.querySelector('[w-type="map"]').removeAttribute('w-postalcode');
        document.querySelector('[w-type="map"]').removeAttribute('w-city');
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
        document.querySelector('[w-type="map"]').removeAttribute('w-latlong');
        document.getElementById('w-countryCode').value = document.getElementById('h-countryCode').value;
        document.getElementById('w-postalcode').value = document.getElementById('h-postalcode').value;
        document.getElementById('w-city').value = document.getElementById('h-city').value;
        widget.config.countrycode = document.getElementById('w-countryCode').value;
        widget.config.postalcode = document.getElementById('w-postalcode').value;
        widget.config.city = document.getElementById('w-city').value;
        document.querySelector('[w-type="map"]').setAttribute('w-countrycode', widget.config.countrycode);
        document.querySelector('[w-type="map"]').setAttribute('w-postalcode', widget.config.postalcode);
        document.querySelector('[w-type="map"]').setAttribute('w-city', widget.config.city);
        widget.config.latlong = '';
        widget.update();
    });

    $('#w-geoposition').on('click', function () {
        if ($(this).val() == undefined || $(this).val() == 'off') {
            document.querySelector('[w-type="map"]').setAttribute("w-geoposition", "on");
            $(this).val('on');
            document.querySelector('.near-me-btn').classList.remove('dn');
        } else {
            document.querySelector('[w-type="map"]').setAttribute("w-geoposition", "off");
            $(this).val('off');
            document.querySelector('.near-me-btn').classList.add('dn');
        }
    });

    widget.onLoadCoordinate = function (results) {
        var countryShortName = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
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
    
    function clearDropDownInput(elemIds) {
        elemIds.map(function (item) {
            $(item).val('');
        });
    }

    // Set min widget size on mobile devices
    if (parseInt($(window).width(), 10) < 767) {
        $('#w-fixed-300x250').trigger('click');
    }

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
            document.querySelector('.map').style.width = '350px';
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

})( jQuery );