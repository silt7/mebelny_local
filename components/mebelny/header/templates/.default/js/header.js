  // OPEN FORM SEARCH MOBILE
  const closeSearch = document.querySelector('.top-search .close');
  const mobSearch = document.querySelector('.header-mob-search');
  const openSearch = document.querySelector('.top-search__btn__mob');
  const formSearch = document.querySelector('.top-search');

  closeSearch.onclick = e => {
    openSearch.querySelector('i').classList.remove('fa-times');
    formSearch.classList.remove('top-search__active');
    formSearch.classList.remove('active');
    mobSearch.classList.remove('active');
  };
  openSearch.onclick = e => {
    openSearch.querySelector('i').classList.toggle('fa-times');
    formSearch.classList.toggle('top-search__active');
  };

  // TOP MENU 
  const topMenu = document.querySelector('.top-menu__mob');
  const topMenuBtn = document.querySelector('.top-menu__open');
  const topMenuBtnClose = document.querySelector('.top-menu__close');
  const topMenuHamburger = document.querySelector('.top-menu__hamburger');

  topMenuBtnClose.onclick = e => {
    topMenu.classList.remove('top-menu__mob__active');
    topMenuHamburger.classList.remove('top-menu__hamburger__active');
  };
  topMenuBtn.onclick = e => {
    topMenu.classList.toggle('top-menu__mob__active');
    topMenuHamburger.classList.toggle('top-menu__hamburger__active');
  };
  document.body.addEventListener('click', e => {
    if (!e.target.closest('.top-menu__close') && !e.target.closest('.top-menu__mob') && !e.target.closest('.top-menu__open')) {
      topMenu.classList.remove('top-menu__mob__active');
      topMenuHamburger.classList.remove('top-menu__hamburger__active');
    }
  });

  // MAIN MENU 
  const mainMenu = document.querySelector('.main-menu');
  const mainMenuOpen = document.querySelector('.main-menu__hero .main-menu__link');

  mainMenuOpen.onclick = () => {
    mainMenu.classList.toggle('main-menu__active');
  }
  document.body.addEventListener('click', e => {
    if (!e.target.closest('.main-menu__hero .main-menu__link') && !e.target.closest('.main-menu__item') && !e.target.closest('.main-menu__drop') && !e.target.closest('.top-search .close')) {
      console.log(3);
      mainMenu.classList.remove('main-menu__active');
    }
  });
  
    function openRecallPopup(click1 = "N")
    {
       var authPopup = BX.PopupWindowManager.create("RecallPopup", null, {
             autoHide: true,
             offsetLeft: 0,
             offsetTop: 0,
             overlay : true,
             draggable: {restrict:true},
             closeByEsc: true,
             closeIcon: { right : "12px", top : "10px"},
             content: '<div style="width:300px;height:200px; text-align: center;"></div>',
                events: {
                   onAfterPopupShow: function()
                   {
                         this.setContent(BX("bx_recall_popup_form"));
                   }
             }
            });

         authPopup.show();
         if (click1 == 'Y'){
            $('#RecallPopup').find('form').attr({"onsubmit": "ym(26789943,'reachGoal','1click', {URL:document.location.href}); gtag('event', '1click_ga')"});
         } else {
            $('#RecallPopup').find('form').attr({"onsubmit": "ym(26789943,'reachGoal','callback-or-freeconsultation', {URL:document.location.href}); gtag('event', 'kons_ga');"});             
         }
    }

    // MOBILE MENU 
    function auth(action){
        let api_auth = $('.api_auth_ajax');
        switch(action){
            case 'sign-in':
                api_auth.find('.enter')[0].click();
                break;
            case 'reg': 
                api_auth.find('.register')[0].click();
                break;
            case 'lk': 
                api_auth.find('.enter.exit')[0].click();
                break;
            case 'exit': 
                api_auth.find('.register')[0].click();
                break;
        }
    }
    

// $('.main-menu__item__more').on('mouseenter', function() {
//   let items = $(this).find('.main-menu__drop__sec .container').html();
//   $('.main-menu__scroll .container').html(items);
// });
// $('.main-menu__drop').on('mouseleave', function() {
//   $('.main-menu__scroll .container').html('');
// });