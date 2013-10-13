!function ($) {

	$(document).ready(function() {

		$('.send-fotos').on('click', function(){

			plSendMail()
		})

	})

	function plSendMail() {

		var name = $('.fotos-contact-name').val()
		,	email = $('.fotos-contact-email').val()
		,	custom = $('.fotos-contact-custom').val()
		,	msg = $('.fotos-contact-msg').val()
		,	captcha = $('.fotos-contact-captcha').val()

		jQuery.ajax({
			type: 'POST'
			, url: fotosmail.ajaxurl
			, data: {
				action: 'ajaxcontact_send_mail'
				,	name: name
				,	email: email
				,	custom: custom
				,	msg: msg
				,	cap: captcha
				,	width:screen.width
				,	height:screen.height
				,	agent:navigator.userAgent
			}

			,	success: function(response){

					var responseElement = jQuery('.fotos-contact-response')
					var fotosForm = jQuery('.fotos-contact-form')

					responseElement
						.hide()
						.removeClass('alert alert-error alert-success')


					if (response == "ok") {
						responseElement
							.fadeIn()
							.html('Great work! Your message was sent.')
							.addClass('alert alert-success')

						fotosForm
							.html('')

						setTimeout(function() {
							jQuery('.fotos').modal('hide')
						}, 2000)

					} else {
						responseElement
							.fadeIn()
							.html(response)
							.addClass('alert alert-error')
					}
			}

			, error: function(MLHttpRequest, textStatus, errorThrown){
				console.log(errorThrown);
			}

		});

	}

}(window.jQuery);