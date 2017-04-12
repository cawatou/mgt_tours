$.fn.extend({
	animateCss: function (animationName) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		this.addClass('animated ' + animationName).one(animationEnd, function() {
			$(this).removeClass('animated ' + animationName);
		});
	}
});
var $grid;
var inProgress = false;
if($("#chart").length){
	var ctx = $("#chart");
	
	var ctxx = document.getElementById('chart').getContext('2d');

	var grd=ctxx.createLinearGradient(0,0,0,250);
	grd.addColorStop(0,'rgb(221, 64, 64)');
	grd.addColorStop(1,"white");
	
	var myChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь'],
			datasets: [
			{
				type: 'bubble',
				label: 'Обьем продаж',
				data: [80100, 100500, 121980, 146980, 150030,199000],
			},
			{
				type: 'line',
				label: 'Обьем продаж',
				data: [80100, 100500, 121980, 146980, 150030,199000],
				pointBorderColor:'rgb(221, 64, 64)',
				pointBackgroundColor: "#fff",
				borderColor: "rgba(221, 64, 64,1)",
				backgroundColor:grd
			}
			]
		},
		options: {

			scales: {
				yAxes: [{
					ticks: {
						display:false
					}
				}],
			},
			legend: {
				display: false
			},
			elements: {
				points: {
					borderWidth: 1,
					borderColor: 'rgb(221, 64, 64)'
				}
			}
		}
	});
	
}

if($("video").length>0){
	plyr.setup({
		controls:['play-large']
	});
}

//login start
$(document).on('click','.lostpwd',function(e){
	e.preventDefault();
	$('#login').modal('hide');
	$('#forgot').modal('show');
});	
$(document).on('submit','form[name="bform"]',function(e){
	e.preventDefault();
	$.post($(this).attr('action'),$(this).serialize(),function(data){
		$('#forgot').modal('hide');
		$('#answer .modal-content').html("<b>"+data+"</b>");
		Recaptchafree.reset()
		$('#answer').modal('show');
	});
});	
$(document).on('click','.regbtn',function(e){
	e.preventDefault();
	$('#login').modal('hide');
	$('#registar').modal('show');
});	
$(document).on('click','.listblockcity .letterlist a',function(e){
	e.preventDefault();
	id = $(this).data('city');
	$.get("/ajax/office.php", { city: id }, function(data) {
		
		//$('.peopl-carusel').html('');
		$('.reloadOffice').html('<p class="office-adress"><b>'+data.name+'</b>'+data.addr+'</p>'+
			'<ul class="office-box-info">'+
			'<li>'+
			'<i class="calendar2"></i>'+
			'<p><b>Пн-Пт:</b> '+data.hours+'</p>'+
			'<p><b>Сб,Вс:</b> '+data.holiday+'</p>'+
			'</li>'+
			'<li>'+
			'<i class="fa fa-phone fa-lg red-style"></i>'+
			'<p><b>'+data.phone+'</b></p>'+
			'<p>'+data.phone2+'</p>'+
			'</li>'+
			'</ul>');
		str= '';
		if(data.employ) {
			$.each(data.employ, function( i, v ){
				//$('.peopl-carusel').append(
				str +='<div class="item">'+
				'<div class="people">'+
				'<img src="'+v.img+'">'+
				'<p><b>'+v.name+'</b> <span>'+v.post+'</span></p>'+
				'</div>'+
				'</div>';
			});
			$('.peopl-carusel').trigger('replace.owl.carousel',str);
		}
		$.each(data.placemark, function( i, v ){
			BX_GMapAddPlacemark({'LON':v.LON,'LAT':v.LAT,'TEXT':v.TEXT}, 'googlemaps');
		});
		BX_GMapPanTo(data.lat,data.lon, 'googlemaps');
		
	},'json');
});
/****** логотип при наведении ... поменяйте картинку
$(document).on('mouseenter','.logoover',function(e){
 	$(this).attr('src','/bitrix/templates/tour/images/logo1.png');

});
$(document).on('mouseleave','.logoover',function(e){
 	$(this).attr('src','/bitrix/templates/tour/images/logosecondversion.png')
});
******/
$(document).on('click','.cityAll .letterlist a',function(e){
	e.preventDefault();
	id = $(this).data('city');
	txt = $(this).text();
	
	$(".fz-city :contains('"+txt+"')").attr("selected", "selected");
	
	getCityByIp(id);
	var city_id = $(this).attr('data-citytv');
	load_tours(city_id);
});
$(document).on('click','.cityAll2 .letterlist a',function(e){
	e.preventDefault();
	id = $(this).data('city');
	txt = $(this).text();
	
	$(".fz-city :contains('"+txt+"')").attr("selected", "selected");
	
	getCityByIp(id);

});
$(document).on('change','.modal-content .form-group input',function(){
	
	if($(this).val().length>3) {
		if($(this).closest('.form-group').find('formsucico').length==0) {
			$(this).after('<span class="glyphicon glyphicon-ok formsucico"></span>');
			$(this).closest('.form-group').addClass('has-success');
		}
	}
	else {
		ob = $(this).closest('.form-group');
		ob.find('formsucico').remove();
		ob.removeClass('has-success');
	}
	
});
$(document).on('submit','#loginForm',function(){
	var $this = $(this);
	var $form = {
		action: $this.attr('action'),
		post: {'ajax_key':ajaxLicKey}
	};
	$.each($('input', $this), function(){
		if ($(this).attr('name').length) {
			$form.post[$(this).attr('name')] = $(this).val();
		}
	});
	$.post($form.action, $form.post, function(data){
		$('input', $this).removeAttr('disabled');
		if (data.type == 'error') {
			$('#login .modal-body').prepend('<p class="bg-danger">'+data.message+'</p>');

		} else {
			window.location = '/lk/';
		}
	}, 'json');
	return false;
});
//login end

$(document).on('keyup','.latinz',function(e){
	v = $(this).val();
	v = v.replace(/[^a-z0-9_-]+/i, '');
	$(this).val(v);
});
$(document).on('change','select[name=night_ot]',function(e){
	$('select').styler('destroy');
	v = parseFloat($(this).val());
	x = v+14;
	$('select[name=night_do] option').remove();
	for(var i=v;i<=x;i++){
		$('select[name=night_do]').append('<option value="'+i+'">'+i+'</option>');
	}

	$('select').styler();
});
$(document).on('submit','#callback form',function(e){
	e.preventDefault();
	var dataForm = $(this).serialize()+'&web_form_submit=Y';

	getForm(3,dataForm);
});
$(document).on('submit','#question form',function(e){
	e.preventDefault();
	var dataForm = $(this).serialize()+'&web_form_submit=Y'; 

	getForm(2,dataForm); 

	
});
$(document).on('submit','#employe form',function(e){
	e.preventDefault(); 
	var dataForm = $(this).serialize()+'&web_form_submit=Y';

	getForm(7,dataForm); 
});
$(document).on('submit','#jobform form',function(e){
	e.preventDefault();
		//var dataForm =  new FormData($('form[name=jobform]')[0]); 
		var dataForm = $(this).serialize()+'&web_form_submit=Y';
		
		getForm(6,dataForm);	
	});
$(document).on('submit','#soc form',function(e){
	e.preventDefault();
	var dataForm = $(this).serialize()+'&web_form_submit=Y';

	getForm(9,dataForm);	
});
$(document).on('submit','#order form',function(e){
	e.preventDefault();
	var dataForm = $(this).serialize()+'&web_form_submit=Y';

	getForm(5,dataForm);	
});
$(document).on('click','.full-news img',function(e){
	e.preventDefault();
	$('.imagepreview').attr('src', $(this).attr('src'));
	$('#imagemodal').modal('show');  
});

/**********************
своя обработка форм
**********************/
function getForm(id,data){
	$.ajax({
		url: '/ajax/form.php?id='+id,
		type: 'POST',
		data: data,
		success: function(data){
			$("#callback").modal('hide');
			$("#question").modal('hide');
			$("#employe").modal('hide');
			$("#jobform").modal('hide');
			$("#soc").modal('hide');
			$("#order").modal('hide');

			$("#answer .modal-content").html(data);

			var captcha = $("#answer .modal-content form tbody tr:last-child td:first-child").html()
			var text = $("#answer .modal-content form tbody tr:last-child td:last-child").html()
			//alert(captcha)
			$("#answer .modal-content form tbody tr:last-child td:last-child").html(captcha)
			$("#answer .modal-content form tbody tr:last-child td:first-child").html(text)
			Recaptchafree.reset()
			$('#answer .modal-content form tbody tr').each(function(){
				if($(this).find('td').eq(0).text() == '') {
					$(this).remove();
				}
			})
			$('#answer .modal-content form input[type="submit"]').addClass('btnformmodalred')

			$(".data-table tr td:first-child").hide()

			if(id == 2){
				$("#answer .modal-content").prepend('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button><h4 class="modal-title" id="myModalLabel">Задать вопрос</h4></div>')
			}

			$("#answer").modal('show');
		}
	});
	Recaptchafree.reset();
}
if($(window).width()<1000) {
	$('#franchize').after('<section class="vertical-scrolling"  id="teach">'+
		'<div class="container franch" >'+
		'<div  class="row row-flex row-flex-wrap" >'+
		'<div class="col-xs-12" >'+$('#franchize .mobile-section').html()+'</div></div></div></section>');
	$('#articles').after('<section class="vertical-scrolling"  id="artic">'+
		'<div class="container reviewnart" >'+
		'<div  class="row" >'+
		'<div class="col-xs-12 articles" >'+$('#articles .articles').html()+'</div></div></div></section>');
	$('#articles .articles').remove();
	
}

