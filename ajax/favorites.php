<?require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$GLOBALS['APPLICATION']->RestartBuffer();
/* Избранное */
   global $APPLICATION;
   if($_GET['id'])
   {
       if(!$USER->IsAuthorized()) // Для неавторизованного
       {
//           $arElements = '';
           if($_COOKIE['favorites']){
               $arElements = unserialize($_COOKIE['favorites']);
           }else{
               $arElements = array();
           }

           if(!in_array($_GET['id'], $arElements))
           {
               $arElements[] = $_GET['id'];
               $result = 1; // Датчик. Добавляем
           }
           else {
               $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
               unset($arElements[$key]);
               $result = 2; // Датчик. Удаляем
           }
           setcookie("favorites", serialize($arElements), time()+3600000, "/");
           //$APPLICATION->set_cookie("BITRIX_SM_favorites", serialize($arElements), time()+60*60*24*30*12*2, "/");
       }
       else { // Для авторизованного
           $idUser = $USER->GetID();
           $rsUser = CUser::GetByID($idUser);
           $arUser = $rsUser->Fetch();
           $arElements = $arUser['UF_FAVORITES'];  // Достаём избранное пользователя
           if(!in_array($_GET['id'], $arElements)) // Если еще нету этой позиции в избранном
           {
               $arElements[] = $_GET['id'];
               $result = 1;
           }
           else {
               $key = array_search($_GET['id'], $arElements); // Находим элемент, который нужно удалить из избранного
               unset($arElements[$key]);
               $result = 2;
           }
           $USER->Update($idUser, Array("UF_FAVORITES"=>$arElements )); // Добавляем элемент в избранное
       }
   }
/* Избранное */
echo json_encode($result);
die();
