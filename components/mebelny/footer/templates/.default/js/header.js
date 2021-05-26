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
    if (!e.target.closest('.main-menu__hero .main-menu__link') && !e.target.closest('.main-menu__item')) {
      mainMenu.classList.remove('main-menu__active');
    }
  });
  
    function openRecallPopup()
    {
       var authPopup = BX.PopupWindowManager.create("RecallPopup", null, {
             autoHide: true,
             offsetLeft: 0,
             offsetTop: 0,
             overlay : true,
             draggable: {restrict:true},
             closeByEsc: true,
             closeIcon: { right : "12px", top : "10px"},
             content: '<div style="width:400px;height:400px; text-align: center;"><span style="position:absolute;left:50%; top:50%"><img src="/bitrix/templates/eshop_adapt_yellow/img/wait.gif"/></span></div>',
                events: {
                   onAfterPopupShow: function()
                   {
                         this.setContent(BX("bx_recall_popup_form"));
                   }
             }
            });

         authPopup.show();
    }