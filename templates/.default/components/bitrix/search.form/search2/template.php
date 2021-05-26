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
       $("#submit").click(function(){
             $("#form").submit();
       })
    })
    </script>
    <form class="form-horizontal form-light p-15" id="form" action="<?=$arResult["FORM_ACTION"]?>">
        <div class="input-group">
            <input type="text" name="q" class="form-control" id="date" placeholder="поищем чего-нибудь?">
            <span class="input-group-btn">
                <a class="btn btn-base" id="submit" href="javascript:void(0)"><i class="fa fa-search"></i></a>
            </span>
        </div>
    </form>