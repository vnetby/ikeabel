<?php
$title = get_from_array($block, 'title');
$advantages = get_from_array($block, 'advantages');
?>


<section class="section section-advantages" data-admin>
  <div class="container">
    <?php
    if ($title) {
      ?>
      <h2 class="section-title left-border">
        <?= $title; ?>
      </h2>
    <?php
    }

    if (is_array($advantages)) {
      ?>
      <div class="row advantages-row">
        <?php
          foreach ($advantages as &$adv) {
            $ico = get_from_array($adv, 'ico');
            $ico = $ico ? $ico['url'] : false;
            $title = get_from_array($adv, 'title');
            $desc = get_from_array($adv, 'desc');
            $desc = $desc ? strip_editor($desc) : false;
            ?>
          <div class="col">
            <div class="advantages-item">
              <?php
                  if ($ico) {
                    ?>
                <div class="thumb">
                  <img src="<?= $ico; ?>" alt="<?= $title ? $title : 'advantages ico'; ?>">
                </div>
              <?php
                  }
                  if ($title) {
                    ?>
                <h3 class="adv-title"><?= $title; ?></h3>
              <?php
                  }
                  if ($desc) {
                    ?>
                <div class="adv-desc">
                  <?= $desc; ?>
                </div>
              <?php
                  }
                  ?>
              <div class="anim-el"></div>
            </div>
          </div>
        <?php
          }
          ?>
      </div>
    <?php
    }
    ?>
  </div>
</section>