'use strict';

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var $feed_item = $('.js-feed-item');

    $feed_item.on('click', '.js-like', function (e) {
        e.preventDefault();
        var $el = $(e.currentTarget);

        $.post($el.attr('href')).done(function (res) {
            $el.replaceWith(res.html);
        }).fail(function (res) {
            alert('Что-то пошло не так, обновите страницу и попробуйте еще раз!');
        });
    });

    $feed_item.on('mouseenter', '.js-like', function (e) {
        $(this).siblings('.js-liked-users').removeClass('hidden');
    });

    $feed_item.on('mouseleave', '.js-like', function (e) {
        $(this).siblings('.js-liked-users').addClass('hidden');
    });
});