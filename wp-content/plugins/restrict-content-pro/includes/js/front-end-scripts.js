jQuery(document).ready(function($) {
	if(rcp_script_options.validate == 'true') {
		$("#rcp_registration_form").validate({
			rules: {
				rcp_user_pass_confirm: {
					equalTo: '#rcp_password'
				},
				rcp_user_email: {
					email: true
				}
			},
			errorPlacement: function(error, element) {},
			submitHandler: function(form) {
				form.submit();
			}
		});

		$("#rcp_password_form").validate({
			rules: {
				rcp_user_pass_confirm: {
					equalTo: '#rcp_user_pass'
				}
			},
			errorPlacement: function(error, element) {},
			submitHandler: function(form) {
				form.submit();
			}
		});
	}

	if($('#rcp_payment_gateways').length > 0 ) {
		// show the Select Payment method option
		$('.rcp_level').change(function() {
			var price = parseInt( $(this).attr('rel') );
			if( price > 0 && ! $('.rcp_gateway_fields').hasClass('rcp_discounted_100') ) {
				$('#rcp_payment_gateways').show(200);
			} else {
				$('#rcp_payment_gateways').hide(200);
			}
		});
		if( parseInt( $('#rcp_subscription_levels input:checked').attr('rel') ) == 0 ) {
			$('#rcp_payment_gateways').hide(200);
		} else {
			if( ! $('rcp_gateway_fields').hasClass('rcp_discounted_100') ) {
				$('#rcp_payment_gateways').show(200);
			}
		}
	}

	$('.rcp_level').change(function() {
		if( parseInt( $(this).attr('rel') ) == 0 ) {
			$('#rcp_auto_renew_wrap').hide();
			$('#rcp_discount_code_wrap').hide();
			$('#rcp_discount_code_wrap input').val('');
			$('#rcp_auto_renew_wrap input').attr('checked', false);
		} else {
			if( $(this).data('duration') == 'forever' ) {
				$('#rcp_auto_renew_wrap').hide();
				$('#rcp_auto_renew_wrap input').attr('checked', false);
			} else {
				$('#rcp_auto_renew_wrap').show();
				$('#rcp_discount_code_wrap').show();
			}
		}
	});

	if( parseInt( $('#rcp_subscription_levels input:checked').attr('rel') ) == 0 ) {
		$('#rcp_auto_renew_wrap').hide();
		$('#rcp_auto_renew_wrap input').attr('checked', false);
		$('#rcp_discount_code_wrap').hide();
		$('#rcp_discount_code_wrap input').val('');
	} else if( $('#rcp_subscription_levels input:checked') == 'forever' ) {
		$('#rcp_auto_renew_wrap').hide();
		$('#rcp_auto_renew_wrap input').attr('checked', false);
	} else {
		$('#rcp_auto_renew_wrap').show();
		$('#rcp_discount_code_wrap').show();
	}

	$('#rcp_discount_code').keyup(function(key) {
		if(key.which != 13) {

			if( $(this).val() == '' )
				return false;

			var data = {
				action: 'validate_discount',
				code: $(this).val(),
				subscription_id: $('#rcp_subscription_levels input:checked').val()
			};
			$.post(rcp_script_options.ajaxurl, data, function(response) {
				if(response == 'invalid') {
					// code is invalid
					$('.rcp_discount_valid').hide();
					$('.rcp_discount_invalid').show();
					$('.rcp_gateway_fields').removeClass('rcp_discounted_100');
				} else if(response == 'valid') {
					// code is valid
					$('.rcp_discount_invalid').hide();
					$('.rcp_discount_valid,.rcp_gateway_fields').show();
					$('.rcp_gateway_fields').removeClass('rcp_discounted_100');
				} else if(response == 'valid and full') {
					// code is valid
					$('.rcp_discount_invalid,#rcp_payment_gateways,.rcp_gateway_fields,#rcp_auto_renew_wrap').hide();
					$('.rcp_discount_valid').show();
					$('.rcp_gateway_fields').addClass('rcp_discounted_100');
				}
				$('body').trigger('rcp_discount_applied', [ response ]);
			});
		}
	});
});