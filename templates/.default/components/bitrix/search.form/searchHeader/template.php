<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
/** @var array $arParams */ 
/** @var array $arResult */ 
/** @global CMain $APPLICATION */ 
/** @global CUser $USER */ 
/** @global CDatabase $DB */ 
/** @var CBitrixComponentTemplate $this */ 
/** @var string $templateName */ 
/** @var string $templateFile */ 
/** @var string $templateFolder */ 
/** @var string $componentPath */ 
/** @var CBitrixComponent $component */ 
$this->setFrameMode(true);?>

    <script>
		$(document).ready(function(){
		   $("#submit2").click(function(){
				 $("#form2").submit();
		   })
		})
    </script>
    <form id="form2" action="<?=$arResult["FORM_ACTION"]?>" class="top-search">
      <input type="text" class="top-search__input" name="q" id="date" placeholder="Введите название товара или артикул">
      <div class="close"></div>
      <button type="submit" class="top-search__btn search-btn" id="submit2"><i class="fa fa-search"></i></button>
    </form>