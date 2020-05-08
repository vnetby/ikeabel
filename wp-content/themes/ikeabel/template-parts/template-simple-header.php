<?php
$title = get_from_array($headSets, 'title');
$subtitle = get_from_array($headSets, 'subtitle');
$breadcrumbs = get_from_array($headSets, 'breadcrumbs');
$bg = get_from_array($headSets, 'bg');
?>


<header class="header simple-header parallax-window" data-parallax="scroll" data-image-src="<?= $bg; ?>">
  <?php
  if ($bg) {
    ?>
    <!-- <div class="bg-img"><img src="<?= $bg; ?>" alt="header background"></div> -->
  <?php
  }
  ?>
  <div class="container">
    <!-- <div class="head-content"> -->
      <?php
      if ($title) {
        ?>
        <h1 class="page-title"><?= $title; ?></h1>
      <?php
      }
      if ($subtitle) {
        ?>
        <h2 class="subtitle">
          <span class="arrow"></span>
          <span class="text"><?= $subtitle; ?></span>
        </h2>
      <?php
      }
      ?>
    <!-- </div> -->
    <?php
    if ($breadcrumbs) {
      ?>
      <div class="breadcrumbs-row">
        <?= vnet_breadcrumbs(); ?>
      </div>
    <?php
    }
    ?>
  </div>
</header>