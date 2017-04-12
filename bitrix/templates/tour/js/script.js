$(document).ready(function(){
    var city_id = $('.cityAll .letterlist a.active').attr('data-citytv');
    load_tours(city_id);

    var selectCity = $('select.departure');
    var placeholder = selectCity.find('option:first');
    var option, id;
    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: {
            "get_city": 1
        },
        success: function (json) {
            JSON.parse(json, function (key, value) {
                if (key == 'id') id = value;
                if (key == 'name') {
                    option = '<option value="' + id + '">' + value + '</option>';
                    selectCity.append(option);
                }
            });
        }
    })
})

$('.departure').on('change', function () {
    var departure_id = $(this).val();
    var selectCountry = $('select.country');
    var placeholder = selectCountry.find('option:first');
    var option, id;

    selectCountry.html('');
    selectCountry.append(placeholder);

    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: {
            "departure_id": departure_id
        },
        success: function (json) {
            JSON.parse(json, function (key, value) {
                if (key == 'id') id = value;
                if (key == 'name') {
                    option = '<option value="' + id + '">' + value + '</option>';
                    selectCountry.append(option);
                    selectCountry.trigger('refresh')
                }
            });
        }
    })
});

$('.country').on('change', function () {
    var country_id = $(this).val();
    var selectRegions = $('select.regions');
    var placeholder = selectRegions.find('option:first');
    var option, id;

    selectRegions.html('');
    selectRegions.append(placeholder);

    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: {
            "country_id": country_id
        },
        success: function (json) {
            JSON.parse(json, function (key, value) {
                if (key == 'id') id = value;
                if (key == 'name') {
                    option = '<option value="' + id + '">' + value + '</option>';
                    selectRegions.append(option);
                    selectRegions.trigger('refresh')
                }
            });
        }
    })
});

$('#gen_tours input[type=submit]').on('click', function (e) {
    $('input.requestid').val(0);
    $('input.status').val(0);
})

$('#gen_tours').on('submit', function (e) {
    e.preventDefault();
    $('#gen_tours input[type=submit]').attr('disable');
    var data = $(this).serializeArray();

    var requestid = $('input.requestid').val();
    var status = $('input.status').val();
    if (requestid == '0') {
        data.push({name: 'get_requestid', value: 1});
        $.ajax({
            type: 'post',
            url: '/ajax/dev.php',
            data: data,
            success: function (res) {
                console.log(res);
                $('pre.result').html(res);
                $('input.requestid').val(res);
                $('#gen_tours').submit();
            }
        })
    } else if (status != '100') {
        data.push({name: 'get_status', value: 1});
        check_status(data);
        status = $('input.status').val();
        $('pre.result').html(status);
        $('pre.result').append(' wait ..');

        var intervalID = setInterval(function () {
            if (status != '100') {
                check_status(data);
                status = $('input.status').val();
            } else {
                console.log('end');
                $('#gen_tours').submit();
                clearInterval(intervalID);
            }
        }, 10000);
    } else if (status == '100') {
        //Запрос результата
        var data = $(this).serializeArray();
        var category = $(".departure option:selected").html() + " - " + $(".country option:selected").html() + "(" + $(".regions option:selected").html() + ")";
        data.push({name: 'get_result', value: 1});
        data.push({name: 'cat_name', value: category});

        $.ajax({
            type: 'post',
            url: '/ajax/dev.php',
            data: data,
            success: function (res) {
                if (res != 'empty') {
                    console.log(res);
                    $('pre.result').html(res);
                    var data = $('#gen_tours').serializeArray();
                    data.push({name: 'cat_name', value: category});
                    new_items(data);
                } else {
                    $('pre.result').html('Туры не найдены');
                }
            }
        })

    }

});

// Селект отправления на главной
$('.city_departure').on('change', function () {
    var departure_id = $(this).val();
    load_tours(departure_id);
});

// Переход в карточку туров
$(document).on('click' ,'.hotdeals',function(){
    var url = $(this).attr('data-url');
    //console.log(url);
    window.location.href = url;
});

// Заполнение модального окна (Оплатить онлайн)
$('.payonline').on('click', function(){
    var tourvisor_id = $(this).parent().attr('data-tourvid');
   
    $.ajax({
        type: 'post',
        url: '/ajax/modal_tour.php',
        data: {
            'pay_online': 1,
            'tourid': tourvisor_id
        },
		beforeSend: function(){
			$('#buyme .modal-body').html('<div style="text-align:center"> <img src="/bitrix/templates/tour/images/89.gif"> </div>');
		},
        success: function(res){
            $('#buyme .modal-body').html(res);
        }
    })
})

// Заполнение модального окна (Оплатить в офисе)
$('.payoffice').on('click', function(){
    var tourvisor_id = $(this).parent().attr('data-tourvid');
	$('input[name=tourid]').val(tourvisor_id);
	$.ajax({
        type: 'post',
        url: '/ajax/modal_tour.php',
        data: {
            'pay_office': 1,
            'tourid': tourvisor_id
        },
		beforeSend: function(){
			$('#order .modal-body .form-order-info').html('<div style="text-align:center"> <img src="/bitrix/templates/tour/images/89.gif"> </div>');
		},
        success: function(res){
            $('#order .modal-body .form-order-info').html(res);
        }
    })
})


/*$(document).on('click','.cityAll .letterlist a',function(e){

    load_tour_and_siblings(city_id);
})*/

/*=========================================== FUNCTIONS ====================================================*/

function check_status(data) {
    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: data,
        success: function (res) {
            $('input.status').val(res);
            $('pre.result').html(res);
            $('pre.result').append('% wait ..');
        }
    })
}

function new_items(data) {
    var departure_name = $(".departure option:selected").html();
    data.push({name: 'new_items', value: 1});
    data.push({name: 'departure_name', value: departure_name});
    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: data,
        success: function (res) {
            $('pre.result').html('Туры добавлены.');
        }
    })
}

function load_tours(city_id){
    /*Загрузка первых 4 ех туров в витрину*/
    $.ajax({
        type: 'post',
        url: '/ajax/dev.php',
        data: {
            "load_tour": 1,
            "showcase": 1,
            "city_id":  city_id,
        },
        success: function (res) {
            $('.showcase_tours .gridview').remove();
            $('.showcase_tours .listview').remove();
            $('.showcase_tours .hotindex').append(res);

            /*Загрузка остальных туров в витрину (в виде слайдера)*/
            $.ajax({
                type: 'post',
                url: '/ajax/dev.php',
                data: {
                    "load_tour": 1,
                    "remaining_tours": 1,
                    "city_id": city_id,
                },
                success: function (res) {
                    $('.remaining_tours').remove();
                    $('.showcase_tours').after(res);

                    /* ============= СЮДА ============*/
                }
            })
            /*Загрузка туров из соседних городов*/
            $.ajax({
                type: 'post',
                url: '/ajax/dev.php',
                data: {
                    "load_siblings": 1,
                    "city_id":  city_id,
                },
                success: function(res){
                    if(res == ''){
                        $('.sibling_tours').css('display', 'none');
                    }else{
                        $('.sibling_tours').css('display', 'table');
                        $('.sibling_tours .hotturblock').remove();
                        $('.sibling_tours .hotturblock-mobile').remove();
                        $('.sibling_tours div').append(res);
                    }
                }
            })
			$('.hotdeals').css('opacity',1);
			hblkhvr();
            $('.gridview').owlCarousel({
                loop:false,
                margin:20,
                dots:false,
                nav:true,
                center: false,
                responsive:{
                    0:{
                        items:2
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:4
                    }
                }
            });

        }
    })
}
