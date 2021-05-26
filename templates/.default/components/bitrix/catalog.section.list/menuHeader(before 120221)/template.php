<?if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<?global $USER;
if (!$USER->IsAdmin()){?>

<?foreach($arResult['SECTIONS'] as $arSection):?>
    <a class="main-menu__item main-menu__item__hero main-menu__item__more" href="<?=$arSection[SECTION_PAGE_URL]?>">
      <div class="main-menu__icon-wrap">
        <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON]?>" alt=""
          class="main-menu__icon">
        <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON_HOVER]?>" alt=""
          class="main-menu__icon main-menu__icon__hover">
      </div>
      <span class="main-menu__text"><?=$arSection[NAME]?></span>
    </a>
  <?endforeach?>
<?}?>

<?global $USER;
  if ($USER->IsAdmin()){?>

<?foreach($arResult['SECTIONS'] as $arSection):?>
  <div class="main-menu__item main-menu__item__hero main-menu__item__more">
    <a class="prevent" href="<?=$arSection[SECTION_PAGE_URL]?>">
      <div class="main-menu__icon-wrap">
        <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON]?>" alt=""
          class="main-menu__icon">
        <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON_HOVER]?>" alt=""
          class="main-menu__icon main-menu__icon__hover">
      </div>
      <span class="main-menu__text"><?=$arSection[NAME]?></span>
    </a>

    <div class="main-menu__drop__sec">
      <div class="container">

          <? for ($i = 0; $i <= 10; $i++) {?>
              <div class="main-menu__item main-menu__item__sec main-menu__item__more">
                <a href="<?=$arSection[SECTION_PAGE_URL]?>">
                  <div class="main-menu__icon-wrap">
                    <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON]?>" alt=""
                    class="main-menu__icon">
                    <img loading="lazy" decoding="async" src="<?=$arSection[UF_MENU_ICON_HOVER]?>" alt=""
                    class="main-menu__icon main-menu__icon__hover">
                  </div>
                  <span class="main-menu__text"><?=$arSection[NAME]?></span>
                </a>
              </div>
            <?}?>
              
            <div class="main-menu__show-more menu__show-more__sec">
              <img src="/upload/chevron-bottom.svg" class="desc" alt="">
              <img src="/upload/arrow-left.svg" class="mobile" alt="">
              <span class="mobile">Каталог товаров</span>
            </div>
          </div>
        </div>
        
    </div>
  <?endforeach?>

<style> 
  .main-menu__active .main-menu__drop {
    max-height: none !important;
    height: auto !important;
    padding-bottom: 48px;
    overflow: visible;
  }
  .main-menu {
    position: relative;
  }
  .main-menu__drop__sec {
    display: none;
    max-height: 430px;
    max-height: none;
    top: 0;
    position: absolute;
    left: 100%;
    width: 321px;
    background: #FFF;
    box-shadow: 0 0 15px #0000002b;
    z-index: 10;
    padding-bottom: 48px;
    transition: 0s !important;
  }
  .main-menu__item__sec {
    opacity: 1 !important;
  }

  .main-menu__drop {
    transition: 0s !important;
    /* height: 430px; */
    height: 0;
    top: 104%;
    position: absolute;
    left: -15px;
    width: 321px;
    background: #FFF;
    border-right: 1px solid #F5F6F9;
    box-shadow: 0 0 15px #0000002b;
  }
  .main-menu__item {
    height: 48px;
    width: 100%;
    background: #FFFFFF;
    opacity: 0.4;
    color: #000000;
    font-style: normal;
    font-weight: normal;
    font-size: 16px;
    line-height: 48px;
    padding-left: 0;
    border: none !important;
    padding: 0 15px;
  }
  .main-menu__item a {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    font-size: 16px;
    color: #000000;
    text-decoration: none;
    width: 100%;
  }
  .main-menu__item:hover a {
    text-decoration: none;
    color: #000000;
  }
  .main-menu__item:hover {
    background: #F5F6F9;
    opacity: 1;
    color: #000000;
    border: none;
  }
  
  .main-menu__show-more .mobile {
    display: none;
  }
  .main-menu__item:hover .main-menu__icon {
    opacity: 1;
  }
  .main-menu__item:hover .main-menu__icon__hover {
    opacity: 0;
  }
  .main-menu__drop .container {
    flex-wrap: nowrap;
    max-height: none;
    padding: 0;
  }
  .main-menu__show-more {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    cursor: pointer;
    z-index: 4;
    transition: 0s.3s;
  }
  .main-menu__show-more.active img.desc {
    transform: scaleY(-1);
  }
  .main-menu__show-more:hover {
    background: #F5F6F9;
  }
  .main-menu__item__more::after {
    content: url('/upload/chevron-bottom.svg');
    position: absolute;
    right: 17px;
    transform: rotate(-90deg);
  }
  @media (min-width: 735.99999px) {
    .main-menu__item:hover .main-menu__drop__sec {
      display: block;
    }
    .main-menu__item__hero {
      position: relative;
    }
  }
  @media (max-width: 736px) {
    .main-menu__drop {
      width: 100%;
      left: 0;
    }
    .main-menu__item {
      height: 48px !important;
    }
    .main-menu__drop__sec {
      padding-top: 48px;
      padding-bottom: 0;
    }
    .main-menu {
      position: static;
    }
    .main-menu__show-more {
      top: 0;
      bottom: auto;
      justify-content: flex-start;
      padding-left: 15px;
    }
    .main-menu__show-more .desc {
      display: none;
    }
    .main-menu__show-more span.mobile {
      padding-left: 15px;
    }
    .main-menu__show-more .mobile {
      display: block;
      font-style: normal;
      font-weight: normal;
      font-size: 14px;
      line-height: 22px;
      color: #4A5160;
    }
    .main-menu__active .main-menu__drop {
      padding-top: 48px;
      padding-bottom: 0;
    }
    .item-hide, .item-hide__sec {
      display: flex !important;
    }
    .main-menu__drop__sec.active {
      transform: translateX(0);
      width: 100%;
      z-index: 0;
    }

    .main-menu__item__hero a.prevent {
      pointer-events: none;
    }
    .main-menu__item__hero.active_mob {
      height: 0 !important;
    }
    .main-menu__item__hero.active {
      opacity: 1;
    }
    .main-menu__item__hero.active .main-menu__drop__sec {
      display: block;
      transform: translateX(-100%);
      width: 100%;
      z-index: 99;
    }
  }



