<?php
$title = get_from_array($block, 'title');
$steps = get_from_array($block, 'steps');

?>
<section class="section section-how-order" data-admin>
  <div class="container">
    <?php
    if ($title) {
    ?>
      <h2 class="section-title left-border">
        Как сделать заказ
      </h2>
    <?php
    }
    ?>
    <div class="content">
      <?php
      if (is_array($steps)) {
        $count = 1;
        foreach ($steps as &$step) {
          $img = get_acf_img_src(get_from_array($step, 'img'));
          $title = strip_editor(get_from_array($step, 'title'));
          $desc = strip_editor(get_from_array($step, 'desc'));
      ?>
          <div class="iteration-row">
            <div class="illustration">
              <div class="svg-wrap">
                <?php
                if ($img) {
                ?>
                  <img src="<?= $img; ?>" alt="<?= 'illustration'; ?>">
                <?php
                }
                ?>
              </div>
            </div>
            <div class="count">
              <span class="num"><?= $count; ?></span>
            </div>
            <div class="iteration-desc">
              <?php
              if ($title) {
              ?>
                <h3 class="iteration-title"><?= $title; ?></h3>
              <?php
              }
              if ($desc) {
              ?>

                <div class="description">
                  <?= $desc; ?>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
      <?php
          $count++;
        }
      }
      ?>


    </div>
  </div>
</section>