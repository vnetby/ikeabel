<?php
$form_id = get_from_array($block, 'form_id');
if (!$form_id) return;
$title = get_from_array($block, 'title');
$form_title = get_from_array($block, 'title_form');
?>


<section class="section section-contact-block" data-admin>
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
    <div class="col-form-container">
      <?php
      if ($form_title) {
        ?>
        <h4 class="form-title"><?= $form_title; ?></h4>
        <?php
      }
      ?>
      <?php
      echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
      ?>
    </div>
  </div>
</section>