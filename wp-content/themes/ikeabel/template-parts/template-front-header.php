<?php
$carouselSets = [
  'type' => 'carousel',
  'perView' => 1,
  'hoverpause' => false
];

$sliders = get_field('front_header');

if (!$sliders) return;

if (!is_array($sliders)) return;

$total = count($sliders);
if (!$total) return;


?>

<header class="header front-header mb-section">

  <div class="js-front-header opacity-load" data-carousel-sets='<?= json_encode($carouselSets); ?>'>

    <div class="glide">

      <div class="glide__track" data-glide-el="track">
        <div class="glide__slides">
          <?php
          foreach ($sliders as &$slide) {
            $up = get_from_array($slide, 'title_up');
            $title = get_from_array($slide, 'title');
            $img = get_from_array($slide, 'img');
            $img = $img ? $img['url'] : false;
            // $title = strip_editor($title);
            // echo (htmlspecialchars($title));
          ?>
            <div class="glide__slide">
              <div class="slide-content">
                <?php
                if ($img) {
                ?>
                  <div class="bg-img">
                    <img src="<?= $img; ?>" alt="<?= $title ? strip_tags($title) : 'background image'; ?>">
                  </div>
                <?php
                }
                if ($title || $up) {
                ?>
                  <div class="title-wrap">
                    <div class="container">
                      <div class="animation-item">
                        <?php
                        if ($up) {
                        ?>
                          <div class="up">
                            <?= $up; ?>
                          </div>
                        <?php
                        }
                        if ($title) {
                        ?>
                          <h2 class="slide-title"> <?= $title ?></h2>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
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


      <div class="bullets-container">
        <div class="container">

          <div class="glide__bullets" data-glide-el="controls[nav]">

            <?php
            for ($i = 0; $i < $total; $i++) {
            ?>
              <button class="glide__bullet" data-glide-dir="=<?= $i; ?>"></button>
            <?php
            }
            ?>
          </div>
        </div>
      </div>

    </div>
  </div>

</header>