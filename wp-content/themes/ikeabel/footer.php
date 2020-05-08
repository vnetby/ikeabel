<?php
global $about;

$logo = get_from_array($about, 'logo');
$legal_dates = get_from_array($about, 'legal_dates');
$desc = get_from_array($about, 'description');
?>



<footer class="footer section mt-section">
  <div class="container">
    <div class="row">
      <div class="col foot-col logo-col">
        <div class="foot-logo">

          <?php
          if ($logo) {
            echo $logo;
          }
          ?>
        </div>
        <div class="about-desc">
          <?= $desc; ?>
        </div>
      </div>
      <div class="foot-col foot-menu-col">
        <h4 class="foot-title">
          Полезные ссылки
        </h4>
        <?php
          wp_nav_menu([
            'theme_location'  => 'foot_menu',
            'container'       => '',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'foot-menu',
            'menu_id'         => 'footMenu',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
          ]);
        ?>
      </div>
      <div class="foot-col info-col">
        <h4 class="foot-title">
          Информация
        </h4>
        <div class="info">
          <?= $legal_dates; ?>
        </div>
      </div>

      <?php
          if (about_has('phones') || about_has('emails')) {
      ?>
        <div class="foot-col">
          <h4 class="foot-title">
            Контакты
          </h4>
          <?= about_phones_html(); ?>
          <?= about_emails_html(); ?>
        </div>
      <?php
          }

          if (about_has('socials')) {
      ?>
        <div class="foot-col socials-col">
          <h4 class="foot-title">
            Мы в социальных сетях
          </h4>
          <?= about_socials_html(); ?>
        </div>
      <?php
          }
      ?>



    </div>
  </div>
</footer>



</div>

<?php
          require(CURRENT_PATH . "template-parts/modals.php");
          wp_footer();
?>
<script src="<?= CURRENT_SRC; ?>assets/assets.min.js"></script>
<script src="<?= CHILD_SRC; ?>js/main.min.js"></script>



<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

ym(54375769, "init", {
  clickmap:true,
  trackLinks:true,
  accurateTrackBounce:true
});
</script>

<noscript><div><img src="https://mc.yandex.ru/watch/54375769" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "Product",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "56"
  },
  "name": "Ikeabel.by - доставка товаров из Икеа",
  "url": "https://ikeabel.by"
}
</script>
</body>

</html>

<?php