if($(window).width()< 1000	) {
	$('.onlyPc').remove();
	$('#fullPage').fullpage({
		sectionSelector: '.vertical-scrolling',
		lazyLoading: true,
		controlArrows: false,
		easing: 'easeInOutCubic',
		normalScrollElements: '.cityAll2, .navigation',
		fixedElements: '.footer, .navbar',
		afterRender: function(){
			verticalCentered: true
		}
	});
} 
else {
	$('#fullPage').fullpage({
		sectionSelector: '.vertical-scrolling',
		slideSelector: '.slideTur',
		controlArrows: true,
		lazyLoading: true,
		scrollHorizontally: true,
		interlockedSlides:true,
		continuousHorizontal:true,
		dragAndMove:true,
		responsiveSlides:true,
		easing: 'easeInOutCubic',
		fixedElements: '.footer, .navbar',
		afterLoad: function(anchorLink, index){
			//alert(anchorLink)
		},
		afterRender: function(){
			verticalCentered: true
		},
		onLeave: function(index, nextIndex, direction){
			var leavingSection = $(this);
			
            //after leaving section 2
            
            if(index ==1 && direction =='down' ){
            	$('#scroller').fadeIn();
            }
            if(index ==2 && direction =='up' ){
            	$('#scroller').fadeOut();
            }



             //Animated blocks start


             if( index == 1 ) {
             	var sec = $('section').eq(index).find('.fp-tableCell')
             	sec.find('.hottur').css('animation-delay', '0.7s');
             	sec.find('.hottur').addClass('animated zoomInDown');
             	sec.find('.hotturblock').css('animation-delay', '2s');
             	sec.find('.hotturblock').addClass('animated zoomIn');

             	$('.fp-next, .fp-prev').css({
             		'opacity': 0
             	})
             	$('.fp-next, .fp-prev').delay(2500).animate({
             		'opacity': 1
             	})
             }
             if( index == 2) {
             	if($('#fullPage>section').length == 8) {
             		var sec = $('section').eq(index).find('.fp-tableCell')
             		sec.find('.poputki .owl-item.active .item').eq(0).css('animation-delay', '1.5s');
             		sec.find('.poputki .owl-item.active .item').eq(1).css('animation-delay', '1.8s');
             		sec.find('.poputki .owl-item.active .item').eq(2).css('animation-delay', '2.1s');
             		sec.find('.poputki .owl-item.active .item').addClass('animated flipInY');
             		sec.find('.poputchik').css('animation-delay', '.6s');
             		sec.find('.poputchik').addClass('animated rollIn');
             		sec.find('.btnusers').css('animation-delay', '2.6s');
             		sec.find('.btnusers').addClass('animated zoomInDown');
             	}
             	else {
             		var sec = $('section').eq(2).find('.fp-tableCell')
             		sec.find('.hottur').css('animation-delay', '0.7s');
             		sec.find('.hottur').addClass('animated flipInY');
             		sec.find('.hotturblock').css('animation-delay', '2s');
             		sec.find('.hotturblock').addClass('animated zoomIn');
             	}

             }
             if(index == 3) {
             	if($('#fullPage>section').length == 8) {
             		var sec = $('section').eq(index).find('.fp-tableCell')
             		sec.find('.reviews').css('animation-delay', '0.7s');
             		sec.find('.reviews').addClass('animated slideInUp');
             		sec.find('.articles').css('animation-delay', '1s');
             		sec.find('.articles').addClass('animated slideInUp');
             	}
             	else {
             		var sec = $('section').eq(index).find('.fp-tableCell')
             		sec.find('.poputki .owl-item.active .item').eq(0).css('animation-delay', '1.5s');
             		sec.find('.poputki .owl-item.active .item').eq(1).css('animation-delay', '1.8s');
             		sec.find('.poputki .owl-item.active .item').eq(2).css('animation-delay', '2.1s');
             		sec.find('.poputki .owl-item.active .item').addClass('animated flipInY');
             		sec.find('.poputchik').css('animation-delay', '.6s');
             		sec.find('.poputchik').addClass('animated rollIn');
             		sec.find('.btnusers').css('animation-delay', '2.6s');
             		sec.find('.btnusers').addClass('animated zoomInDown');

             	}

             }
             if( index == 4 ) {
             	if($('#fullPage>section').length == 8) {
             		var sec = $('section').eq(index).find('.fp-tableCell')

             		sec.find('.pc-ver').css('animation-delay', '0.7s');
             		sec.find('.pc-ver').addClass('animated rotateInDownLeft');
             		sec.find('.mobile-section').css('animation-delay', '0.7s');
             		sec.find('.mobile-section').addClass('animated rotateInUpRight');
             	}
             	else {
             		var sec = $('section').eq(index).find('.fp-tableCell')
             		sec.find('.reviews').css('animation-delay', '0.7s');
             		sec.find('.reviews').addClass('animated slideInUp');
             		sec.find('.articles').css('animation-delay', '1s');
             		sec.find('.articles').addClass('animated slideInUp');
             	}

             }
             if( index == 5 && nextIndex == 6) {
             	if($('#fullPage>section').length == 8) {
             		var sec = $('section').eq(index).find('.fp-tableCell');
             		sec.find('.reviewlink, .workers .owl-item.active .item , .addme, .ourpeople').css('opacity', '0');
             		sec.find('.reviewlink').delay(2100).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(0).delay(900).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(1).delay(1200).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(2).delay(1500).animate({
             			'opacity': 1
             		})
             		sec.find('.addme').delay(1800).animate({
             			'opacity': 1
             		})
             		sec.find('.ourpeople').delay(600).animate({
             			'opacity': 1
             		})
             	}
             	else {
             		var sec = $('section').eq(index).find('.fp-tableCell')

             		sec.find('.pc-ver').css('animation-delay', '0.7s');
             		sec.find('.pc-ver').addClass('animated rotateInDownLeft');
             		sec.find('.mobile-section').css('animation-delay', '0.7s');
             		sec.find('.mobile-section').addClass('animated rotateInUpRight');
             	}

             }
             if( index == 6 && nextIndex == 7) {
             	//alert(index)
             	if($('#fullPage>section').length == 8) {
             		$('.navbar').addClass('bgblack')
             	}
             	else {
             		
             		var sec = $('section').eq(index).find('.fp-tableCell');
             		sec.find('.reviewlink, .workers .owl-item.active .item , .addme, .ourpeople').css('opacity', '0');
             		sec.find('.reviewlink').delay(2100).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(0).delay(900).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(1).delay(1200).animate({
             			'opacity': 1
             		})
             		sec.find('.workers .owl-item.active .item').eq(2).delay(1500).animate({
             			'opacity': 1
             		})
             		sec.find('.addme').delay(1800).animate({
             			'opacity': 1
             		})
             		sec.find('.ourpeople').delay(600).animate({
             			'opacity': 1
             		})
             		$('.navbar').removeClass('bgblack')
             	}

             }
             if( index == 7 && nextIndex == 8) {
             	//alert(index)
             	if($('#fullPage>section').length == 8) {
             		$('.navbar').removeClass('bgblack')
             	}
             	else {
             		$('.navbar').addClass('bgblack')
             	}

             }
             if((index == 8) || (index == 7)) {
             	if($('#fullPage>section').length == 8) {
             		if(nextIndex == 8 || nextIndex == 6) {
             			$('.navbar').removeClass('bgblack')
             		}
             	}
             	else {
             		if(nextIndex == 9 || nextIndex == 7) {
             			$('.navbar').removeClass('bgblack')
             		}
             	}
             }
             if((index == 9) || (index == 8)) {
             	if($('#fullPage>section').length == 8) {
             		if(nextIndex == 7) {
             			$('.navbar').addClass('bgblack')
             		}
             	}
             	else {
             		if(nextIndex == 8) {
             			$('.navbar').addClass('bgblack')
             		}
             	}
             }
             

            //Animated blocks end


        }
    });
}

function getCurort(){
	cntr = '';
	if($('select[name="countryz"]').val()){
		cntr = '&regcountry='+$('select[name="countryz"] :selected').data('cid');
	}
	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=region"+cntr+"&callback=?", function(data) {
		var opts='<option value="0">выберите курорт</option>';
		for(var ii = 0; ii<data.lists.regions.region.length; ii++) {
			if(data.lists.regions.region[ii].name==$('select[name="curort"]').data('editid')) sel="selected"; else sel="";
			opts=opts+'<option value="'+data.lists.regions.region[ii].name+'" '+sel+' data-kid="'+data.lists.regions.region[ii].id+'">'+data.lists.regions.region[ii].name+'</option>';
		}
		$('select[name="curort"]').html(opts);
	});
	refresher()
}
function getCountry(){
	cid = $('select[name="cityID"]').val();
	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&cndep="+cid+"&type=country&callback=?", function(data) {
		var hht="";
		var opts="<option value='0'>Выберите страну</option>";

		for(var ii = 0; ii<data.lists.countries.country.length; ii++) {
			opts=opts+"<OPTION value='"+data.lists.countries.country[ii].id+"'>"+data.lists.countries.country[ii].name+"</option>";
		}

		$('select[name="countryID"]').html(opts);

	});
	refresher();
}

function getCountryz(){
	cid =$('select[name="cityz"] :selected').data('tvid');
	if(cid!==undefined)	$('input[name=tvid]').val(cid);

	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&cndep="+cid+"&type=country&callback=?", function(data) {

		var opts="<option value='0'>Выберите страну</option>";

		for(var ii = 0; ii<data.lists.countries.country.length; ii++) {
			if(data.lists.countries.country[ii].name==$('select[name="countryz"]').data('editid')) sel="selected"; else sel="";

			opts=opts+"<OPTION value='"+data.lists.countries.country[ii].name+"' data-cid='"+data.lists.countries.country[ii].id+"' "+sel+">"+data.lists.countries.country[ii].name+"</option>";
		}
		$('select[name="countryz"]').html(opts);
	});


	refresher()
}

function getPic(){
	ob = $('.sliderhotel .hotel.nobgr:eq(0)');
	txt = ob.data('hid');
	if(txt!==undefined) {
		$.get("/ajax/getinfo.php",{a:'pic',id:txt},function(data){
			if(data!='')
				ob.css("background-image","url("+data+")");
			setTimeout(function() { getPic() }, 500);
			ob.removeClass('nobgr');
			
		});
		
	}
	
	if(ob.parent().css('display')=='none'){
		inProgress = false;
	}
	else {
		inProgress = true;
	}
}

$(document).ready(function() {
	
	if($('.sliderhotel .hotel.nobgr').length) {
		getPic();
	}
	if($('input[name=form_hidden_82]').length){
		$('input[name=form_hidden_82]').val(userCity);
	}
	if($('#touradd').length){
		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=operator&callback=?", function(data) {
			var opts='<option value="0">выберите</option>';
			for(var ii = 0; ii<data.lists.operators.operator.length; ii++) {
				if(data.lists.operators.operator[ii].russian==$('.turopers').data('editid')) sel="selected"; else sel="";
				opts=opts+'<option value="'+data.lists.operators.operator[ii].russian+'" '+sel+'>'+data.lists.operators.operator[ii].russian+'</option>';
			}
			$('.turopers').html(opts);
			refresher()
		});
		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=departure&callback=?", function(data) {
			var opts="<option value='0'>Выберите город</option>";
			
			for(var ii = 0; ii<data.lists.departures.departure.length; ii++) {
				if(data.lists.departures.departure[ii].name==$('select[name="cityz"]').data('editid')) sel="selected"; else sel="";
				
				opts=opts+"<option value='"+data.lists.departures.departure[ii].name+"' data-tvid='"+data.lists.departures.departure[ii].id+"' "+sel+">из "+data.lists.departures.departure[ii].name+"</option>";
			}
			$('select[name="cityz"]').html(opts);
			refresher()
		});
		if($('select[name="countryz"]').data('editid')!=""){
			
			getCountryz()
		}
		if($('select[name="curort"]').data('editid')!=""){
			getCurort()
		}
		$(document).on('change','select[name="cityz"]',function(){
			
			getCountryz()
		});
		$(document).on('change','select[name="countryz"]',function(evt){
			getCurort();
		});
		$(document).on('change','select[name="curort"]',function(evt){
			if($(this).val()!=='0') {
				$('.hiddenifneed').hide();
				$('input[name=curort_new]').val('');
			}
			else {
				$('.hiddenifneed').show();
			}
		});
	}
	if($('select[name="cityID"]').length){

		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=departure&callback=?", function(data) {
			var hht="";
			var opts="";
			var city=userCity;
			for(var ii = 0; ii<data.lists.departures.departure.length; ii++) {

				if(city==data.lists.departures.departure[ii].name) ccity=" selected"; else ccity ="";
				opts=opts+"<OPTION value='"+data.lists.departures.departure[ii].id+"'"+ccity+">"+data.lists.departures.departure[ii].name+"</OPTION>";
			}

			$('select[name="cityID"]').html(opts);
			
		}).done(function() {
			getCountry();
		});
		$(document).on('change','select[name="cityID"]',function(){ 
			getCountry();
		});

	}
	if($('.turoperators').length){
		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=operator&callback=?", function(data) {
			var hht="";
			var opts="";

			for(var ii = 0; ii<data.lists.operators.operator.length; ii++) {


				opts=opts+'<li><span class="checkme"></span><input type="checkbox" name="operator[]" value="'+data.lists.operators.operator[ii].id+'" class="hidecheck">  <label class="checkb">'+data.lists.operators.operator[ii].russian+'</label></li>';

			}

			$('.turoperators').html(opts);
		});
	} 
	if($('.regionskurort').length){
		cntr = '';
		if($('select[name="countryID"]').val()){
			cntr = '&regcountry='+$('select[name="countryID"]').val();
		}

		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=region"+cntr+"&callback=?", function(data) {
			var hht="";
			var opts="";

			for(var ii = 0; ii<data.lists.regions.region.length; ii++) {

				opts=opts+'<li><span class="checkme"></span><input type="checkbox" name="curort[]" value="'+data.lists.regions.region[ii].id+'" class="hidecheck" id="kid'+data.lists.regions.region[ii].id+'" data-country="'+data.lists.regions.region[ii].country+'"/>  <label class="checkb" for="kid'+data.lists.regions.region[ii].id+'">'+data.lists.regions.region[ii].name+'</label></li>';

			}

			$('.regionskurort').html(opts);
		});


		$(document).on('change','select[name="countryID"]',function(evt){
			id = $(this).val();
			cntr = '&regcountry='+id;


			$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=region"+cntr+"&callback=?", function(data) {
				var hht="";
				var opts="";

				for(var ii = 0; ii<data.lists.regions.region.length; ii++) {

					opts=opts+'<li><span class="checkme"></span><input type="checkbox" name="curort[]" value="'+data.lists.regions.region[ii].id+'" class="hidecheck" id="kid'+data.lists.regions.region[ii].id+'" data-country="'+data.lists.regions.region[ii].country+'"/>  <label class="checkb" for="kid'+data.lists.regions.region[ii].id+'">'+data.lists.regions.region[ii].name+'</label></li>';

				}

				$('.regionskurort').html(opts);
			});

		});
	}
	if($('.hotelscheck').length){
		if($('select[name="countryID"]').val()){
			hotelsReload();
			$(document).on('change','select[name="countryID"]',function(evt){
				hotelsReload();
			});
			$(document).on('change','input[name="curort[]"]',function(evt){
				hotelsReload();
			});
			$(document).on('change','select[name="raiting"]',function(evt){
				hotelsReload();
			});
			$(document).on('click','.starq label',function(evt){
				evt.preventDefault();
				$(this).prev().attr('checked',true);
				hotelsReload();
			});
		}
	}
});

