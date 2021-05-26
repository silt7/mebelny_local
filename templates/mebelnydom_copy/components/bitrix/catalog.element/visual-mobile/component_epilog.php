<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;
$arFavorites = array();
if(!$USER->IsAuthorized())
{
    $arFavorites = unserialize($_COOKIE["favorites"]);
    //print_r($arFavorites);
}
else {
    $idUser = $USER->GetID();
    $rsUser = CUser::GetByID($idUser);
    $arUser = $rsUser->Fetch();
    $arFavorites = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя
}
count($arFavorites);
/* Меняем отображение сердечка товара */
foreach($arFavorites as $k => $favoriteItem){?>
    <script>
        $(document).ready(function() {
            id = "<?=$favoriteItem?>";
            $('.add-product .addFav[data-id="'+id+'"]').closest('.add_favorites ').addClass('active');
            $('.add-product .addFav[data-id="'+id+'"]').text('Убрать из избранного');
            $('.addFav[data-id="'+id+'"]').find('i').addClass('active');
        });
    </script>
<?}?>