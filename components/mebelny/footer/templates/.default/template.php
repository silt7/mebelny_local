<?php $this->addExternalCss($templateFolder."/styles.css");?>
<footer class="footer">
  <div class="footer-top middle">
    <div class="container">
      <div class="mid-flex">
        <div class="logo middle-block">
          <div class="img-wrap">
            <img decoding="async" src="/upload/sofa.png" alt="logo" />
          </div>
          <div class="text-wrap">
            <span class="h2">Мебельный Дом</span>
            <p>Ваш источник уюта</p>
          </div>
        </div>
        <!-- <div class="service-flex-block"> -->
        <div class="service middle-block">
          <div class="img-wrap">
            <img decoding="async" src="/upload/phone.png" alt="service" />
          </div>
          <div class="text-wrap">
            <a style="font: 18px SegoeUISemiBold; color: #4A5160;" class="phone-header callibri_phone"
              href="tel:+78003500580" onclick="ym(26789943,'reachGoal','callme', {URL: document.location.href})"><span
                class="h2">+7 (800) 350-05-80</span></a>
            <p>Бесплатно по всей России</p>
          </div>
        </div>
        <div class="service middle-block">
          <div class="img-wrap">
            <img decoding="async" src="/upload/phone.png" alt="service" />
          </div>
          <div class="text-wrap">
            <span class="h2" onclick="openRecallPopup()">
              <span class="openpopup footer-callback-btn" data-toggle="modal">Бесплатная консультация</span>
            </span>
          </div>
        </div>
        <div class="time middle-block">
          <div class="img-wrap">
            <img decoding="async" src="/upload/open.png" alt="time" />
          </div>
          <div class="text-wrap">
            <span class="h2">c 10:00 до 21:00</span>
            <p>Без выходных</p>
          </div>
        </div>
        <div class="social middle-block">
          <div class="text-wrap">
            <div class="icon">
              <span onclick="window.open('https://www.facebook.com/wwwmebelnydomcom', '_blank')"><i
                  class="fa fa-facebook" aria-hidden="true"></i></span>
              <span onclick="window.open('https://vk.com/moscowmebelnydomcom', '_blank')"><i class="fa fa-vk"
                  aria-hidden="true"></i></span>
              <span onclick="window.open('https://twitter.com/MebelnyDom', '_blank')"><i class="fa fa-twitter"
                  aria-hidden="true"></i></span>
              <span onclick="window.open('https://plus.google.com/+Mebelny-dom', '_blank')"><i class="fa fa-google"
                  aria-hidden="true"></i></span>
              <span onclick="window.open('https://www.instagram.com/mebelny_dom_com/', '_blank')"><i
                  class="fa fa-instagram" aria-hidden="true"></i></span>
            </div>
            <p>Следи за новостями</p>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
  <div class="footer-middle">
    <div class="container">
      <!-- <div class="main-menu__flex">
                <div class="main-menu__catalog">
                    <div class="btn-open">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="h3">Каталог товаров</div>
                </div>
				 <ul class="main-menu__list"><li class="nav-list__item"><a href="o_kompanii/">О компании</a></li><li class="nav-list__item"><a href="stati/">Статьи</a></li><li class="nav-list__item"><a href="akcii/">Акции</a></li><li class="nav-list__item"><a href="novosti/">Новости</a></li><li class="nav-list__item"><a href="oplata/">Оплата</a></li><li class="nav-list__item block-none"><a href="rassrochka/">Мебель в рассрочку</a></li><li class="nav-list__item block-none"><a href="dostavka/">Доставка</a></li><li class="nav-list__item block-none"><a href="garantii/">Гарантия и возврат</a></li><li class="nav-list__item block-none"><a href="kontakty/">Контакты</a></li></ul>                </div> -->

      <div class="footer-list__flex">
        <div class="list-wrap">
          <div class="h5">
            Популярные категории
          </div>
          <ul class="footer-list">
            <li><a href="/obedennye_gruppy/">Обеденные группы</a></li>
            <li><a href="/stulya/kukhonnye/">Кухонные стулья</a></li>
            <li><a href="/stoly/obedennye/">Обеденные столы</a></li>
            <li><a href="/stoly/derevyannye/">Деревянные столы </a></li>
            <li><a href="/divany/pryamye/">Прямые диваны</a></li>
            <li><a href="/divany/uglovye/">Угловые диваны</a></li>
          </ul>
        </div>
        <div class="list-wrap">
          <div class="h5">Полезная информация</div>
          <ul class="footer-list">
            <li><a href="/o_kompanii/">О компании</a></li>
            <li><a href="/kontakty/">Контакты</a></li>
            <li><a href="/stati/">Статьи</a></li>
            <li><a href="/dostavka/">Доставка</a></li>
            <li><a href="/brands/">Бренды</a></li>
          </ul>
        </div>
        <div class="list-wrap">
          <div class="h5">Фирменный шоу-рум мебели</div>
          <ul class="footer-list">
            <li>Московская область, город Королев, улица Стрекалова, дом 1</li>
            <li>Пн-Пт с 09.00 до 18.00</li>
            <li>&nbsp;</li>
            <li>Сб-Вс Выходной</li>
          </ul>
        </div>
      </div>

      <div class="copyright-flex">
        <p>
          © 2021 Интернет-магазин "Мебельный дом"
          <br>Все права защищены. Информация сайта защищена законом об
          авторских правах.
        </p>
        <p>
          <a href="/personal_data/" class="personal_data">Конфиденциальность и защита персональных данных</a>
        </p>
      </div>
    </div>
  </div>
</footer>


<?if (stripos(@$_SERVER['HTTP_USER_AGENT'], 'Lighthouse') === false):?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
  var yaParams = {
    ip: "<? echo $_SERVER['REMOTE_ADDR']; ?>"
  };
  (function (m, e, t, r, i, k, a) {
    m[i] = m[i] || function () {
      (m[i].a = m[i].a || []).push(arguments)
    };
    m[i].l = 1 * new Date();
    k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
  })
  (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

  ym(26789943, "init", {
    params: window.yaParams,
    clickmap: true,
    trackLinks: true,
    accurateTrackBounce: true,
    webvisor: true
  });
</script>
<?endif?>
<noscript>
  <div><img src="https://mc.yandex.ru/watch/26789943" style="position:absolute; left:-9999px;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-70988640-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());

  gtag('config', 'UA-70988640-1');
</script>