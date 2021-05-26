<?
// Редирект с 1й страницы пагинации на страницу без этого параметра.
if($_GET['PAGEN_1']==1){
	LocalRedirect($APPLICATION->GetCurDir(), false, '301 Moved permanently');
}