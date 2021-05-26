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
    <form id="form2" action="<?=$arResult["FORM_ACTION"]?>">
        <div class="search">
            <button class="search-btn" type="button" id="submit2"></button>
            <input type="text" placeholder="Введите название товара или артикул" name="q" id="date">
            <a href="#" class="search-close"></a>
        </div>                 
    </form>