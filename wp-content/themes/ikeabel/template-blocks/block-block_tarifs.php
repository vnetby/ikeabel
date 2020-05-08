<?php
$tarifs = ikea_get_tarifs();
if (!$tarifs) return;

$title = get_from_array($block, 'title');
$btn_text = get_from_array($block, 'btn_text');
$link = get_from_array($block, 'link');
$bg = get_from_array($block, 'bg');
$bg = $bg ? $bg['url'] : false;

$styleBg = $bg ? ' style="background-image:URL(\''.$bg.'\'"' : '';
// $parallaxClass = $bg ? ' dom-parallax-bg' : '';


$parallaxSets = [
  'scale' => 1.3
];
?>


<section class="section mt-section mb-section shadow-intern section-tarifs" <?= $styleBg; ?> data-admin>
  <div class="container">
    <div class="content">
      <img src="<?= CURRENT_SRC; ?>img/wave.png" alt="up title image" class="up-title-img">
      <?php
      if ($title) {
        ?>
        <h2 class="section-title">
          <?= $title; ?>
        </h2>
      <?php
      }
      ?>
      <div class="tarifs">
        <?php
        foreach ($tarifs as &$tar) {
          $from = get_from_array($tar, 'from');
          $to = get_from_array($tar, 'to');
          $percent = get_from_array($tar, 'percent');
          ?>
          <div class="tar-row">
            Заказ на сумму <?= $from ? 'от <strong>' . $from . ' ' . CURRENCY . '</strong>' : ''; ?>
            <?= $to ? 'до <strong>' . $to . ' ' . CURRENCY . '</strong>' : 'и более' ?>
            &mdash; комиссия <strong><?= $percent; ?>%</strong>
          </div>
        <?php
        }

        if ($link && $btn_text) {
          ?>
          <div class="btn-row">
            <a href="<?= $link; ?>" class="btn blue-btn"><?= $btn_text; ?></a>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>