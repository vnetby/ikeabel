<?php
$title = get_from_array($block, 'title');
$desc = get_from_array($block, 'desc');
$link = get_from_array($block, 'link');
$img = get_acf_img_src(get_from_array($block, 'img'));
$link_text = get_from_array($block, 'link_text');
?>


<section class="section section-text-img-link grey-bg mt-section mb-section" data-admin>
  <div class="container">
    <div class="content-col">
      <div class="content-wrap brand-bg">
        <div class="content">
          <?php
          if ($title) {
          ?>
            <h2 class="section-title">
              <?= $title; ?>
            </h2>
            <span class="line"></span>
          <?php
          }
          if ($desc) {
          ?>
            <div class="desc">
              <?= $desc; ?>
            </div>
          <?php
          }
          if ($link && $link_text) {
          ?>
            <div class="btn-row">
              <a href="<?= $link; ?>" class="btn blue-light-btn"><?= $link_text; ?></a>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
    <div class="img-col">
      <?php
      if ($img) {
      ?>
        <div class="img-wrap">
          <img src="<?= $img; ?>" alt="<?= $title ? $title : 'block image'; ?>">
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>