(function($) {
  window.coreMapWidgetConfig.default({
    jQuery,
    defaultApiKey: 'TQMbqzKDBbcCjAxC9SaKS1lg9D5Eousb',
    addToContainerMinMove: -30,
    onChangeState: function (widgetNode) {
      document.getElementById('w-width').value = widgetNode.getAttribute('w-width');
      document.getElementById('w-borderradius').value = widgetNode.getAttribute('w-borderradius');
    }
  });

  $('.nav-tabs').on('click', 'a', function (e) {
    e.preventDefault();
    $('.nav-tabs li').removeClass('active');
    $(this).parent().addClass('active');
    var active = $(this).parent().index();
    $(this).parent().parent().next().children().removeClass('in');
    $(this).parent().parent().next().children().removeClass('active');
    $(this).parent().parent().next().children().eq(active).addClass('in');
    $(this).parent().parent().next().children().eq(active).addClass('active');
  });

  var countriesList = 'Select Country';
  $.ajax({
    type: "POST",
    url: "/wp-content/plugins/ticketmaster/admin/data/countryCode.json",
    dataType: "json",
    beforeSend: function () {
    },
    cache: false,
    success: function (data) {
      $.each(data.CountryCode, function (i, item) {
        var countryCode = item.substring(0, 2);
        var countryName = item.substring(4, item.length - 1);
        countriesList += "<option value='" + countryCode + "'>" + countryName + "</option>";
      });
      $('#w-countryCode').html(countriesList);
    },
    error: function () {
      countriesList += "<option value=''>Ajax error!</option>";
      $('#w-countryCode').html(countriesList);
    }
  });
})(jQuery);

