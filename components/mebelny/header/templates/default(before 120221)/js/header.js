  // OPEN FORM SEARCH MOBILE
  const openSearch = document.querySelector('.top-search__btn__mob');
  const formSearch = document.querySelector('.top-search');

  openSearch.onclick = e => {
    openSearch.querySelector('i').classList.toggle('fa-times');
    formSearch.classList.toggle('top-search__active');
  };

  // TOP MENU 
  const topMenu = document.querySelector('.top-menu__mob');
  const topMenuBtn = document.querySelector('.top-menu__open');
  const topMenuHamburger = document.querySelector('.top-menu__hamburger');

  topMenuBtn.onclick = e => {
    topMenu.classList.toggle('top-menu__mob__active');
    topMenuHamburger.classList.toggle('top-menu__hamburger__active');
  };
  document.body.addEventListener('click', e => {
    if (!e.target.closest('.top-menu__mob') && !e.target.closest('.top-menu__open')) {
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
    if (!e.target.closest('.main-menu__hero .main-menu__link') && !e.target.closest('.main-menu__item')  && !e.target.closest('.main-menu__drop')) {
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

    