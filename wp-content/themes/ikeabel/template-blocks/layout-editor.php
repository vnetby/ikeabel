<?php
$content = get_from_array($block, 'editor');

$title = get_from_array($block, 'title');
$template = get_from_array($block, 'template', ['justify']);
$template = is_array($template) ? $template[0] : $template;
?>


<section class="section section-editor" data-admin>
  <div class="container">
    <?php
    if ($content) {
    ?>
      <div class="editor-content <?= $template; ?>">
        <?php
        if ($title) {
        ?>
          <h2 class="section-title">
            <?= $title; ?>
          </h2>
        <?php
        }
        ?>
        <?= $content; ?>
      </div>
    <?php
    }
    ?>
  </div>
</section>