function refresher(){
	setTimeout(function() {
		$('select').trigger('refresh');
	}, 1000)
}
function hotelsReload(){
	
	if($('select[name="countryID"]').val()==0) return;
	
	var  cntr = '';
	var  strr = '';
	var  hotregion  = '';
	$('input[name="curort[]"]:checked').each(function(){
		hotregion = $(this).val()+',';
	});
	$('input[name="type[]"]:checked').each(function(){
		if( $(this).val()=='active') strr += '&hotactive=1';
		if( $(this).val()=='relax') strr += '&hotrelax=1';
		if( $(this).val()=='family') strr += '&hotfamily=1';
		if( $(this).val()=='health') strr += '&hothealth=1';
		if( $(this).val()=='city') strr += '&hotcity=1';
		if( $(this).val()=='beach') strr += '&hotbeach=1';
		if( $(this).val()=='deluxe') strr += '&hotdeluxe=1';

	});
	var  hotstars  = '';
	var  hotrating  = '';
	

	
	if($('select[name="countryID"]').val()!='') cntr = '&hotcountry='+$('select[name="countryID"]').val();
	if($('select[name="raiting"]').val()!='') hotrating = '&hotrating='+$('select[name="raiting"]').val();
	if($('input[name="hotelstar"]:checked').val()!==undefined) hotstars = '&hotstars='+$('input[name="hotelstar"]:checked').val();
	if(hotregion.length>0) {
		hotregion = hotregion.slice(0, -1);
		hotregion = "&hotregion="+hotregion;
	}

	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=hotel"+cntr+hotregion+strr+hotstars+hotrating+"&callback=?", function(data) {
		var hht="";
		var opts="";
		if(data.lists.hotels.hotel.length>0){
			for(var ii = 0; ii<data.lists.hotels.hotel.length; ii++) {

				opts=opts+'<li><span class="checkme"></span><input type="checkbox" name="hotel[]" value="'+data.lists.hotels.hotel[ii].id+'" class="hidecheck"> <label class="checkb">'+data.lists.hotels.hotel[ii].name+' '+data.lists.hotels.hotel[ii].stars+'*</label></li>';

			}

		}

		$('.hotelscheck').html(opts);
	});
}

$(document).on('click','#addRewv .submt',function(e){
	var formData = new FormData($('form#addRewv')[0]);
	$.ajax({
		type: 'POST',
		url: '/ajax/addrewv.php',
		data: formData,
		contentType:false,
		processData: false,
		success:function (data){ 
			if(data=='ok'){
				$("#addrewiev").modal('hide');
				$("#addRewv")[0].reset();
				$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>Спасибо, ваш отзыв принят!</h1><p></p></div>');
			}
			else {
				$("#answer .modal-content").html(data);
			}
			$("#answer").modal('show');

		}
	});

});

$(document).on('click','.closeNews',function(evt){
	$('.topNews').remove();
});
$(document).on('change','input[name="coverimage"]',function(evt){
	
	var files = evt.target.files;
	for (var i = 0, f; f = files[i]; i++) {
		if (!f.type.match('image.*')) {
			continue;
		}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				a = e.target.result;
				b = escape(theFile.name);
				$('#loadpic').html('<img class="thumb" src="'+a+'" title="'+b+'"/>');
				$('#loadpic').removeClass('fa');
				$('#loadpic').removeClass('fa-photo');
			};
		})(f);
		reader.readAsDataURL(f);
	}

});
$(document).on('change','input[name="PERSONAL_PHOTO"]',function(evt){
	
	var files = evt.target.files;
	for (var i = 0, f; f = files[i]; i++) {
		if (!f.type.match('image.*')) {
			continue;
		}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				a = e.target.result;
				b = escape(theFile.name);
				$('.ava').html('<img class="thumb" src="'+a+'" title="'+b+'"/>');
			};
		})(f);
		reader.readAsDataURL(f);
	}

});
$(document).on('change','input[name="cover"]',function(evt){
	
	var files = evt.target.files;
	for (var i = 0, f; f = files[i]; i++) {
		if (!f.type.match('image.*')) {
			continue;
		}
		var reader = new FileReader();
		reader.onload = (function(theFile) {
			return function(e) {
				a = e.target.result;
				b = escape(theFile.name);
				$('.pict').html('<img class="thumb" src="'+a+'" title="'+b+'" width="100%"/>');

			};
		})(f);
		reader.readAsDataURL(f);
	}

});
$(document).on('click','.addpicfortour',function(e){
	$('input[name="coverimage"]').click();
});
$(document).on('submit','#touradd',function(e){
	e.preventDefault();
	txt="";
	
	if($("select[name=cityz]").val()=='0'||$("select[name=countryz]").val()=='0'||($("select[name=curort]").val()=='0'&&$("input[name=curort_new]").val()=='')){
		$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>Обязательные поля не заполнены</h1><p>'+txt+'</p></div>');
		$("#answer").modal('show');
	}
	else{
		var formData = new FormData($('form#touradd')[0]);
		$.ajax({
			type: 'POST',
			url: '/ajax/addTour.php',
			data: formData,
			contentType:false,
			processData: false,
			dataType: 'json',
			beforeSend:function (){
				$(".activebtn").before('<i class="fa fa-cloud-download">ADDING...</i>');
				$(".activebtn").hide();
			}, 
			success:function (data){
				if(data.success){
					$(".activebtn").show();
					
					$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>'+data.success+'</h1><p>'+data.description+'</p></div>');
					window.location.href= "/lk/";
					$(".lk-menu button:first-child").click();
					$("#touradd")[0].reset();
				}
				else {
					$("#answer .modal-content").html(data);
				}
				$("#answer").modal('show');
			}
		});
	}
});
$(document).on('submit','form#discounts',function(e){
	e.preventDefault();
	var formData = new FormData($('form#discounts')[0]);
	$.ajax({
		type: 'POST',
		url: '/ajax/discounts.php',
		data: formData,
		contentType:false,
		processData: false,
		dataType: 'json',
		success:function (data){
			if(data.success){
				$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>'+data.success+'</h1><p>'+data.description+'</p></div>');
			}
			else {
				$("#answer .modal-content").html(data.er);
			}
			$("#answer").modal('show');
		}
	});
});
$(document).on('click','button.action',function(e){
	$('.tabz').addClass('disabled');
	id = $(this).data('id');
	$('.hot-'+id).removeClass('disabled');
	$('button.action').removeClass('active');
	$(this).addClass('active');
});
$(document).on('click','.newpreson h1 span',function(e){
	e.preventDefault();
	$(this).closest('.newpreson').remove();
});	
$(document).on('click','.dropthat',function(e){
	e.preventDefault();
	$(this).closest('.newpreson').remove();
});	
$(document).on('click','.addchild',function(e){
	e.preventDefault();
	forma = $('.touristik').html();
	forma = '<div class="newpreson"><h1>Добавление ребенка <span>X</span></h1>' + forma + '<a class="dropthat">отменить</a></div>';
	$(this).closest('.row').before(forma);
});	
$(document).on('click','.addtourists',function(e){
	e.preventDefault();
	forma = $('.touristik').html();
	forma = '<div class="newpreson"><h1>Добавление туриста <span>X</span></h1>' + forma + '<a class="dropthat">отменить</a></div>';
	$(this).closest('.row').before(forma);
});		
$(document).on('change','input[name=kount]',function(){
	
	k = $(this).val();
	id = $('input[name=touridonline]').val();
	
});
$(document).on('click','#buyme .byeme',function(){
	
	window.location.href = "/order/"+$('input[name=touridonline]').val()+"?k="+$('input[name=kount]').val();
});
$(document).on('change','#summapay',function(e){
	s = $(this).val();
	$('input[name=Amount]').val(parseFloat($('input[name=SUM]').val())/100*parseFloat(s));
});
$(document).on('click','.sale-order-detail-payment-options-methods-button-element',function(e){
	
	$('.sale-order-detail-payment-options-methods-information-block').hide();
	$('.sale-order-detail-payment-options-methods-template').show();
});
$(document).on('click','.showmeall',function(e){
	$('.fulltable').hide();
	$(this).next().find('.fulltable').show();
});
$(document).on('click','.saveorderform',function(e){
	e.preventDefault();
	$.get('/ajax/save.php',$('#bigorder').serialize(),function(data){
		if(data.suc=='ok'){
			window.location.href = "/order/success.php?id="+data.id;
		}
	},'json');
	
});
$(document).on('click','.subscr',function(){
	soc = $.trim($(this).attr('class').replace('subscr',''));
	switch(soc){
		case 'whatsap': id=69; name="What's App"; break;
		case 'viber': id=70; name="Viber"; break;
		case 'telegram': id=71; name="Telegramm"; break;
		default: id=72; name="SMS"; break;
	}
	
	$('#soc #myModalLabel').html("Подписка на "+name+" рассылку");
	$('input[name=form_text_74]').val(userCity);
	$('input[name=form_dropdown_social]').val(id);
});
$(document).on('click','.hotlistover p',function(){
	
	window.location.href="/content/tours/";
	
});
$(document).on('click','.switchlang',function(){
	
	l = $(this).data('letter');
	$('.letter').removeClass('sels');
	$('.switchlang').removeClass('selec');
	$(this).addClass('selec');
	$('.letter.'+l).addClass('sels');
});
$(document).on('change','select[name="srch_kur_name"]',function(){
	foundHotel();
});
$(document).on('change','select[name="srch_cat_name"]',function(){
	foundHotel();
});
$(document).on('click','.letter a',function(){
	$('.letter a').removeClass('act');
	$(this).addClass('act');
	foundHotel()
});