/* ДЛЯ НОВОЙ СВЕТЛОЙ ШАПКИ */
.header-new-mob {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-right: 5px;
}
.header-mob-search {
  display: block;
  margin-left: auto;
  cursor: pointer;
}
.header-bottom {
  background-color: #F5F6F9;
}
.main-menu__link {
  color: #8392A8;
}
.main-menu__hero .main-menu__link {
  color: #4A5160;
}
.top-search {
  background-color: transparent;
}
.top-search__input::placeholder {
  color: #8392A8;
}
.top-search__input {
  background-color: #fff;
  color: #8392A8;
  margin-top: 4px;
  margin-bottom: 4px;
  padding: 11px 50px 11px 24px;
}
.top-search__btn {
  color: #4A5160;
}
.main-menu__hamburger {
  background-image: url('/upload/new_menu_icon.svg');
  background-size: contain;
}
.main-menu__hamburger span {
  display: none;
}
.top-menu__hamburger {
  margin-right: 24px;
}
.top-menu__hamburger span {
  display: block;
  background-color: #4A5160;
}
.icon_menu {
  display: none !important;
}
.header-mob-search .fa-close {
  display: none;
}
.header-new-mob, .header-item__cart {
  display: none;
}
.header-bottom__wrap .top-menu__open {
  display: none;
}
@media (max-width: 1024px) {
  .main-menu ul li {
    display: block;
  }
}
@media (max-width: 736px) {
  .header-top, .header-item {
    display: none;
  }
  .header-new-mob .header-item {
    display: flex;
  }
  .header-new-mob, .header-item__cart {
    display: flex;
  }
  .main-menu__hamburger {
    display: block;
  }
  .top-search {
    /* display: none; */
    height: 0;
  }
  .header-mob-search.active .fa-search {
    display: none;
  }
  .header-mob-search.active .fa-close {
    display: block;
  }
  .top-search.active {
    /* display: block; */
    height: 45px;
    box-shadow: 0 1px 3px #80808099;
  }
  .top-menu__mob {
    background: #F5F6F9;
  }
  .top-menu__item {
    color: #4A5160;
  }
  .main-menu ul li:not(.main-menu__hero) {
    display: none;
  }
  .header-item__desc {
    text-decoration: none !important;
  }
  .header-item__desc strong {
    font-weight: normal;
    font-size: 14px;
    line-height: 22px;
    color: #4A5160;
  }
  .header-item__desc small {
    font-style: normal;
    font-weight: normal;
    font-size: 10px;
    line-height: 16px;
    color: #8392A8;
  }
  .header-bottom {
    padding-top: 12px;
    padding-bottom: 12px;
  }
  .main-menu__hero {
    padding-top: 0;
    padding-bottom: 0;
  }
  .header-item__cart {
    width: 50%;
    border-left: 1px solid #E3E5EB;
    justify-content: flex-end;
    padding-top: 0;
    padding-bottom: 0;
  }
  .header-item__img {
    margin-right: 16px;
  }
  .top-menu__open {
    width: auto;
    padding-left: 0;
    border-left: none;
}
}
</style>
<script>
  $(document).ready(function() {
    $('.main-menu__item__hero').on('click', function(e) {
      $('.main-menu__item__hero').removeClass('active');
      if (!e.target.closest('.menu__show-more__sec')) {
        $(this).addClass('active');
        $('.main-menu__item__hero').addClass('active_mob');
      }
    });
    for (let i = 0; i < $('.main-menu__item__hero').length; i++) {
      if (i >= 8) {
        $('.main-menu__item__hero').eq(i).animate({height: 'hide'}, 0).addClass('item-hide');
      }
      for (let x = 0; i < $('.main-menu__item__hero').eq(x).find('.main-menu__item__sec').length; x++) {
        if (x >= 8) {
          $('.main-menu__item__hero').eq(i).find('.main-menu__item__sec').eq(x).animate({height: 'hide'}, 0).addClass('item-hide__sec');
        }
      }
    }
    $('.menu__show-more').on('click', function() {
      $(this).toggleClass('active');
      if ($(this).hasClass('active')) {
        $(this).parents('.main-menu__drop').find('.item-hide').animate({height: 'show'}, 0);
      } else {
        $(this).parents('.main-menu__drop').find('.item-hide').animate({height: 'hide'}, 0);
      }
    });
    $('.menu__show-more__sec').on('click', function() {
      $('.main-menu__item__hero').removeClass('active active_mob');
      $(this).toggleClass('active');
      if ($(this).hasClass('active')) {
        $(this).parents('.main-menu__drop__sec').find('.item-hide__sec').animate({height: 'show'}, 0);
      } else {
        $(this).parents('.main-menu__drop__sec').find('.item-hide__sec').animate({height: 'hide'}, 0);
      }
    });
    $('.header-mob-search').on('click', function() {
      $(this).toggleClass('active');
      $('.top-search').toggleClass('active');
      $('.top-search__input').focus();
    });
  });
</script>
<?}?>