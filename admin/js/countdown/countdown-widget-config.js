(function($) {
  window.coreCountdownWidgetConfig.default({
    jQuery,
    onChangeState
  });

  var $window = $(window);
  var widgetNode = document.querySelector("div[w-tmapikey]");
  var widget = window.widgetsLib.widgetsCountdown[0];

  function replaceApiKey( options ) {
    var userKey = options.userKey || sessionStorage.getItem( 'tk-api-key' );

    if ( userKey !== null ) {
      var inputApiKey = options.inputApiKey;
      var widgetNode = options.widgetNode;
      var widget = options.widget;

      inputApiKey.attr( 'value', userKey )
        .data( 'userAPIkey', userKey )
        .val( userKey );
      widgetNode.setAttribute( "w-tm-api-key", userKey );
      widget.update();
    }
  };

  function onChangeState({ targetName }) {
    if ( targetName === "w-tm-api-key" ) {
      document.querySelector( '[w-type="countdown"]' )
        .setAttribute( 'w-tmapikey', targetValue );

      if ( sessionStorage.getItem( 'tk-api-key' ) ) {
        document.getElementById( 'w-tm-api-key' ).value = sessionStorage.getItem( 'tk-api-key' );
        document.querySelector( '[w-type="countdown"]' )
          .setAttribute( 'w-tmapikey', sessionStorage.getItem( 'tk-api-key' ) );
      }
      if ( document.getElementById( 'w-tm-api-key' ).value === '' ) {
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
  }

  $window.on('login', function (e, data) {
    replaceApiKey( {
      userKey: data.key,
      inputApiKey: $('#w-tm-api-key'),
      widgetNode: widgetNode,
      widget: widget
    } );
  });

  replaceApiKey({
    inputApiKey: $('#w-tm-api-key'),
    widgetNode: widgetNode,
    widget: widget
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
  });

})(jQuery);