if($('input[name=filter_city]').length){

	$('input[name=filter_city]').autocomplete({
		source: function(req, add){
			if($('input[name=filter_city]').val()!==null) {
				$.getJSON("/ajax/touvisor.php?city=1&callback=?", req, function(data) {
					var array = data.error ? [] : $.map(data.list, function(m) {
						return {
							label: m.label,
							value: m.value,
							id: m.id
						};
					});
					add(array);
				});
			}
		}
	});
}
if($('input[name=filter_country]').length){

	$('input[name=filter_country]').autocomplete({
		source: function(req, add){
			if($('input[name=filter_country]').val()!==null) {
				$.getJSON("/ajax/touvisor.php?country=1&callback=?", req, function(data) {
					var array = data.error ? [] : $.map(data.list, function(m) {
						return {
							label: m.label,
							value: m.value,
							id: m.id
						};
					});
					add(array);
				});
			}
		}
	});
}
function foundHotel(){
	var letter = $('.letter a.act').data('index');
	var curort = $('select[name="srch_kur_name"]').val();
	var cat = $('select[name="srch_cat_name"]').val();
	$( ".hotel" ).each(function( index ) {
		
		a1 = true;
		a2 = true;
		a3 = true;
		
		var l = $(this).data('firstletter');
		var t = $(this).data('type');
		var r = $(this).data('regions');
		if(letter!==undefined) { if(letter==l) { a1=true; } else a1=false; }
		if(curort!=='') { if(curort==r) { a2=true; } else a2=false; }
		if(cat!=='') { if( t.indexOf(cat, 0) >0 ) { a3=true; } else a3=false; }
		//console.log(letter +'/ ' +curort+'/ ' +cat);
		if(a1&&a2&&a3){
			$(this).parent().css('display','block');
		}
		else {
			$(this).parent().css('display','none');
		}
	});
	
	$grid.masonry('layout');
	
}
function searchrow(){
	var srch_city = $('input[name="filter_city"]').val();
	var srch_cntr = $('input[name="filter_country"]').val();
	$('.table-striped tbody tr td:nth-child(2)').each(function(index){
		ob = $(this).closest('tr');
		var flag = false;
		var flag2 = false;
		txt = $(this).text();
		
		if(srch_city!=""){
			if(txt.indexOf(srch_city)>=0){
				flag = true;
			}
			if(srch_cntr==""){
				flag2 = true;
			}
		}
		if(srch_cntr!=""){
			if(txt.indexOf(srch_cntr)>=0){
				flag2 = true;
			}
			if(srch_city==""){
				flag = true;
			}
		}
		if(srch_cntr==""&&srch_city==""){
			flag = true;
			flag2 = true;
		}
		if(flag&&flag2){
			ob.show();
		}
		else {
			ob.hide();
		}
	});
}
$(document).on('change','input[name="filter_country"]',function(e){
	e.preventDefault();
	searchrow();
});
$(document).on('change','input[name="filter_city"]',function(e){
	e.preventDefault();
	searchrow();
});
$(document).on('click','.searchline button',function(e){
	e.preventDefault();
	searchrow();
});
$(document).on('click','.chatbot a',function(e){
	e.preventDefault();
	var formData = new FormData($('form#chatmeplease')[0]);
	$.ajax({
		type: 'POST',
		url: '/ajax/chat.php',
		data: formData,
		contentType:false,
		processData: false,
		dataType: 'json',
		success:function (data){ //$("#anketaComp").serialize(),function(data){
			if(data.success){
				
				$(".chatroom").append( '<div class="chatline ">'+
					'<div class="chatpic">'+
					'<div class="img"><img src="'+data.pic+'" /></div>'+
					'</div>'+
					'<div class="chattext">'+
					'<p>'+data.txt+'</p>'+
					'</div>'+
					'<div class="chatdate">'+
					'<span class="time">'+data.date+'</span>'+
					'</div>'+
					'</div>');
			}
			else {
				$("#answer .modal-content").html(data.er);
				Recaptchafree.reset()
				$("#answer").modal('show');
			}
			
			
		}
	});
});
$(document).on('click','.chatbot .addfile',function(){
	$(".chatbot input[type=file]").click();
});
$(document).on('click','.msglines',function(){
	id = $(this).data('id');
	$('input[name="chatid"]').attr('value',id);
	$.get('/ajax/chat.php',{id:id},function(data){
		
		var str;
		if(data.err) {
			$('.chatroom').html(data.err);
		}
		else {

			$.each(data.msg, function(i, v){
				str += '<div class="chatline ">'+
				'<div class="chatpic">'+
				'<div class="img"><img src="'+v.pic+'" /></div>'+
				'</div>'+
				'<div class="chattext">'+
				'<p>'+v.txt+'</p>'+
				'</div>'+
				'<div class="chatdate">'+
				'<span class="time">'+v.time+'</span>'+
				'</div>'+
				'</div>';
			});
			
			$('.chatroom').html(str);
			$('.userinfo .fio').html(data.fio);
			
		}
		$('.onlinechat').show();
	},'json');
	
	
});
$(document).on('click','#searchbtnb',function(){
	window.location.href="/search/";
	
	
});
$(document).on('click','#docs .send',function(e){
	$.get('/ajax/lkfiles.php',{id:$(this).closest('tr').data('rowid'),action:'send'},function(data){
		if(data!=='') {
			window.location.href=data;
		}
	});
});
$(document).on('click','#docs .download',function(e){
	$.get('/ajax/lkfiles.php',{id:$(this).closest('tr').data('rowid'),action:'download'},function(data){
		if(data!=='') {
			window.location.href=data;
		}
	});
});
$(document).on('click','#docs .print',function(e){
	$.get('/ajax/lkfiles.php',{id:$(this).closest('tr').data('rowid'),action:'print'},function(data){
		if(data!=='') {
			window.location.href=data;
		}
	});
});
$(document).on('click','#docs .delete',function(e){
	ob = $(this);
	$.get('/ajax/lkfiles.php',{id:ob.closest('tr').data('rowid'),action:'del'},function(data){
		if(data=='ok') {
			ob.closest('tr').remove();
		}
	});
});
$(document).on('click','form#loadFile button',function(e){
	e.preventDefault();
	if($(".docsName").val()=="") {
		alert('укажите название файла')
	}
	else {
		$('input[name="upload"]').click();
	}
	
	
	
});
$(document).on('change','form#loadFile input[name="upload"]',function(e){
	e.preventDefault();
	if($(".docsName").val()=="") {
		alert('укажите название файла')
	}
	else {
		$('form#loadFile button').attr("disabled",true);
		var progressBar = $('#progressbar');
		var formData = new FormData($('form#loadFile')[0]);
		$.ajax({
			type: 'POST',
			url: '/ajax/lkfiles.php',
			data: formData,
			contentType:false,
			processData: false,
			dataType: 'json',
			xhr: function(){
			var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
			xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
			  if(evt.lengthComputable) { // если известно количество байт
				// высчитываем процент загруженного
				var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
				// устанавливаем значение в атрибут value тега <progress>
				// и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
				progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
			}
		}, false);
			return xhr;
		},
		success:function (data){ //$("#anketaComp").serialize(),function(data){
			if(data.success){
				$("#docs table").append('<tr data-rowid="'+data.id+'">'+
					'<td>'+$(".docsName").val()+'</td>'+
					'<td>'+data.date+'</td>'+
					'<td>'+
					'<i class="fa fa-paper-plane-o send"></i>'+
					'<i class="fa fa-download download "></i>'+
					'<i class="fa fa-print print "></i>'+
					'<i class="fa fa-remove delete"></i>'+
					'</td>'+
					'</tr>');
				$(".docsName").val('');
				$('form#loadFile button').attr("disabled",false);
			}
			else {
				$("#answer .modal-content").html(data.er);
				Recaptchafree.reset()
				$("#answer").modal('show');
			}
			
			
		}
	});
	}
	
});
$(document).on('click','.voteemploy',function(){
	$('.dropemploy').find("option:contains('"+$(this).data('imya')+"')").attr("selected", "selected");
	$('.idemploy').val($(this).data('id'));
});
$(document).on('click','.subscbtn',function(){
	$.post('/ajax/ajax.php',{action:'email',email:$('.subscinp').val()},function(data){
		$('#answer .modal-content').text(data);
		Recaptchafree.reset()
		$('#answer').modal('show');
	});
});
$(document).on('click','.job-box .more',function(){
	$('#jobinfo').modal('show');
	
});
$(document).on('click','.expandMenu',function(){
	$('.navigation').show();
	
});
$(document).on('click','.cl',function(){
	$('.navigation').hide();
	
});
$(document).on('click','.citys span',function(){
	if($('.cityAll').css('display')=='none') {
		$('.cityAll').show();
		$('.cityAll').height($('#cityx').height())
		$.fn.fullpage.setAllowScrolling(false);


	}
	
});
$(document).on('mouseleave','.cityAll',function(e){
	$('.cityAll').hide();
	$.fn.fullpage.setAllowScrolling(true);
});
$(document).on('mouseleave','.navigation',function(e){
	$('.navigation').hide();
});
$(document).on('mouseleave','.addresses',function(e){
	//console.log(e.target);
	//if(e.target)
	$('.adressAll').hide();
});
$(document).on('click','.addresses',function(){
	$('.adressAll').show();
});
$(document).on('mouseover','.addresses b',function(){
	if($('.adressAll').css('display')=='none') {
		$('.adressAll').show();
	}
	else {
		$('.adressAll').hide();
	}
	
});
$(document).on('change','select[name="child"]',function(e){
	cnt = $(this).val();
	
	var optg='',adds='<p>Возраст детей</p>';
	$('.childs').css('color','#c9c9c9');
	$(this).css('color','#db3636');
	
	for(var i=1;i<=17;i++){
		optg += '<option value="'+i+'">'+i+'</option>';
	}
	for(var i=1;i<=cnt;i++){
		adds += '<div class="col-md-3"><select  name="child'+i+'" >'+optg+'</select></div>';
	}
	$('.ageOfChildz').html('<div class="form-group">'+adds+'</div>');
	refresher();
});
$(document).on('click','.childs',function(e){
	cnt = $(this).data('count');

	var optg='',adds='<h3>Возраст детей</h3>';
	$('.childs').css('color','#c9c9c9');
	$(this).css('color','#db3636');
	
	for(var i=1;i<=17;i++){
		optg += '<option value="'+i+'">'+i+'</option>';
	}
	for(var i=1;i<=cnt;i++){
		adds += '<select class="form-control" name="child'+i+'" >'+optg+'</select>';
	}
	$('.childyear').html(adds);
	$('input[name="child"]').val(cnt);
	if($('.pplcount .cntchld').length) {
		$('.pplcount .cntchld').html('Дет.: '+cnt);
	}
	else {
		fa = $('.turist[style*="rgb(219, 54, 54)"]');
		cntt = fa.data('count');
		$(".pplcount").html('<span class="cntparnt">Взр.: '+cntt+'</span> <span class="cntchld">Дет.: '+cnt+'</span> <i class="fa fa-sort-down"></i>');
	}


	refresher();
});
$(document).on('click','.turist',function(e){
	cnt = $(this).data('count');
	
	$('input[name="adult"]').val(cnt);
	
	
	$('.turist').css('color','#c9c9c9');
	$(this).css('color','#db3636');
	str='';
	if($('.pplcount .cntparnt').length) {
		$('.pplcount .cntparnt').html('Взр.: '+cnt);
	}
	else {
		fa = $('.childs[style*="rgb(219, 54, 54)"]');
		cntt = fa.data('count');
		if(cntt!==undefined){
			str = '<span class="cntchld">Дет.: '+cntt+'</span> ';
		}
		$(".pplcount").html('<span class="cntparnt">Взр.: '+cnt+'</span> '+str+'<i class="fa fa-sort-down"></i>');
	}
});
$(document).on('click','.pplcount ',function(e){
	$('.pplpopup').show();
});
$(document).on('click','.pplchoise',function(e){
	
	$('.pplpopup').hide();
});

