(function( $ ) {
	'use strict';

	$(function() {
		var $widgets_list = document.querySelector('#widgets-list');

		$('span.delete-widget').on('click', function(){
			var item = $(this);
			var widget_id = item.data('widgetid');
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action : 'delete_widget',
					id: widget_id
				},
				success: function (response) {
					var data = JSON.parse(response);
					if(data.error) {
						showModalDialog( data.status, translations.error_title );
					} else{
						item.parent().parent().hide('slow', function(){
							$(this).remove();

							if($widgets_list.childElementCount === 0) {
								var widget_list_item = document.createElement('p');
								widget_list_item.textContent = translations.empty_widgets_list_text_content;
								$widgets_list.appendChild(widget_list_item);
							}
						});
					}
				}
			});
		});

		$('#ticketmaster-settings #w-universe-modal-widget').change(function() {
			var state = (this.checked) ? 1 : 0;
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action : 'change_universe_modal_widget_state',
					state : state
				}
			});
		});

		$('#ticketmaster-settings .js_get_widget_code').on('click', function(){
			var widget_type = $(this).attr('w-widget-type'),
			    title = document.querySelector('input[name=w-title]'),
			    title_label = document.querySelector('[for=w-title]'),
			    title_container = title.parentNode,
			    api_code = document.querySelector('input[name=w-tm-api-key]'),
				api_code_label = document.querySelector('[for=w-tm-api-key]'),
				api_code_container = (widget_type != 'countdown') ? api_code.parentNode : '',
				g_api_code = (widget_type != 'countdown') ? document.querySelector('input[name=w-googleapikey]') : '',
				g_api_code_label = (widget_type != 'countdown') ? document.querySelector('[for=w-googleapikey]') : '',
				g_api_code_container = (widget_type != 'countdown') ? g_api_code.parentNode : '',
				widget_params = {},
				widget = $('#' + widget_type + '-config div[w-type="' + widget_type + '"]').clone().children().remove().end().get(0),
				error_flag = false;

			if(title.value.trim() == "") {
                if (document.querySelector('.widget-title') === null) {
	              var container = document.createElement("div");
                  container.classList.add("widget-title");
                  container.classList.add("error-message");
                  container.innerHTML = translations.empty_title_error_message;
                  title_container.appendChild(container);
                }
				title_label.classList.add('error');
				title.classList.add('error');
				title.focus();
				error_flag = true;
			}
			else {
				title.classList.remove('error');
				title_label.classList.remove('error');
				$('.error-message', title_container).remove();

			}

			if(api_code.value.trim() == ""){
				if (document.querySelector('.widget-tm-api-code') === null) {
					var container = document.createElement("div");
					container.classList.add("widget-tm-api-code");
					container.classList.add("error-message");
					container.innerHTML = translations.empty_api_key_error_message;
					api_code_container.appendChild(container);
				}
				api_code_label.classList.add('error');
				api_code.classList.add('error');
				error_flag = true;
			}
			else {
				api_code.classList.remove('error');
				api_code_label.classList.remove('error');
				$('.error-message', api_code_container).remove();
			}

			if (widget_type != 'countdown') {
				if(g_api_code.value.trim() == ""){
					if (document.querySelector('.widget-tm-googleapikey-code') === null) {
						var container = document.createElement("div");
						container.classList.add("widget-tm-googleapikey-code");
						container.classList.add("error-message");
						container.innerHTML = translations.empty_api_key_error_message;
						g_api_code_container.appendChild(container);
					}
					g_api_code_label.classList.add('error');
					g_api_code.classList.add('error');
					error_flag = true;
				}
				else {
					g_api_code.classList.remove('error');
					g_api_code_label.classList.remove('error');
					$('.error-message', g_api_code_container).remove();
				}
			}

			if(widget_type === 'map') {
		    var google_code = document.querySelector('input[name=w-googleapikey]'),
				google_code_label = document.querySelector('[for=w-googleapikey]'),
				google_code_container = google_code.parentNode;
				if(google_code.value.trim() == ""){
					if (document.querySelector('.google-code') === null) {
						var container = document.createElement("div");
						container.classList.add("google-code");
						container.classList.add("error-message");
						container.innerHTML = translations.empty_api_key_error_message;
						google_code_container.appendChild(container);
					}
					google_code_label.classList.add('error');
					google_code.classList.add('error');
					error_flag = true;
					}
					else {
						google_code.classList.remove('error');
						google_code_label.classList.remove('error');
						$('.error-message', google_code_container).remove();
					}
			}

			if(error_flag)
				return;

			$.each(widget.attributes, function() {
				if(this.name.match(/^w-/)) {
					widget_params[this.name] = this.value;
				}
			});

			widget_params = JSON.stringify(widget_params);

			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: {
					action : 'create_widget',
					type: widget_type,
					title: title.value,
					params: widget_params
				},
				success: function (response) {
					var data = JSON.parse(response);
					if(data.error) {
						showModalDialog( data.status, translations.error_title );
					} else {
						showModalDialog( data.status );
					}
				}
			});
		});

        $('#ticketmaster-settings .js_reset_widget').on('click', function(){
	        var title = document.querySelector('input[name=w-title]'),
		        title_label = document.querySelector('[for=w-title]'),
		        api_code = document.querySelector('input[name=w-tm-api-key]'),
		        api_code_label = document.querySelector('[for=w-tm-api-key]');

	        title.classList.remove('error');
	        title_label.classList.remove('error');

	        api_code.classList.remove('error');
	        api_code_label.classList.remove('error');

	        $('#ticketmaster-settings .error-message').remove();
        });

	});

	function showModalDialog(msg, title){
		if (!title)
			title = translations.info_title;
		if (!msg)
			msg = translations.empty_message_text_content;
		$("<div></div>").html(msg).dialog({
			title: title,
			resizable: false,
			modal: true,
			closeOnEscape: true,
			buttons: {
				"Ok": function()
				{
					$( this ).dialog( "close" );
				}
			}
		});
	}

})( jQuery );
