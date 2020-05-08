<?php
$title = get_from_array($block, 'title');
$text = strip_editor(get_from_array($block, 'text'));
?>
<section class="section section-title-text" data-admin>
  <div class="container">
    <?php
    if ($title) {
      ?>
      <h2 class="section-title"><?= $title; ?></h2>
      <?php
    }
    if ($text) {
      ?>
      <div class="desc">
        <?= $text; ?>
      </div>
      <?php
    }
    ?>
  </div>
</section>