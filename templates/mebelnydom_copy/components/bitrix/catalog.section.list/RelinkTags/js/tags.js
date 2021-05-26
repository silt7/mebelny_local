$('.tags__show').click(function () {
  $(this).toggleClass('tags__show__active');
  if ($(this).hasClass('tags__show__active')) {
    $('.tags-item__hide').animate({
      height: 'show'
    }, 300);
    $('.tags__show').text('Скрыть все категории');
  } else {
    $('.tags-item__hide').animate({
      height: 'hide'
    }, 300);
    $('.tags__show').text('Показать все категории');
  }
});

// Удаление ссылок на категории, которые есть в фильтре
$(function() {
    $( document ).ready(function() {
        var showElement = [];
        $i = 0;
        $('.desktop .tags-items a').each(function(idx, element){
            var href = $(element).attr("href");
            var kombox_a = $('#kombox-filter').find('[href="' + href + '"]')
            if(kombox_a.length == 1){
                $(element).remove();
            } else {
                $i++;
                if($i <= 8){
                    $(element).removeClass('tags-item__hide');
                    $(element).show();
                }
                showElement.push($(element));
            }
        });
        //console.log(showElement);
    });
});