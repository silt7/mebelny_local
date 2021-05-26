<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->createFrame()->begin( GetMessage( "ASKARON_REVIEWS_NEW_LOADING" ) );
?>

	
	<? if( $arResult["NEW_ADDED"] ):?>
		<div class="ask-ok"><?=$arResult["NEW_ADDED_TEXT"]?></div>

        <script>
            $('.modal-review-form').show().addClass('in');
            $('#add-review-btn').hide();
            $('.askaron-reviews-for-element .modal-review-form').on('click', function (e) {
                var div = $(".askaron-reviews-for-element .modal-busket__dialog"); // тут указываем ID элемента
                if (!div.is(e.target) && div.has(e.target).length === 0) {
                    $('.modal-review-form').hide().removeClass('in');
                }
            });
            $('#review-modal-close-btn').on('click', function (e) {
                e.preventDefault();
                $('.modal-review-form').hide().removeClass('in');
            });
        </script>
		<? /*if( $arResult["PREMODERATE"] ):?>
			<div class="ask-ok"><?=$arResult["NEW_ADDED_PREMODERATE_TEXT"]?></div>
		<? endif */?>
	<? else:?>

		<? if( count( $arResult["ERRORS"] ) > 0 ):?>
			<div class="ask-error">
				<? foreach ( $arResult["ERRORS"] as $error ):?>
					<?=$error?>
				<? endforeach ?>
			</div>
		<? endif;?>			                    
		<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="add__review">
            <span class="h2"><?=GetMessage("ASKARON_REVIEWS_NEW_REVIEW_HEADER")?></span>
            <? /*if ( $arResult["PREMODERATE"] ):?>
                <div class="ask-note"><?=GetMessage("ASKARON_REVIEWS_NEW_PREMODERATE")?></div>
            <? endif */?>
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="new_review_added" value="" >
			<div class="ask-grade">
                <p class="setting-title">Ваша оценка?</p>
                <p class="add_reviews_stars">
				<? for ( $i=1; $i <= 5; $i++ ):?>
                <label class="checkbox__label" for="askaron_reviews_grade_<?=$i?>">	
					<input class="radio"		
						required
						id="askaron_reviews_grade_<?=$i?>" 
						type="radio"
						name="new_review[GRADE]"
						value="<?=$i?>"
						<? if ( $arResult["FIELDS"]["GRADE"]["VALUE"] == $i ):?>
							checked
						<? endif?>
					><span class="radio__text"></span></label>
				<? endfor?>
                </p>
			</div>
            <? if ($arResult["FIELDS"]["AUTHOR_NAME"]):?>
				<input type="text" required name="new_review[AUTHOR_NAME]" value="<?=$arResult["FIELDS"]["AUTHOR_NAME"]["VALUE"]?>" placeholder="<?=$arResult["FIELDS"]["AUTHOR_NAME"]["NAME"]?>">
			<? endif?>

			<? if ($arResult["FIELDS"]["AUTHOR_EMAIL"]):?>
				<input type="email" required name="new_review[AUTHOR_EMAIL]" value="<?=$arResult["FIELDS"]["AUTHOR_EMAIL"]["VALUE"]?>" placeholder="<?=$arResult["FIELDS"]["AUTHOR_EMAIL"]["NAME"]?>">
			<? endif?>
			<textarea required name="new_review[PRO]" placeholder="<?=$arResult["FIELDS"]["PRO"]["NAME"]?>"><?=$arResult["FIELDS"]["PRO"]["VALUE"]?></textarea>
			<textarea required name="new_review[CONTRA]" placeholder="<?=$arResult["FIELDS"]["CONTRA"]["NAME"]?>"><?=$arResult["FIELDS"]["CONTRA"]["VALUE"]?></textarea>
			<textarea class="ask-textarea-big" required  name="new_review[TEXT]" placeholder="<?=$arResult["FIELDS"]["TEXT"]["NAME"]?>"><?=$arResult["FIELDS"]["TEXT"]["VALUE"]?></textarea>

			<? if(!empty($arResult["CAPTCHA_CODE"])):?>
				<div class="ask-captcha">
					<div><?=GetMessage("ASKARON_REVIEWS_NEW_REVIEW_INPUT_CAPTCHA")?></div>

					<img alt="<?=GetMessage("CAPTCHA_ALT")?>" src="/bitrix/tools/captcha.php?captcha_code=<?=$arResult["CAPTCHA_CODE"]?>" /><input type="text" name="captcha_word" required>

					<input type="hidden" name="captcha_code" value="<?=$arResult["CAPTCHA_CODE"]?>">
				</div>
			<? endif;?>
		
				<input type="submit" name="new_review_form" class="send-btn" value="<?=GetMessage("ASKARON_REVIEWS_NEW_REVIEW_SEND")?> >">
				<input type="hidden" name="new_review_form" value="Y">
		</form>
			
	<? endif?>