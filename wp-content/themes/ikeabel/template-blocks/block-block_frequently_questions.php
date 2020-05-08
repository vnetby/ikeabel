<?php
$title = get_from_array($block, 'title');
$questions = get_from_array($block, 'questions');
$questions = is_array($questions) ? $questions : false;

if (!$questions) return;

global $svg;
?>



<section class="section questions-section" data-admin>
  <div class="container">
    <div class="title-col">
      <?php
      if ($title) {
        ?>
        <h2 class="section-title">
          <?= $title; ?>
        </h2>
        <span class="line"></span>
      <?php
      }
      ?>
    </div>

    <div class="questions-col">
      <div class="dom-accordion">
        <?php
        $count = 0;
        foreach ($questions as &$item) {
          $quest = get_from_array($item, 'question');
          $answer = get_from_array($item, 'answer');

          ?>
          <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <div class="accordion-head <?= $count === 0 ? 'active' : ''; ?>">
              <div class="quest-ico">
                <?= $svg->get_ico('question'); ?>
              </div>
              <h3 class="accordion-title" itemprop="name">
                <?= $quest; ?>
              </h3>
              <div class="accordion-ico">
                <span class="ico"></span>
              </div>
            </div>
            <div class="accordion-body <?= $count > 0 ? 'dom-slide-up' : ''; ?>" itemscope="" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
              <div class="content" itemprop="text">
                <?= $answer; ?>
              </div>
            </div>
          </div>
        <?php
          $count++;
        }
        ?>
      </div>
    </div>

  </div>
</section>