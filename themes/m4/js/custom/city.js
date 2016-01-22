$('.btn_city').tap(function () {
    var title1 = $('.title1').html();
    var cityName = $('.cityTitle').html();

    J.popup({
        html: '<div class="cityover-list">' +
                '<header class="head-title1">' +
                '<nav class="left">' +
                '<a href="#" data-icon="previous" data-target="back"></a>' +
                '</nav>' +
                '<div class="title1">' + title1 + '</div>' +
                '<nav class="right">' +
                '<a data-target="closePopup">' +
                '<span>' + cityName + '</span>&nbsp' +
                '<img class="w25" src="/themes/m4/images/image/mark.png">' +
                '</a>' +
                '</nav>' +
                '</header>' +
                '<article id="city" class="active">' + $cityHtml +
                '</article>' +
                '</div>' +
                '',
        pos: 'top',
        showCloseBtn: false
    });

    $(".province").click(function () {
        var id = $(this).attr('data-city');
        $('.province').each(function () {
            if (id == $(this).attr('data-city')) {
                $(this).addClass('bg-white');
            } else {
                $(this).removeClass('bg-white');
            }
        });
        $('.cityList').each(function () {
            if (id == $(this).attr('data-city')) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
        });
    });
});

function readyPage(data, url) {
    var results = data.results;
    innerHtml = '<div class="grid color-black">' +
            '<div class="col-1 w50 list1-left" style="height:356px;">' +
            '<ul class="list1">';
    if (results.length > 0) {
        for (var i = 0; i < results.length; i++) {
            /*第一个为白色*/
            if (i == 0) {
                innerHtml += '<li class="province bg-white" data-city="' + results[i].id + '">';
            } else {
                innerHtml += '<li class="province" data-city="' + results[i].id + '">';
            }

            innerHtml += '<div>' + results[i].state +
                    '</div>' +
                    '</li>';
        }
        innerHtml += '</ul>' +
                '</div>' +
                '<div class="col-1 w50 list1-right" data-scroll="true" style="height:356px;">';
        for (var i = 0; i < results.length; i++) {
            var subCity = results[i].subCity;
            /*第一个不隐藏*/
            if (i == 0) {
                innerHtml += '<ul class="cityList list1" data-city="' + results[i].id + '">';
            } else {
                innerHtml += '<ul class="cityList list1" data-city="' + results[i].id + '" style="display:none;">';
            }

            for (var j = 0; j < subCity.length; j++) {
                innerHtml += '<li>' +
                        '<a data-target="link" href="' + url + '&cityId=' + subCity[j].id + '">' +
                        '<div class="color-black city" data-city="1">' + subCity[j].city + '</div>' +
                        '</a>' +
                        '</li>';
            }
            innerHtml += '</ul>';
        }
    }
    innerHtml += '</div></div>';



    return innerHtml;
}