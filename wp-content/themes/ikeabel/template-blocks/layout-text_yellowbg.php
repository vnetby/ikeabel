<?php
$title = strip_editor(get_from_array($block, 'title'));
$uptitle = get_from_array($block, 'up_title');
$link = get_from_array($block, 'link');
$btntext = get_from_array($block, 'btn_text');

?>


<section class="section yellowbg-section shadow-intern mt-section mb-section" data-admin>
  <div class="container">
    <div class="title-col">
      <?php
      if ($uptitle) {
        ?>
        <h3 class="uptitle">
          <?= $uptitle; ?>
        </h3>
      <?php
      }
      if ($title) {
        ?>
        <h2 class="section-title">
          <?= $title; ?>
        </h2>
      <?php
      }
      ?>
    </div>
    <div class="btn-col">
      <?php
      if ($btntext && $link) {
        ?>
        <a href="<?= $link; ?>" class="btn white-btn"><?= $btntext; ?></a>
      <?php
      }
      ?>
    </div>
  </div>
</section>