function hblkhvr(){
	// $('.hotblocks').parent().hover(function(){
	// 	$(this).find('.hotdeals').addClass('active')
	// },function(){
	// 	$(this).find('.hotdeals').removeClass('active')
	// })
}
hblkhvr();
//$(document).on('mouseleave','.hotdeals',function(e){
//	$(this).hide();
//	$(this).prev().show();
//	
//});

$(document).on('mouseleave','.hotlistview',function(e){
	
	$(this).find('.hotlistover').hide();
	$(this).find('.hotlisted').show();
	
});
$(document).on('click','#cityx a',function(e){
	e.preventDefault();
	$('.cityAll').css("display","none");
	$('.cityAll a').removeClass('active');
	tx = $(this).text();
	$('.citys span').text(tx);
	$(this).addClass('active');
	
	
});
$(document).on('mouseover','.work-usr',function(){

	$(this).find('.work-overload').show();
});
$(document).on('mouseleave','.work-usr',function(){

	$(this).find('.work-overload').hide();
});
$(document).on('mouseover','.pictur',function(){

	$(this).find('.hideover').show();
});
$(document).on('mouseleave','.pictur',function(){

	$(this).find('.hideover').hide();
});
$(document).on('mouseover','.awards .pic',function(){

	$(this).find('.over').show();
});
$(document).on('mouseleave','.awards .pic',function(){

	$(this).find('.over').hide();
});
$(document).on('click','.mob-close',function(e){
	e.preventDefault();
	$('.adressAll').hide();
});
$(document).on('click','#cityx2 a',function(e){
	e.preventDefault();
	$('.cityAll2').css("display","none");
	$('.cityAll2 a').removeClass('active');
	tx = $(this).text();
	$('.mobile-city span').text(tx);
	$(this).addClass('active');
	
	
});
$(document).on('click','.payoffice',function(e){
	e.preventDefault();
	$('#order').modal('show');
});
$(document).on('click','.payonline',function(e){
	e.preventDefault();
	$('#buyme').modal('show');
});
$(document).on('click','.hotcity li a',function(e){ //удалить это? 
	e.preventDefault();
	txt = $(this).text();
	$(this).closest('.dropdown').find('.city-toggler').html(txt+'<b class="caret"></b>');
	$.get("/ajax/hotcity.php",{city:txt},function(data){
		var hotelz = '';
		$.each(data, function( index, value ){
			hotelz += '<div class="item " >'+
			'<div class="hotblocks" style="background-image: url('+value.pic+') !important;"  data-turid="'+value.id+'">'+
			'<div class="row">'+
			'<div class="col-md-6 col-sm-6 col-xs-6">'+
			'<span class="tur_country">'+value.country+'</span>'+
			'<span class="tur_city">'+value.curort+'</span>'+
			'</div>'+
			'<div class="col-md-6 col-sm-6 col-xs-6">'+
			'<span class="tur_discount"> </span>'+
			'</div>'+
			'</div>'+
			'<div class="row">'+
			'<div class="col-md-12 col-sm-12 col-xs-12">'+
			'<span class="tur_price">'+value.price+' Р</span>'+
			'<span class="tur_date"><i class="fa fa-plane redish"></i> Дата вылета: '+value.dayfrom+'</span>'+
			'<span class="tur_night"><i class="calendar1"></i> Количество ночей: '+value.daycnt+'</span>'+
			'<span class="tur_update"><i class="fa fa-refresh redish"></i> Обновлено: '+value.modify+'</span>'+
			'</div>'+
			'</div>'+
			'</div>'+
			'<div class="hotdeals">'+
			'<div>'+
			'<span>xxxx</span>'+
			'<span>xx дней</span>'+
			'<span>xxxxxx Р</span>'+
			'</div>'+
			'</div>'+
			'</div>';
		});
		if($('.gridview').length){
			$('.gridview').trigger('replace.owl.carousel',hotelz);
			$('.gridview').trigger('refresh.owl.carousel');
		}
	},'json');
});
$(document).on('click','.chkcur li label',function(e){
	e.preventDefault();
	ob = $(this).find('span');
	if(ob.hasClass( "checkme" )) {
		ob.removeClass("checkme");
		ob.addClass("checkeds");
		ob.html('<i class="fa fa-check "></i>');
		$(this).find('input').attr('checked',true);
	}
	else {
		ob.removeClass("checkeds");
		ob.addClass("checkme");
		ob.html('');
		$(this).find('input').attr('checked',false);
	}
	if($(this).hasClass('regionskurort')) hotelsReload();
});
$(document).on('click','.chkcur li',function(e){
	ob = $(this).find('span');
	if(ob.hasClass( "checkme" )) {
		ob.removeClass("checkme");
		ob.addClass("checkeds");
		ob.html('<i class="fa fa-check "></i>');
		$(this).find('input').attr('checked',true);
	}
	else {
		ob.removeClass("checkeds");
		ob.addClass("checkme");
		ob.html('');
		$(this).find('input').attr('checked',false);
	}
	if($(this).hasClass('regionskurort')) hotelsReload();
});
$(document).on('click','.pricebox span',function(e){
	$('.pricebox span').removeClass("sel");
	ob = $(this);
	if(!ob.hasClass( "sel" )) {
		ob.addClass("sel");
	}
	var pr = $('.pricebox .sel').text();
	
	if(pr=='руб') {
		var max = $( "#slider-range" ).slider( "option", "max" );
		$( "#slider-range" ).slider( "option", "max", max*10 );
		var min = $( "#slider-range" ).slider( "option", "min" );
		$( "#slider-range" ).slider( "option", "min", min*10 );
		var step = $( "#slider-range" ).slider( "option", "step" );
		$( "#slider-range" ).slider( "option", "step", step*10 );
		$('input[name=curency]').val('0');
	}
	else {
		var max = $( "#slider-range" ).slider( "option", "max" );
		$( "#slider-range" ).slider( "option", "max", max/10 );
		var min = $( "#slider-range" ).slider( "option", "min" );
		$( "#slider-range" ).slider( "option", "min", min/10 );
		var step = $( "#slider-range" ).slider( "option", "step" );
		$( "#slider-range" ).slider( "option", "step", step/10 );
		$('input[name=curency]').val('1');
	}
	
	$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " "+pr+" - " + $( "#slider-range" ).slider( "values", 1 )+" "+pr );
});
$(document).on('click','.hotelmenu.about',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').show();
	$(this).closest('.hotelline').find('.line-about').show();
});
$(document).on('click','.hotelmenu.map',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').show();
	$(this).closest('.hotelline').find('.line-map').show();
});
$(document).on('click','.hotelmenu.coments',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').show();
	$(this).closest('.hotelline').find('.line-coments').show();
});
$(document).on('click','.hotelmenu.prices',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').show();
	$(this).closest('.hotelline').find('.line-prices').show();
});
$(document).on('click','.getme.prices',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').show();
	$(this).closest('.hotelline').find('.line-prices').show();
});

$(document).on('click','.footlinez .clo',function(e){
	e.preventDefault();
	$('.xline').hide();
	$(this).closest('.hotelline').find('.box-prices').hide();
});

$(document).on('click','.searchall',function(e){
	if($('select[name="countryID"').val()=='0') {  

		$("#answer .modal-content").html("Сделайте выбор страны");
		Recaptchafree.reset()
		$("#answer").modal('show');
	}
	else {
		$.get('/ajax/search.php',$('#startsearch').serialize(),function(data){
			location.href="/search/"+data.result['requestid'];
		},'json');
	}
});
var sPage = 1;
$(document).on('click','.buythistour',function(e){
	e.preventDefault();
	id = $(this).data('tourid');
	window.location.href="/order/"+id;
});
$(document).on('click','.question-box li a',function(e){
	e.preventDefault();
	id = $(this).data('id');
	$("#results").html("<img src='/bitrix/templates/tour/images/89.gif' />");
	$.get("/ajax/faq.php", { id: id }, function(data) {
		$("#results").html(data);
	});
});
$(document).on('click','.table .copy',function(e){
	e.preventDefault();
	var id = $(this).data('id');
	ob = $(this).closest('tr');
	$.get("/ajax/turs.php", { id: id,action:'copy' }, function(data) {
		if(data!='') {
			txt = ob.html();
			txt = txt.replace(id,data);
			ob.after("<tr>"+txt+"</tr>");
		}
	});
});
$(document).on('click','.table .delete',function(e){
	e.preventDefault();
	var id = $(this).data('id');
	ob = $(this).closest('tr');
	$.get("/ajax/turs.php", { id: id,action:'delete' }, function(data) {
		if(data=='') {
			ob.remove();
		}
		else {
			alert(data);
		}
	});
});
$(document).on('click','.table .edit',function(e){
	e.preventDefault();
	var id = $(this).data('id');
	window.location.href = "?ID="+id;
});
$(document).on('click','.hotBaseAndDate .copy',function(e){
	e.preventDefault();
	var id = parseFloat($(this).closest('.hotBaseAndDate').data('rid'));
	rid = id+1;
	
	$('select').styler('destroy');
	var ob = $(this).closest('.hotBaseAndDate').clone().appendTo(".appendtome");
	
	
	
	$(this).closest('.hotBaseAndDate').next().find('.copyme').each(function(index){
		txt = $(this).attr('name');

		txt = txt.replace(/dates\[([0-9]*)\]/g,replacer);
		$(this).attr('name',txt);
	});
	$(this).closest('.hotBaseAndDate').next().find('h4 b').html(rid);
	
	$('select').styler();
	$('.dtp2').datetimepicker({
		locale: 'ru',
		format: 'DD.MM.YYYY LT',
		allowInputToggle:true
		
	}).on('dp.hide',function(e) {
		ob=$(this).closest('.hotBaseAndDate').find('.dataDeparture');
		ob.html($(this).val());
	});
	
	acompl();
	
});
$(document).on('click','.hotBaseAndDate .delete',function(e){
	e.preventDefault();
	var ob = $(this).closest('.hotBaseAndDate');
	var id = ob.data('rid');
	
	$.get("/ajax/hotbase.php", { id: id,action:'delete' }, function(data) {
		if(data=='') {
			ob.remove();
		}
		else {
			alert(data);
		}
	});
});
$(document).on('click','.hotBaseAndDate .edit',function(e){
	e.preventDefault();
	$('.hotelbasehide').hide();
	var ob = $(this).closest('.hotBaseAndDate').find('.hotelbasehide');
	ob.show();
	//window.location.href = "?ID="+id;
});
$(document).on('click','.remrow',function(e){
	$(this).closest('.form-group').remove();
});
$(document).on('click','.addrow',function(e){
	e.preventDefault();
	$('select').styler('destroy');
	atrn = $(this).prev().attr('name');
	atrnid = $(this).prev().prev().attr('name');
	$(this).html('X');
	
	$(this).removeClass('addrow');
	$(this).addClass('remrow');
	html =$(this).prev().html();
	$(this).closest('.form-group').after('<div class="form-group "><div class="input-group ">'+
		'<input type="hidden" name="'+atrnid+'" class="copyme" />'+
		'<select name="'+atrn+'"  class="copyme form-control" >'+html+
		'</select><div class="input-group-addon addrow">+</div>'+
		'</div></div>');
	$('select').styler();
});
function changesort(){
	$('.sorthotel').each(function(index){
		$(this).val(index+1);
		$(this).prev().html(index+1);
	})
}
function replacer(str, offset, s) {
	//console.log(str);
	if(str.indexOf('dates') >=0) {
		return "dates["+($(".hotBaseAndDate").length)+"]";
	}
}
function replacers(str, offset, s) {
	//console.log(str);
	return "promo["+($('#discounts input[type=checkbox]').length+1)+"]";
}
$(document).on('click','.hotBaseAndDate .dropdown .add-row',function(e){
	e.preventDefault();
	$('select').styler('destroy');
	ob = $(this).closest('.row');
	then =  $(this).data('then');
	xhtml = ob.html();
	k = $(".p-p").length+1;
	xhtml = xhtml.replace(/pic([0-9]+)/,'pic'+k);
	xhtml = xhtml.replace(/[^dates]\[([0-9]*)\]/g,replacer);
	xhtml = xhtml.replace(/<div class="p-p">([0-9]+)<\/div>/,'<div class="p-p">'+k+'</div>');
	if(then=='after')
		ob.after('<div class="row">'+xhtml+'</div>');
	else
		ob.before('<div class="row">'+xhtml+'</div>');
	$('select').styler();
	acompl();
	changesort()
});

