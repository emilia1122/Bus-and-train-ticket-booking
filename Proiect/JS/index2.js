$(document).ready(function(){
			$(".logare-container .rgstr-btn button").click(function(){
				$('.logare-container .wrapper').addClass('move');
				$(".logare-container .login-btn button").removeClass('active');
				$(this).addClass('active');

			});
			$(".logare-container .login-btn button").click(function(){
				$('.logare-container .wrapper').removeClass('move');
				$(".logare-container .rgstr-btn button").removeClass('active');
				$(this).addClass('active');
			});
		});
