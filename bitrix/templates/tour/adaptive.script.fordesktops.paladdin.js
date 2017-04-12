jQuery(function($){

	



	//mainentrance

	$(window).on('load', function () {

		var sec1 = $('section').eq(0).find('.fp-tableCell')
		sec1.find('.tourmain').css('animation-delay', '1s');
		sec1.find('.tourmain').addClass('animated fadeInDown');
		sec1.find('#startsearch').css('animation-delay', '1.8s');
		sec1.find('#startsearch').addClass('animated zoomIn');
		sec1.find('.hotindex').css('animation-delay', '2.5s');
		sec1.find('.hotindex').addClass('animated slideInUp');

	});


	function scriptForDesk(){
		if($('#fullPage').length == 0 && $('#searchpageidentificator').length == 0){
			$('body>*').not('.navbar').css({
				'zoom': zoomForDeskTops()
			})

			$('.navbar').addClass('bgblack')
			

		}
		else {
			//$('.item').addClass('hidden')
		}
	}

	scriptForDesk()

	$(window).resize(function(){
		//$('.mapbgr').height(($('.navbar').height() + 1) / zoomForDeskTops())
		scriptForDesk()
	})


	$('.hotblocks').click(function(){
		if($(window).width() < 900){
			window.location.href="/content/tours/";
		}
	})




	if($(window).width() < 400){
		$('.franchize>p, .tacher>p').hide();
		$('.franchize h3').eq(0).hide();
		$('.tacher h3').eq(0).hide();
		$('.lastblock .phones').closest('.col-xs-6').find('div:nth-child(1)').eq(0).css({
			'display': 'none'
		})
		$('.footermenu').closest('.col-xs-6').find('div:nth-child(1)').eq(0).css({
			'display': 'none'
		})
		
	}


	if($(window).width() < 1000){
		$('.hotel-carusel').removeClass('owl-carousel owl-loaded owl-drag')
		//alert($('.hotels .item').find('.hotel').length)
		$('.hotels .item').find('.hotel').each(function(){
			$('.hotel-carusel').append($(this).clone().wrapAll('<div class="item new"><div class="hotel"></div></div>'))
		})
		$('.hotels .item').not('.new').remove();
		$('.hotels .hotel').each(function(){
			$(this).wrapAll('<div class="item new"></div>')
		})


		$('.hotel-carusel').owlCarousel({
			loop:true,
			margin:20,
			dots:false,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				}
			}
		});
	}

	$('.phone-number-for-mask, input[placeholder="Ваш телефон"]').mask('+7(999) 999-99-99')


	function dropDownTowns(){


		if($('.footer').length > 0){
			var fh = $('.footer').height()
		}
		else {
			var fh = 0
		}

		fh += 30


		$('.cityAll').css({
			'max-height': document.body.clientHeight - 60 - fh,
			'overflow': 'auto'
		})
	}

	function beforeResizing() {
		$('#franchize .container.franch').css({
			'max-height': $('#franchize .fp-tableCell').height()+'px'
		})
	}
	beforeResizing()
	$(window).resize(function(){
		dropDownTowns()
		beforeResizing()
	})

	$('.tabouterwrap .tabwrap').eq(0).addClass('active')
	$('.tour-menu .fly_date').eq(0).trigger('click')

	$('.tour-menu .fly_date').click(function(){
		var id = $(this).data('id')
		$('.tabouterwrap .tabwrap').removeClass('active')
		$('.tabouterwrap .tabwrap').each(function(){
			if($(this).data('id') == id || (('0'+$(this).data('id')) == id)){
				$(this).addClass('active')
			}
		})
	})

	var _dropdown;
	var settings = {autoReinitialise: true, mouseWheelSpeed : 50};

	if($(window).width() > 1024){
		setTimeout(function() {
			$('select').styler({
				locale: 'ru',
				locales: {
					'ru': {
						selectPlaceholder: '',
					}
				},
				selectSmartPositioning: true,
				onFormStyled: function(){
					_dropdown = $('.jq-selectbox__dropdown');
					_dropdown.find('ul').wrap('<div class="scroll-pane" />');
				},
				onSelectOpened: function(){
					var _ul = $(this).find('.jq-selectbox__dropdown ul');
					var height = _ul.height() ;
					if(height > 150) {
						height -= 69
					}
					//alert(height)
					var _srollPane = _dropdown.find('.scroll-pane');
					_srollPane.height(height);
					_ul.css('max-height', 'none');
					var scrollelem = _srollPane.jScrollPane(settings);
				}


			})
		}, 2000)
	}




	$('[data-toggle="tooltip"]').tooltip();

	$('.calendarico').click(function(){
		$(this).closest('.form-group').find('input').trigger('focus')
	})

	function get_name_browser(){
		var ua = navigator.userAgent;    
		if (ua.search(/Chrome/) > 0) return 'Google Chrome';
		if (ua.search(/Firefox/) > 0) return 'Firefox';
		if (ua.search(/Opera/) > 0) return 'Opera';
		if (ua.search(/Safari/) > 0) return 'Safari';
		if (ua.search(/NET/) > 0) return 'IE';

	}

	if(get_name_browser() == 'Firefox' || get_name_browser() == 'IE' || $(window).width() == 1024) {
		$('.fp-tableCell').not('#fullPage section:first-child .fp-tableCell').css({
			'transform-origin': 'center 202px'
		})
		$(window).resize(function(){
			$('.fp-tableCell').not('#fullPage section:first-child .fp-tableCell').css({
				'transform-origin': 'center 202px'
			})
			$('.bx-yandex-view-layout').closest('.fp-tableCell').css({
				'transform': 'none'
			})
			$('.bx-yandex-view-layout').closest('.fp-tableCell').css({
				'transform': 'none'
			})
		})

		$('.fp-tableCell').not($('.bx-yandex-view-layout').closest('.fp-tableCell')).css({
			'-webkit-transform': 'scale('+zoomForDeskTops()+')',
			'transform': 'scale('+zoomForDeskTops()+')',
			'transform-origin': 'center' 
		});
		$('.daterangepicker').css({
			'-webkit-transform': 'scale('+zoomForDeskTops()+')',
			'transform': 'scale('+zoomForDeskTops()+')',
			'transform-origin': 'center' 
		});
	}
	else {
		$('.fp-tableCell, .navigation').css({
			'-webkit-zoom': zoomForDeskTops(),
			'zoom': zoomForDeskTops(),
		});
		//alert()
		$('.daterangepicker').css({
			'-webkit-zoom': zoomForDeskTops(),
			'zoom': zoomForDeskTops(),
		});

	}

	//$('.mapbgr').height(($('.navbar').height() + 1) / zoomForDeskTops())
	$('.bx-yandex-view-layout').closest('.fp-tableCell').css({
		'transform': 'none'
	})

    //alert('Высота: ' + $(window).height() + ', Ширина: ' + $(window).width())
	if($(window).width() < 400) {
		$('.subscribe input[name="subs_email"]').attr('placeholder', 'Подписка на рассылку')
		//alert()
	}

	$('.article p').text($.trim($('.article p').text().substr(0, 150)) + '...')

	if($(window).width() < 1000) {
		if($.trim($('.mobile-city').text()) == ''){
			$('#myTown .myTown').text('Неизвестный (Требуется указать город)')
		}
		else {
			$('#myTown .myTown').text($('.mobile-city').text())
		}
		$("#myTown").modal('show');
	}
	$('#myTown .closethis').click(function(){
		$('#myTown').modal('hide')
	})
	$('#myTown .change').click(function(){
		$('#myTown').modal('hide')
		$('.cityAll2').fadeIn()
	})

	$('.adressAll .mob-close').click(function(){
		$('.adressAll').fadeOut()
	})
	$('.adressAll .choodeTown').click(function(){
		$('.adressAll').fadeOut()
		$('.cityAll2').fadeIn()
	})

	$(document).mouseup(function (e) {
		var container = $(".adressAll");
		if (container.has(e.target).length === 0){
			container.fadeOut();
		}
	});
	$(document).mouseup(function (e) {
		var container = $(".cityAll2");
		if (container.has(e.target).length === 0){
			container.fadeOut();
		}
	});

	// if($(window).width() < 1000) {
	// 	$('#cityx2').liColl({
	// 		c_unit: 'px', 
	// 		n_coll: 7,    
	// 		c_width: 140,
	// 		p_left: 10              
	// 	});
	// }


	function getOrientation(){
		var orientation = window.innerWidth > window.innerHeight ? "Landscape" : "Portrait";

		if(orientation == 'Landscape') {
			if(window.innerHeight < 550){
				$('.formobileviewport').show()
				$('body').css({
					'overflow': 'hidden'
				})
			}
		}
		else {
			if(window.innerWidth < 550) {

				$('.formobileviewport').hide()
				$('body').css({
					'overflow': 'auto'
				})
			}
		}
		return orientation;
	}
	getOrientation()
	window.onresize = function(){
		getOrientation()
	}




})