$(document).on('click','.table-promo .dropdown .add-row',function(e){
	e.preventDefault();
	$('select').styler('destroy');
	ob = $(this).closest('.tr');
	then =  $(this).data('then');
	xhtml = ob.html();
	xhtml = xhtml.replace(/promo\[([0-9]+)\]/g,replacers);
	if(then=='after')
		ob.after('<div class="tr">'+xhtml+'</div>');
	else
		ob.before('<div class="tr">'+xhtml+'</div>');
	
	$('select').styler();
});
$(document).on('click','.hotBaseAndDate .dropdown .del-row',function(e){
	e.preventDefault();
	ob = $(this).closest('.row').remove();
});
$(document).on('click','.hotBaseAndDate .dropdown .up-row',function(e){
	e.preventDefault();
	ob = $(this).closest('.row');
	html = ob.html();
	prevrow = ob.prev();
	prevrowhtml = prevrow.html();
	
	prevrow.html(html);
	ob.html(prevrowhtml);
	changesort();
	refresher();
});
$(document).on('click','.hotBaseAndDate .dropdown .down-row',function(e){
	e.preventDefault();
	ob = $(this).closest('.row');
	html = ob.html();
	prevrow = ob.next();
	prevrowhtml = prevrow.html();
	
	prevrow.html(html);
	ob.html(prevrowhtml);
	changesort();
	refresher();
});
$(document).on('click','.table-promo .dropdown .del-row',function(e){
	e.preventDefault();
	ob = $(this).closest('.tr').remove();
	id = $(this).closest('.tr').data('rowid');
	if(id!==undefined)
		$.get("/ajax/discounts.php", { id: id,action:'delete' }, function(data) {
			if(data=='') {
				ob.remove();
			}
			else {
				alert(data);
			}
		});
});

