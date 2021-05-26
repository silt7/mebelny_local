$(document).ready(function () {

    $(document).on('click', '.load_more', function () {

        var targetContainer = $('.load_more_wrap'),    //  Контейнер, в котором хранятся элементы
            url = $('.load_more').attr('data-url');    //  URL, из которого будем брать элементы

        if (url !== undefined) {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'html',
                success: function (data) {

                    //  Удаляем старую навигацию
                    $('.load_more').remove();

                    var elements = $(data).find('.load_more_item'),  //  Ищем элементы
                        pagination = $(data).find('.load_more');//  Ищем навигацию

                    targetContainer.append(elements);   //  Добавляем посты в конец контейнера
                    $('.load_more_navstring').append(pagination);

                }
            })
        }

    });

});