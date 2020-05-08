<?php
$title = get_from_array($block, 'title');
if (!$title) return;
?>


<section class="section section-big-title" data-admin>
  <div class="container">
    <h2 class="section-title">
      <?= $title; ?>
    </h2>
  </div>
</section>