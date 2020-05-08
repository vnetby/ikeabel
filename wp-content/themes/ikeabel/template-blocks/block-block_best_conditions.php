<?php
$title = get_from_array($block, 'title');
$text = get_from_array($block, 'text');

$text = $text ? strip_editor($text) : false;
?>
<section class="section best-conditions" data-admin>
  <div class="container">
    <?php
    if ($title) {
      ?>
      <h2 class="section-title">
        <?= $title; ?>
      </h2>
    <?php
    }

    if ($text) {
      ?>
      <div class="content">
        <?= $text; ?>
      </div>
    <?php
    }
    ?>
  </div>
</section>