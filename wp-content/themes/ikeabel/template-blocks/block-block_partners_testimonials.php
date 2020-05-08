<?php
global $svg;

$title = get_from_array($block, 'title');
$partners = get_from_array($block, 'partners');

if (!is_array($partners)) return;

?>



<section class="section section-partners-testimonials" data-admin>

  <div class="container">
    <?php
    if ($title) {
      ?>
      <h2 class="section-title left-border">
        <?= $title; ?>
      </h2>
    <?php
    }

    $carouselSets = [
      'type' => 'carousel',
      'perView' => 1,
      'autoplay' => 3000,
      'animationDuration' => 1000
    ];
    ?>
    <div class="testimonials-partners dom-carousel glide" data-dom-carousel-sets='<?= json_encode($carouselSets); ?>'>

      <div class="carousel-wrapper">

        <div class="glide__track testimonials-wrap" data-glide-el="track">
          <div class="glide__slides testimonials-container">
            <?php
            foreach ($partners as &$partner) {
              if (!is_array($partner)) continue;

              $title = get_from_array($partner, 'title');
              $person = get_from_array($partner, 'person');
              $testimonial = get_from_array($partner, 'testimonial');
              ?>
              <div class="glide__slide testimonial-item">
                <div class="testimonial-slide">
                  <?php
                    if ($testimonial) {
                      ?>
                    <div class="testimonial">
                      <?= $testimonial; ?>
                    </div>
                  <?php
                    }

                    if ($title) {
                      ?>
                    <div class="title">
                      <?= $title; ?>
                    </div>
                  <?php
                    }
                    if ($person) {
                      ?>
                    <div class="signature">
                      <?= $person; ?>
                    </div>
                  <?php
                    }
                    ?>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>

        <div class="glide__arrows" data-glide-el="controls">
          <div class="glide__arrow glide__arrow--left" data-glide-dir="<"><?= $svg->get_ico('arr_left'); ?></div>
          <div class="glide__arrow glide__arrow--right" data-glide-dir=">"><?= $svg->get_ico('arr_right'); ?></div>
        </div>
      </div>

      <div class="dom-custom-scrollbar">

        <div class="glide__bullets partners-logos" data-glide-el="controls[nav]">
          <?php
          $count = -1;
          foreach ($partners as &$partner) {
            $count++;
            $logo = get_acf_img_src($partner['logo']);
            $title = get_from_array($partners, 'title');
            if (!$logo) continue;
            ?>
            <div class="logo-wrap" data-glide-dir="=<?= $count; ?>">
              <img src="<?= $logo; ?>" alt="<?= $title ? $title : 'partner logo'; ?>">
            </div>
          <?php
          }
          ?>
        </div>

      </div>


    </div>
  </div>

</section>