$(document).on('click','.departure-add',function(e){
	e.preventDefault();
	$('select').styler('destroy');
	ob = $(this).closest('.hotBaseAndDate');
	id = parseFloat(ob.data('rid'));
	htmldom = ob.html();
	
	htmldom = htmldom.replace(/dates\[[0-9+]\]/g,replacer);
	
	id++;
	ob.after('<div class="hotBaseAndDate" data-rid="'+id+'">'+htmldom+'</div>');
	
	$('.dtp2').datetimepicker({
		locale: 'ru',
		format: 'DD.MM.YYYY LT',
		allowInputToggle:true
		
	}).on('dp.hide',function(e) {
		ob=$(this).closest('.hotBaseAndDate').find('.dataDeparture');
			//e.date
			ob.html($(this).val());
		});
	$('select').styler();
});
$(document).on('click','.mini img',function(e){
	
	picz = $(this).attr('src');
	ob = $(this).closest('.col-md-6').find('.showlarge img');
	ob.attr('src',picz);
});
$(document).on('click','#tourvisor button',function(e){
	e.preventDefault();
	$.get('/ajax/search.php',$('#tourvisor').serialize(),function(data){
		if(data.error) {
			$("#answer .modal-content").html("Укажите дату вылета");

			$("#answer").modal('show');
		} else {
			if(data.result){
				$('.search .founded').html("<div style='text-align:center;'><img src='/bitrix/templates/tour/images/89.gif' /></div>");
				checkState(data.result['requestid'],1);
			}
			else {
				$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>Ошибка приложения</h1><p>'+data+'</p></div>');
				
				$('#answer').modal('show');
			}
		}
	},'json');
});
$(document).on('change','input[name="sortindex"]',function(e){
	e.preventDefault();
	var id = $(this).data('id');
	var sort = $(this).val();
	$.get("/ajax/turs.php", { id: id,action:'sort',sort:sort }, function(data) {
		if(data!=='') {
			alert(data);
		}
	});
});
function checkState(id,page){
	inProgress = true;
	$.get('/ajax/search.php',{id:id,page:page},function(data){
		if(data.error) {
			$("#answer .modal-content").html("Укажите дату вылета");

			$("#answer").modal('show');
		}
		
		if(!$('.search .founded .statuse').length) { 
			$('.search .founded').html('<div class="statuse" data-search="'+id+'"></div>'); 
		}	
		$('.statuse').html("Найдено <b class='all'>" + data.data['status']['hotelsfound'] + "</b> <div class='procent'>"+data.data['status']['progress']+"%</div>");
		
		if(data.data['status']['state']=='finished') {
			
		}
		else {
			setTimeout( function(){ checkState(id,page); }, 5000);
		}
		
		if(data.data['result']['hotel'].length) {
			//console.log(data);

			$.each(data.data['result']['hotel'], function( i, v ){
				star='';
				for(k=1;k<=v.hotelstars;k++) star += '<span class="fa fa-star "></span>';
					
					var tours = '';
				$.each(v.tours['tour'], function( j, vl ){
					clr =''; if(j%2==0) clr ='gray'; 
					tours += '<div class="tr-price '+clr+'">';
					if(inGroup=='y') {
						tours += '<div class="td-oper">'+
						'<span data-operator="'+vl.operatorcode+'">'+vl.operatorname+'</span>'+
						'</div>';
					}
					tours += '<div class="td-tour">'+
					'<span>'+vl.tourname+'</span>'+
					'<span></span>'+
					'</div>'+
					'<div class="td-day">'+
					'<span>'+vl.flydate+'</span>'+
					'<span>'+vl.nights+' нч</span>'+
					'</div>'+
					'<div class="td-human">'+
					'<span>'+vl.adults+' взр</span>'+
					'<span>'+vl.child+' дет</span>'+
					'</div>'+
					'<div class="td-info">'+
					'<span>'+vl.room+'</span>'+
					'<span>'+vl.meal+' - '+vl.mealrussian+'</span>'+
					'</div>'+
					'<div class="td-price">'+
					'<span>'+vl.price+' Р</span>'+
					'</div>'+
					'<div class="tr-tour">'+
					'<a class="buythistour fa fa-chevron-right" data-tourid="'+vl.tourid+'">&nbsp;</a>'+
					'</div>'+
					'</div>';

				});
				menu = '';
				if(v.isphoto   =='1' ){ menu+='<a href="#" class="hotelmenu about">об отеле</a>';}
				if(v.iscoords =='1'){ menu+='<a href="#" class="hotelmenu map">на карте</a>'; }
				if(v.isreviews  =='1' ){ menu+='<a href="#" class="hotelmenu coments">отзывы</a>'; }
				if(v.isdescription  =='1' ){}
					
					
					if(!$("#h"+v.hotelcode).length) {
						$('.search .founded').append('<div id="h'+v.hotelcode+'" class="hotelline" data-hotelid="'+v.hotelcode+'">'+
							'<div class="row ">'+
							'<div class="col-md-3">'+
							'<div class="photo"> <img src="'+v.picturelink+'" height="100%" alt="" /> </div>'+
							'</div>'+
							'<div class="col-md-9">'+
							'<div class="row">'+
							'<div class="col-md-9">'+
							'<div class="stars">'+star+'</div>'+
							'<h3>'+v.hotelname+' '+v.hotelstars+'*</h3>'+
							'<p class="country">'+v.regionname+', '+v.countryname+'</p>'+
							'<p class="hotelinfo">'+v.hoteldescription+'</p>'+
							'</div>'+
							'<div class="col-md-3">'+
							'<div class="row inforesult">'+
							'<div class="col-md-6">'+
							'<span class="vote">рейтинг</span>'+
							'<span class="votecount">'+v.hotelrating+'</span>'+
							'</div>'+
							'<div class="col-md-6">'+
							'<span class="from">от</span>'+
							'<span class="price">'+v.price+' Р</span>'+
							'<span class="forroom">за номер</span>'+
							'</div>'+
							'</div>'+
							'</div>'+
							'</div>'+
							'<div class="row">'+
							'<div class="col-md-9">'+menu+
							'<a href="#" class="hotelmenu prices">цены</a>'+
							'</div>'+
							'<div class="col-md-3">'+
							'<a href="#" class="getme hotelmenu prices">выбрать</a>'+
							'</div>'+
							'</div>'+
							'</div>'+
							'</div>'+
							'<div class="box-prices">'+
							'<div class="line-prices xline">'+
							'<div class="tbl-prices">'+
							'<div class="th-price">'+
							'<div class="tr-head">'+
							'<span> </span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span>Тур</span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span>Вылет / ночей</span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span>Туристы</span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span>Номер/питание</span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span>Цена</span>'+
							'</div>'+
							'<div class="tr-head">'+
							'<span> </span>'+
							'</div>'+
							'</div>'+
							tours+
							'</div>'+
							'</div>'+
							'<div class="line-coments xline"></div>'+
							'<div class="line-map xline"></div>'+
							'<div class="line-about xline"></div>'+
							'<div class="footlinez">'+
							'<a href="/catalog/hotel/'+v.hotelcode+'" class="abouthotel">подробнее об отеле</a>'+
							'<a href="#" class="clo">X</a>'+
							'</div>'+
							'</div>'+
							'</div>');
					}
				});


}





inProgress = false;
},'json');

}
$(document).on('click','.line-coments a.more',function(e){
	e.preventDefault();
	$('.line-coments p').css('height','33px');
	$(this).prev().css('height','auto');
});
$(document).on('click','.hotelmenu.about',function(e){
	ob = $(this).closest('.hotelline');
	id = ob.data('hotelid');
	$.get('/ajax/getinfo.php',{id:id,a:'about'},function(data){
		ob.find('.line-about').html(data);
	});
});
$(document).on('click','.hotelmenu.map',function(e){
	ob = $(this).closest('.hotelline');
	id = ob.data('hotelid');
	$.get('/ajax/getinfo.php',{id:id,a:'map'},function(data){
		ob.find('.line-map').html(data);
	});
});
$(document).on('click','.hotelmenu.coments',function(e){
	ob = $(this).closest('.hotelline');
	id = ob.data('hotelid');
	$.get('/ajax/getinfo.php',{id:id,a:'rew'},function(data){
		ob.find('.line-coments').html(data);
	});
});
$(document).on('click','.getme.prices',function(e){
	// возможно не нужно...
});
$(document).on('click','.srchpls button',function(e){
	e.preventDefault();
	if($(this).data('cid')!==undefined){
		window.location.href='/catalog/country/'+ $(this).data('cid');
	}
	if($(this).data('hid')!==undefined){
		window.location.href='/catalog/hotel/'+ $(this).data('hid');
	}
});
$(document).on('click','.ddwn2 p',function(e){
	id = $(this).data('cid');
	txt = $(this).text();
	$('input[name=hotelname]').val(txt);
	$(this).closest('.srchpls').find('button').data('hid',id);
	$('.ddwn2').hide();
});
$(document).on('click','.ddwn p',function(e){
	id = $(this).data('cid');
	txt = $(this).text();
	$('input[name=countryname]').val(txt);
	$('.ddwn').hide(); 
	$(this).closest('.srchpls').find('button').data('cid',id);
	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=hotel&hotcountry="+id+"&callback=?", function(data) {
		var opts="";
		if(data.lists.hotels.hotel.length>0){
			for(var ii = 0; ii<data.lists.hotels.hotel.length; ii++) {
				opts=opts+"<p data-cid='"+data.lists.hotels.hotel[ii].id+"'>"+data.lists.hotels.hotel[ii].name+"</p>";
			}
		}
		$('.ddwn2').html(opts);
		if(opts=='') $('.ddwn2').hide(); else $('.ddwn2').show();
		$('input[name="hotelname"]').attr('disabled',false);
	});
});
$(document).on('focusout','.hotelzname',function(e){
	div = $(this).closest('.col-md-3').find('.urladr');

	if($(this).prev().val()==''&&div.length==0){
		n = $(this).attr('name');
		n = n.replace('name','urladr');
		$(this).after('<div class="form-group urladr"><label for=" ">УРЛ отеля</label><input name="'+n+'" value="" placeholder="http:// отеля" class="form-control"></div>')
	}
});
$(document).on('keyup','.srchpls input[name=countryname]',function(e){
	var cnfp = $(this).val();
	if(cnfp.length)
		$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=country&callback=?", function(data) {
			var opts="";
			var pos = 0;
			for(var ii = 0; ii<data.lists.countries.country.length; ii++) {
				str = data.lists.countries.country[ii].name;
				var foundPos = str.indexOf(cnfp, pos);
				if (foundPos == 0) {
					opts=opts+"<p data-cid='"+data.lists.countries.country[ii].id+"'>"+data.lists.countries.country[ii].name+"</p>";
				}
			}
			$('.ddwn').html(opts);
			if(opts=='') $('.ddwn').hide(); else $('.ddwn').show();
		});
});
$(document).on('click','.showlarge img',function(e){
	pic = $(this).attr('src');
	$('#largepic .modal-content').html("<img src='"+pic+"' width=100%>");
});
$(document).on('click','.navbar .adressAll li a',function(e){
	id = $(this).data('mapid');
	$.get("/ajax/map.php", { id:id }, function(data) {
		$("#showmap .modal-content").html(data);
	});
});
$(document).on('keydown','input.dopsz',function(e){
	incudez($(this))
});
function incudez(ob){
	ob.autocomplete({
		source: function(req, add){
			$.getJSON("/ajax/inexclude.php?callback=?", req, function(data) {
				var array = data.error ? [] : $.map(data.list, function(m) {
					return {
						label: m.label,
						value: m.value,
						id: m.id
					};
				});
				add(array);
			});
		},
		select: function(e, ui){
			$(this).prev().val(ui.item.id);
		}
	});
}
function acompl(){
	$(".hotelzname").autocomplete({
		source: function(req, add){
			if($('select[name="countryz"]').val()!==undefined&&$('select[name="curort"]').val()!==undefined) {
				$.getJSON("/ajax/touvisor.php?cntry="+$('select[name="countryz"] :selected').data('cid')+"&hreg="+$('select[name="curort"] :selected').data('kid')+"&callback=?", req, function(data) {
					var array = data.error ? [] : $.map(data.list, function(m) {
						return {
							label: m.label,
							value: m.value,
							id: m.id
						};
					});
					add(array);
				});
			}
		},
		select: function(e, ui){
			$(this).prev().val(ui.item.id);
		}
	});
}
$(function () {
	acompl();
	if($('input[name="REGISTER[PERSONAL_CITY]"]').length){
		$('input[name="REGISTER[PERSONAL_CITY]"]').val(userCity);
	}
	$grid = $('.grid').masonry({
		itemSelector: '.grid-item',
		columnWidth: '.col-md-3',
		percentPosition: true
	});
	if($('.search .results').length){
		checkState(reqID);
	}
	var pr = $('.pricebox .sel').text();
	$( "#slider-range" ).slider({
		range: true,
		min: 10000,
		max: 900000,
		step: 10000,
		values: [ 0, 500000 ],
		slide: function( event, ui ) {
			//if ($(ui.handle).index() == 1) return false;

			var pr = $('.pricebox .sel').text();
			
			$( "#amount" ).val(  ui.values[ 0 ] + " "+pr+" - "+ ui.values[ 1 ]+" "+pr  );
		}
	});
	$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " "+pr+" - " + $( "#slider-range" ).slider( "values", 1 )+" "+pr );
	if($(window).width()>1000) {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 0) {
				$('#scroller').fadeIn();
			} else {
				$('#scroller').fadeOut();
			}
		});
	}
	$('#scroller').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 400);
		$.fn.fullpage.moveTo(1);
		return false;
	});
	$(".mapover").show();
	getCityByIp(officeForCity);
	$("input[name=daterangefly]").daterangepicker({
		locale: {
			format: "DD.MM",
			separator: " - ",
			applyLabel: "Выбрать",
			"cancelLabel": "Отмена",
			"fromLabel": "от",
			"toLabel": "до",
			"customRangeLabel": "Custom",
			"weekLabel": "W",
			"daysOfWeek": [
			"Вс",
			"Пн",
			"Вт",
			"Ср",
			"Чт",
			"Пт",
			"Сб"
			],
			"monthNames": [
			"Январь",
			"Февраль",
			"Март",
			"Апрель",
			"Май",
			"Июнь",
			"Июль",
			"Август",
			"Сентябрь",
			"Октябрь",
			"Ноябрь",
			"Декабрь"
			],
			"firstDay": 1
		},
	});
	$('.dtp1').datetimepicker({
		locale: 'ru',
		format: 'DD.MM',
		allowInputToggle:true
		
	}).on('dp.hide',function(e) {
		ob=$(this).closest('.hotBaseAndDate').find('.dataDeparture');
			//e.date
			ob.html($(this).val());
		});
	$('.dtp3').datetimepicker({
		locale: 'ru',
		format: 'DD.MM.YYYY',
		allowInputToggle:true
		
	});
	$('.dtp2').datetimepicker({
		locale: 'ru',
		format: 'DD.MM.YYYY LT',
		allowInputToggle:true
	}).on('dp.hide',function(e) {
		ob=$(this).closest('.hotBaseAndDate').find('.dataDeparture');
			//e.date
			ob.html($(this).val());
		});
	$(".city-toggler").dropdown();
	$('.hot-carusel2').owlCarousel({
		loop:false,
		margin:10,
		dots:false,
		items:4,
		nav:true
	});
	$('.-carusel').owlCarousel({
		loop:false,
		margin:20,
		dots:false,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:5
			}
		}
	});
	$('.reviewes').owlCarousel({
		loop:false,
		margin:30,
		dots:false,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:2
			}
		}
	});

	$('.poputki').owlCarousel({
		loop:false,
		margin:30,
		dots:false,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:3
			}
		}
	});
	$('.lastart-carousel').owlCarousel({
		loop:false,
		margin:25,
		dots:false,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:3
			}
		}
	});
	$('.workers').owlCarousel({
		loop:false,
		margin:20,
		dots:false,
		nav:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:3
			}
		}
	});
	if($('.peopl-carusel').length){
		$('.peopl-carusel').owlCarousel({
			loop:false,
			margin:20,
			dots:false,
			nav:true,
			responsive:{
				0:{
					items:2
				},
				600:{
					items:1
				},
				1000:{
					items:5
				}
			}
		});
	}
	if($('.nagrada-carousel').length){
		$('.nagrada-carousel').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			items:1
		});
	}
	if($('.boss-carousel').length){
		$('.boss-carousel').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			items:1
		});
	}
	if($('.country-carousel').length){
		$('.country-carousel').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			items:1
		});
	}
	if($(window).width()<1000) {
		$('#buyonline .modal-dialog').removeClass('modal-lg');
		$('.magic').addClass('col-xs-12');
		$('.gridview').owlCarousel({
			loop:false,
			margin:20,
			dots:false,
			nav:true,
			center: true,
			responsive:{
				0:{
					items:1,
					center: true
				},
				600:{
					items:1,
					center: true
				},
				1000:{
					items:4
				}
			}
		});
		$('.preim-carousel').addClass('owl-carousel');
		$('.preim-carousel').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			center: true,
			responsive:{
				0:{
					items:1
				}
			}
		});
		$('.award-carousel').addClass('owl-carousel');
		$('.award-carousel').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			center: true,
			responsive:{
				0:{
					items:1
				}
			}
		});
		$('.work-box').addClass('owl-carousel');
		$('.work-box').owlCarousel({
			loop:false,
			margin:0,
			dots:false,
			nav:true,
			center: true,
			responsive:{
				0:{
					items:1
				}
			}
		});
		$('.art-carusel').owlCarousel({
			loop:false,
			margin:20,
			dots:false,
			nav:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:2
				}
			}
		});
		$('.office-carousel').owlCarousel({
			loop:false,
			margin:10,
			dots:false,
			items:1,
			nav:true
		});
		$('.franchise-carusel').owlCarousel({
			loop:false,
			margin:10,
			dots:false,
			items:1,
			nav:true
		});
		$('.teach-carusel').owlCarousel({
			loop:false,
			margin:10,
			dots:false,
			items:1,
			nav:true
		});
		$('.hot-carusel').owlCarousel({
			
			margin:10,
			dots:false,
			items:2,
			nav:true,
			loop:false,
			center: true
		});
		
		if($("#listcity").length) {
			$('#listcity').liColl({
				c_unit: 'px', // '%' или 'px' При указании '%' — ширина 'c_width' игнорируется
				n_coll: 2,    //колличество колонок
				c_width: 150, //Ширина колонок в 'px'
				p_left: 15    //отступ слева %           
			});
		}
	}
	else {
		$('.gridview').owlCarousel({
			loop:false,
			margin:20,
			dots:false,
			nav:true,
			center: true,
			//center: true,
			responsive:{
				0:{
					items:1,
					center: true
				},
				600:{
					items:1,
					center: true
				},
				1000:{
					items:4
				}
			}
		});
		$('#cityx').liColl({
			c_unit: 'px', // '%' или 'px' При указании '%' — ширина 'c_width' игнорируется
			n_coll: 4,    //колличество колонок
			c_width: 190, //Ширина колонок в 'px'
			p_left: 10    //отступ слева %           
		});
		if($("#listcity").length) {
			$('#listcity').liColl({
				c_unit: 'px', // '%' или 'px' При указании '%' — ширина 'c_width' игнорируется
				n_coll: 4,    //колличество колонок
				c_width: 280, //Ширина колонок в 'px'
				p_left: 30    //отступ слева %           
			});
		}
	}
	
	$(document).on('click','.fly_date',function(e){
		$('.fly_date').removeClass('checked');
		$(this).addClass('checked');
	});
	$(document).on('click','.hotlist',function(e){
		$('.hotthumb').removeClass('active');
		$(this).addClass('active');
		$('.hotel-list').show();
		$('.hotel-carusel').hide();
		
		$('.listview').show();
		$('.gridview').hide();
		
		
	});
	$(document).on('click','.slideMenu',function(e){
		if($('.botSlideMenu').length==0) {
			$('.footer').addClass('botSlideMenu');
			$('.slideMenu').addClass('active');
			$('.slideMenu').addClass('fa-angle-down');
			$('.slideMenu').removeClass('fa-angle-up');
			$('.tds.subscribe').show();
			$('.tds.social').show();
			$('.footer_link a:last-child').show();
			$('.footer_link a').wrap('<p></p>');
			
		}
		else {
			$('.footer_link a').unwrap();
			$('.footer').removeClass('botSlideMenu');
			$('.slideMenu').addClass('fa-angle-up');
			$('.slideMenu').removeClass('fa-angle-down');
			$('.slideMenu').removeClass('active');
			$('.tds.subscribe').hide();
			$('.tds.social').hide();
			$('.footer_link a:last-child').hide();
		}
	});
	$(document).on('click','.hotthumb',function(e){
		$('.hotlist').removeClass('active');
		$(this).addClass('active');
		$('.gridview').show();
		$('.listview').hide();
		
		$('.hotel-carusel').show();
		$('.hotel-list').hide();
	});
	$(document).on('click','.mobile-city',function(e){
		$('.cityAll2').show();
		$('.navigation').hide();
	});
	
	$(document).on('click','.addsoc',function(e){
		
		$(this).before('<div class="form-group ">'+
			'<input name="link[]" class="form-control" placeholder="Ссылка на социальную сеть">'+
			'</div>');
		
	});
	$(document).on('submit','#comp-srch',function(e){
		e.preventDefault();
		$("#results").html("<img src='/bitrix/templates/tour/images/89.gif' />");
		$.post("/ajax/companion.php",$("#comp-srch").serialize(),function(data){
			$("#results").html(data);
		});
	});

	$(document).on('click','.bigbtn.ank',function(e){
		var formData = new FormData($('form#anketaComp')[0]);
		$.ajax({
			type: 'POST',
			url: '/ajax/addcompanion.php',
			data: formData,
			contentType:false,
			processData: false,
			success:function (data){ 
				if(data=='ok'){
					$("#addcompany").modal('hide');
					$("#anketaComp")[0].reset();
					$("#answer .modal-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel"></h4></div><div class="thnx"><h1>Спасибо, ваша заявка принята!</h1><p>Еще текст сообщения</p></div>');
				}
				else {
					$("#answer .modal-content").html(data);
				}
				Recaptchafree.reset()
				$("#answer").modal('show');
				
			}
		});

	});
	$(document).on('click','.more-companion',function(e){
		$('#fullview .modal-content').html('');
		$('#fullview .modal-content').html($(this).closest('.col-md-4').html());
		$('#fullview').modal('show');
	});
	
	$(document).on('click','.otklikjob',function(e){
		e.preventDefault();
		id = $(this).data('id');
		$("input.vakancy").val(id);
		$('#jobform').modal('show');
	});
	$(document).on('click','.job-box .more',function(e){
		e.preventDefault();
		id = $(this).data('id');
		$('#jobinfo a').data('id',id);
		html = $(this).closest('.job-box').find('.job-full-text').html();
		
		$('#jobinfo .jobinfo').html(html); 
		
		$('#jobinfo').modal('show');
	});
	$(document).on('click','.starq label',function(e){
		e.preventDefault();
		$(this).prev().prop('checked',true);
		
		
	});
	$(document).on('click','.box-price-check a',function(e){
		e.preventDefault();
		$('.box-price-check div:first-child').html('<img src="/bitrix/templates/tour/images/89.gif" />');
		setTimeout( function() { checkPrice(); }, 5000);
	});
	
	if($('#fullPage').length) {$.fn.fullpage.reBuild();}
	
	
});
$(window).scroll(function() {
	if($(window).scrollTop() + $(window).height() >= $(document).height() - 200 && !inProgress) {
		if($('.search .founded').length) {
			if(parseFloat($('.statuse .all').text())>$('.hotelline').length){
				sPage++;
				checkState($('.search .founded .statuse').data('search'),sPage);

			}
		}
		if($('.grid-sizer').length) {
			$('.grid-item[style*="none"]').each(function(index){
				if(index<4){
					$(this).show();
				}
			});
			$grid.masonry('layout');
		}
	}
});
$( window ).resize(function() {
	if($('#fullPage').length) {$.fn.fullpage.reBuild();}
	
	// $('.fp-tableCell').not($('.bx-yandex-view-layout').parent()).css({
	// 	'transform': 'scale('+zoomForDeskTops()+')',
	// 	'transform-origin': 'bottom' 
	// });
	// $('.daterangepicker').css({
	// 	'transform': 'scale('+zoomForDeskTops()+')',
	// 	'transform-origin': 'bottom' 
	// });
});
$(window).on('load', function () {
	
	var $preloader = $('#page-preloader'),
	$spinner   = $preloader.find('.spinner');
	$spinner.fadeOut();
	$preloader.delay(350).fadeOut('slow');
	
	//$('.fp-prev').animateCss('zoomIn');
	//$('.fp-next').animateCss('zoomIn');
	
});
function zoomForDeskTops() {
	if($(window).width() > 1000) {

		var mainpagecoeffHeight = 930

		var  mainpagecoeff = 1/parseFloat(mainpagecoeffHeight.toFixed(3))

		var windowHeight = document.body.clientHeight

		var currentZoomCoef = mainpagecoeff * windowHeight

		currentZoomCoef = parseFloat(currentZoomCoef.toFixed(3))

		return currentZoomCoef

	}
	else {
		return 1;
	}
}
function getName (str){
	if (str.lastIndexOf('\\')){
		var i = str.lastIndexOf('\\')+1;
	}
	else{
		var i = str.lastIndexOf('/')+1;
	}						
	var filename = str.slice(i);			
	var uploaded = document.getElementById("fileformlabel");
	uploaded.innerHTML = filename;
}
function getCityByIp(id){
	$.get("/ajax/city.php", { city:id }, function(data) {
		str2 = '';
		if(data.length>0){
			$(".adressAll ul").html('');
			$.each(data, function( index, value ){
				str =	'<li>'+
				'<h3>'+value.adr+'</h3>'+
				'<ol>'+
				'<li><i class="fa fa-phone fa-lg red-style" ></i>'+value.phone+'</li>'+
				'<li ><i class="fa fa-clock-o fa-lg red-style" ></i>'+value.time+'</li>'+
				'<li><i class="fa fa-subway fa-lg red-style" ></i>'+value.metro+'</li>'+
				'<li><i class="fa  fa-map-marker  fa-lg red-style" ></i><a href="#" data-mapid="'+value.id+'" data-toggle="modal" data-target="#showmap">См. на карте</a></li>'+
				'</ol>'+
				'<br style="clear:both;">'+
				'</li>';

				$(".adressAll ul").append(str);
				$(".navbar .phones b").text(value.phone);
				$(".navbar .phones .p2").text(value.phone2);
				$(".lastblock .phones .p1").text(value.phone);
				$(".lastblock .phones .p2").text(value.phone2);
				if(value.vk){	$(".lastblock .socials .vk").attr('href',value.vk); $(".lastblock .socials .vk").show();}else  { $(".lastblock .socials .vk").hide(); }
				if(value.inst){	$(".lastblock .socials .inst").attr('href',value.inst); $(".lastblock .socials .inst").show();}else  { $(".lastblock .socials .inst").hide(); }
				if(value.ok){	$(".lastblock .socials .ok").attr('href',value.ok); $(".lastblock .socials .ok").show();}else  { $(".lastblock .socials .ok").hide(); }
				if(value.fb){	$(".lastblock .socials .fb").attr('href',value.fb); $(".lastblock .socials .fb").show();}else  { $(".lastblock .socials .fb").hide(); }
				var x=0;y=0;
				if($("#BX_GMAP_googlemaps2").length){
					$.each(value.pl, function( i, v ){
						BX_GMapAddPlacemark({'LON':v.LON,'LAT':v.LAT,'TEXT':v.TEXT,'cls':'marker'+index}, 'googlemaps2');
						x = v.LON;
						y = v.LAT;
					});
					BX_GMapPanTo(y,x,'googlemaps2');
				}
				if($('.office-carousel').length){
					str2 +='<div class="item marker'+index+'">'+
					'<div class="row office" >'+
					'<div class="col-md-9 " >'+
					'<h3>'+value.name+'</h3>'+
					value.adr+
					'</div>'+
					'<div class="col-md-3 " >'+
					'<div class="ofcepic"><img src="'+value.pic+'" ></div>'+
					'</div>'+
					'</div>'+
					'<div class="officefull">'+
					'<div class="row " >'+
					'<div class="col-md-7 col-xs-7" >'+
					'<h3>'+value.name+'</h3>'+
					value.fname+
					'</div>'+
					'<div class="col-md-5 col-xs-5" >'+
					'<div class="ofcepicbig"><img src="'+value.pic+'" ></div>'+
					'</div>'+
					'</div>'+
					'<div class="row " >'+
					'<div class="col-md-6 col-xs-6 " >'+
					'<p><i class="fa fa-calendar-o redish"></i></p>'+
					'<p><b>Пн-Пт:</b>'+value.time+'</p>'+
					'<p><b>Сб,Вс:</b> '+value.holiday+'</p>'+
					'</div>'+
					'<div class="col-md-6 col-xs-6 " >'+
					'<p><i class="fa fa-phone redish"></i></p>'+
					'<p><b>'+value.phone+'</b></p>'+
					'<p>'+value.phone2+'</p>'+
					'</div>'+
					'</div>'+
					'</div>'+
					'</div>';
				}
			});
			if($('.office-carousel').length){
				$('.office-carousel').html(str2);
			}
		}
	},'json');
}
function catalCountry(){
	$.getJSON("http://tourvisor.ru/xml/list.php?format=json&type=country&callback=?", function(data) {
		var hht="";
		var opts="";
		k = data.lists.countries.country.length / 4;
		k = Math.ceil(k);
		//console.log(k);
		for(var ii = 0; ii<data.lists.countries.country.length; ii++) {
			if(ii%k==0) opts +='</div>';
			if(ii==0||ii%k==0) opts +='<div class="col-md-3 nopad">';
			tran =transliterate(data.lists.countries.country[ii].name);
			tran = tran.replace(/\ /g, '-');
			opts+='<a href="/catalog/country/tid'+data.lists.countries.country[ii].id+'" class="flag "><img src="/images/Flags/png/'+tran.toLowerCase()+'.png" alt="'+data.lists.countries.country[ii].name+'" /> '+data.lists.countries.country[ii].name+'</a>';
		}

		$('.allcountry').html(opts);

	});
}
if($('.catalogcountry').length) {
	catalCountry();
}

function checkPrice(){
	
	$.get('/ajax/check.php',{id:$(this).data('id')},function(data){
		$('.box-price-check div:first-child').html(data);
	});
	
}

transliterate = (
	function() {
		var
		rus = "щ   ш  ч  ц  ю  я  ё  ж  ъ  ы  э  а б в г д е з и й к л м н о п р с т у ф х ь".split(/ +/g),
		eng = "shh sh ch cz yu ya yo j `` y e a b v g d e z i j k l m n o p r s t u f h i".split(/ +/g)
		;
		return function(text, engToRus) {
			var x;
			for(x = 0; x < rus.length; x++) {
				text = text.split(engToRus ? eng[x] : rus[x]).join(engToRus ? rus[x] : eng[x]);
				text = text.split(engToRus ? eng[x].toUpperCase() : rus[x].toUpperCase()).join(engToRus ? rus[x].toUpperCase() : eng[x].toUpperCase());	
			}
			return text;
		}
	}
	)();