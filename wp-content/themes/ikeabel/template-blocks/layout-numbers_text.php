<?php
$title = get_from_array($block, 'title');
$nums = get_from_array($block, 'numbers');
if (!is_array($nums)) return;

?>


<section class="section section-numbers" data-admin>
  <div class="container">
    <?php
    if ($title) {
      ?>
      <h2 class="left-border section-title">
        <?= $title; ?>
      </h2>
    <?php
    }
    ?>
    <div class="row nums-row">
      <?php
      foreach ($nums as &$item) {
        $num = get_from_array($item, 'num');
        $text = get_from_array($item, 'text');
        ?>
        <div class="num-col">
          <div class="num-item">
            <div class="num dom-count-on-scroll" data-max="<?= $num; ?>" data-margin="-100" data-interval="100" data-step="20">
              0
            </div>
            <div class="text">
              <?= $text; ?>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>