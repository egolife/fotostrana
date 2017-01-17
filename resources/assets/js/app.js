'use strict';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.js-like').click(function (e) {
        e.preventDefault();
        var $el = $(e.currentTarget);

        $.post($el.attr('href')).done(function (res) {
            $el.html(res.html);
        }).fail(function (res) {
            alert('Что-то пошло не так, обновите страницу и попробуйте еще раз!');
        });
    });
});