(function($) {
  window.coreEventDiscoveryWidgetConfig.default({
    jQuery,
    onChangeState: onChangeState,
  });

  var widget = window.widgetsLib.widgetsEventDiscovery[0];
  var countriesList = 'Select Country';
  var $window = $(window);

  function replaceApiKey(options) {
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

  function onChangeState({ targetName }) {
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
  }

  replaceApiKey({
    inputApiKey: $('#w-tm-api-key'),
    widgetNode: document.querySelector("div[w-tmapikey]"),
    widget: widget
  });

  $window.on('login', function (e, data) {
    replaceApiKey({
      userKey: data.key,
      inputApiKey: $('#w-tm-api-key'),
      widgetNode: document.querySelector("div[w-tmapikey]"),
      widget: widget
    });
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
  });
})(jQuery);

