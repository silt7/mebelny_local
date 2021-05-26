// Удаление ссылок на категории, которые есть в фильтре
$(function() {
    $( document ).ready(function() {
        var showElement = [];
        $i = 0;
        $('.mobile .tags-items a').each(function(idx, element){
            var href = $(element).attr("href");
            var kombox_a = $('#kombox-filter').find('[href="' + href + '"]')
            if(kombox_a.length == 1){
                $(element).remove();
            } else {
                $i++;
                showElement.push($(element));
            }
        });
        
        let half = parseInt(showElement.length / 2);
        let newHTML = "<div class='tags-items_1'>";
        
        $i = 0;
        showElement.forEach(function(element){
            if($i == half){
                newHTML += "</div><div class='tags-items_2'>";
            }
            newHTML += element.get(0).outerHTML;
            $i++;
        });
        
        newHTML += "</div>";
        $('.catalog__tags.mobile').html(newHTML);
        
    });
});