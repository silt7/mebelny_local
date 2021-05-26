/**
 * $.fn.apiAuthRegister
 */
(function ($) {
	var defaults = {};
	var options = {};
	var methods = {
		init: function (params) {

			options = $.extend({}, defaults, options, params);

			if (!this.data('apiAuthRegister')) {
				this.data('apiAuthRegister', options);

				//Code here
				var wrapper = $(options.wrapperId);
				var form = $(options.formId);

				$(form).on('click', '[type="button"]', function (e) {

					if(options.usePrivacy){
						if(!$(form).find('input[name=PRIVACY_ACCEPTED]').prop('checked')){
							$.fn.apiAlert({content:options.mess['PRIVACY_CONFIRM']});
							return false;
						}
					}

					$.fn.apiAuthRegister('showWait', form);

					if (options.secureAuth)
						rsasec_form(options.secureData);

					var formData = {
						API_AUTH_REGISTER_AJAX: 1,
						sessid: BX.message('bitrix_sessid'),
						siteId: BX.message('SITE_ID'),
						REQUIRED_FIELDS: options.REQUIRED_FIELDS
					};
					var submitFormData = $(form).serialize() + '&' + $.param(formData);

					$.ajax({
						type: 'POST',
						url: '/bitrix/components/api/auth.register/ajax.php',
						dataType: 'json',
						data: submitFormData,
						error: function (jqXHR, textStatus, errorThrown) {
							console.log('textStatus: ' + textStatus);
							console.log('errorThrown: ' + errorThrown);
						},
						success: function (data) {
							$.fn.apiAuthRegister('hideWait', form);

							if (data.TYPE == 'ERROR') {
								$.fn.apiAuthRegister('showError', form, data.MESSAGE);
							}
							else {
								$(wrapper).html(data.MESSAGE);
								window.setTimeout('location.reload(true)', 3000);
							}
						}
					});
					e.preventDefault();
				});

			}
			return this;
		},
		showError: function (form, message) {
			$(form).find('.api_error').slideUp(200, function () {
				$(this).html(message).slideDown(200);
			});
		},
		showWait: function (form) {
			$(form).addClass('api_form_wait').find('.api_field').prop('readonly', true);
		},
		hideWait: function (form) {
			$(form).removeClass('api_form_wait').find('.api_field').prop('readonly', false).prop('disabled', false);
		}
	};

	$.fn.apiAuthRegister = function (method) {

		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Error! Method "' + method + '" not found in plugin $.fn.apiAuthRegister');
		}
	};

	$.fn.apiAuthRegister('init');

})(jQuery);

