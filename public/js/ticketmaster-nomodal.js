(function( $ ) {
	'use strict';

	$(function() {
		$(".entry-content a[href*='universe']").on('click', function(e){
			window.location.href = this.getAttribute('href');
		});
	});

})( jQuery );
