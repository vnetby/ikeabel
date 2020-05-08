<?php
$title = strip_editor(get_from_array($block, 'title'));
$desc = strip_editor(get_from_array($block, 'desc'));
?>


<section class="section about-us-section" data-admin>
  <div class="container">
    <div class="title-col">
      <?php
      if ($title) {
        ?>
          <h2 class="section-title">
            <?= $title; ?>
          </h2>
        <?php
      }
      ?>
    </div>
    <div class="desc-col">
      <span class="line"></span>
      <?php
        if ($desc) {
          ?>
            <div class="desc">
              <?= $desc; ?>
            </div>
          <?php
        }
      ?>
    </div>
  </div>
</section>