<?php
global $about, $svg;
?>
<!DOCTYPE html>
<html lang="<?= LANG; ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php
  wp_head();
  ?>
  <link rel="stylesheet" href="<?= CURRENT_SRC; ?>assets/assets.min.css">
  <link rel="stylesheet" href="<?= CHILD_SRC; ?>css/main.min.css">

  <!-- Google Analytics -->
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-143505101-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');
  </script>
  <!-- End Google Analytics -->

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-PKT55CX');</script>
  <!-- End Google Tag Manager -->
  
</head>

<body class="<?= implode(' ', get_body_class()); ?>">
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKT55CX"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


  <div class="site-wrap" id="siteWrap">
    <div class="top-bar">

      <div class="ship-row">
        <div class="container contacts-container">
          <div class="row contacts-row">
            <div class="next-shipping-col">
              <div class="ship-title">Ближайшая доставка:</div>
              <div class="ship-dates">
                <?php
                $ship = get_field('next_shipping_days', 'option');
                if (is_array($ship)) {
                  foreach ($ship as &$row) {
                    if (!is_array($row)) continue;
                    if (isset($row['from']) || isset($row['to'])) {
                      ?>
                      <div class="ship-date-row">
                        <?= isset($row['from']) ? $row['from'] : ''; ?>
                        <?= isset($row['from']) && isset($row['to']) ? ' - ' : ''; ?>
                        <?= isset($row['to']) ? $row['to'] : ''; ?>
                      </div>
                <?php
                    }
                  }
                }
                ?>
              </div>
            </div>
            <div class="contacts-col">
              <div class="dropdown-container">
                <button class="open-dropdown ico">
                  <?= $svg->get_ico('urban'); ?>
                </button>
                <div class="dropdown-content right">
                  <?php
                  about_phones_html(2);
                  about_emails_html(1);
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="dom-fixed-nav">
        <div class="container">
          <div class="row top-menu-row">
            <div class="logo-col">
              <?php
              if (isset($about['logo'])) {
                echo '<a href="/" class="block">';
                echo $about['logo'];
                echo '</a>';
              }
              ?>
            </div>
            <div class="menu-col">
              <?php
              wp_nav_menu([
                'theme_location'  => 'top_menu',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'top-menu',
                'menu_id'         => 'topMenu',
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
              <div class="open-offcanvas">
                <div class="hamburger hamburger--slider js-hamburger dom-open-modal" data-dom-body-class="offcanvas-menu" data-target="#offcanvasMenu">
                  <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                  </div>
                </div>
              </div>
            </div>


            <div class="offcanvas-menu dom-modal" id="offcanvasMenu">
              <div class="bg-img">
                <img src="<?= CURRENT_SRC; ?>/img/menu-bg.jpeg" alt="background menu">
              </div>
              <div class="dom-custom-scrollbar">
                <?php
                wp_nav_menu([
                  'theme_location'  => 'top_menu',
                  'container'       => '',
                  'container_class' => '',
                  'container_id'    => '',
                  'menu_class'      => 'offcanvas-menu-list',
                  'menu_id'         => 'offcanvasMenuList',
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
            </div>

          </div>

        </div>


      </div>

    </div>



    <?php

    $hasHeader = false;
    if (is_front_page()) {
      require(CURRENT_PATH . 'template-parts/template-front-header.php');
      $hasHeader = true;
    }


    if (is_page() && !$hasHeader) {
      global $post;
      $headSets = get_page_head_sets($post);
      require(CURRENT_PATH . 'template-parts/template-simple-header.php');
    }
