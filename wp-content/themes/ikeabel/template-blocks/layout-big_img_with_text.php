<?php
$title = get_from_array($block, 'title');
$desc = strip_editor(get_from_array($block,'desc'));
$img = get_acf_img_src(get_from_array($block,'img'));

$reverse = get_from_array($block, 'reverse');
$reverse = $reverse ? ' reverse' : '';
?>

<section class="section section-bigimg-text<?= $reverse; ?>" data-admin>
  <div class="container">
    <div class="img-col">
      <div class="img-wrap">
        <?php
        if ($img) {
          ?>
          <img src="<?= $img; ?>" alt="preview block">
          <?php
        }
        ?>
      </div>
    </div>
    <div class="content-col">
      <?php
      if ($title) {
        ?>
        <h2 class="section-title"><?= $title; ?></h2>
        <?php
      }
      if ($desc) {
        ?>
        <div class="desc">
          <?= $desc; ?>
          <div class="line"></div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>