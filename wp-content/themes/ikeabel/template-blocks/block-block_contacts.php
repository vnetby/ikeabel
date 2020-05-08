<?php
global $about, $svg;


$emails = get_from_array($about, 'emails');
$phones = get_from_array($about, 'phones');
$messenger = get_from_array($about, 'messenger');
$socials = get_from_array($about, 'socials');

?>

<section class="section section-contacts" data-admin>
  <div class="container">
    <div class="contacts-wrap">
      <?php
      if ($emails) {
      ?>
        <div class="contact-col">
          <h3 class="contact-title">E-mail:</h3>
          <div class="contact-block">
            <?php
            foreach ($emails as &$email) {
              $label = get_from_array($email, 'email');
              $link = get_from_array($email, 'link');
            ?>
              <div class="contact-row">
                <div class="contact-item">
                  <a href="<?= $link; ?>" target="_blank"><?= $label; ?></a>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      <?php
      }

      if ($phones) {
      ?>
        <div class="contact-col">
          <h3 class="contact-title">Телефоны:</h3>
          <div class="contact-block">
            <?php
            foreach ($phones as &$phone) {
              $label = get_from_array($phone, 'phone');
              $link = get_from_array($phone, 'link');
              $title = get_from_array($phone, 'title');
            ?>
              <div class="contact-row">
                <div class="contact-item">
                  <a href="<?= $link; ?>" target="_blank" title="<?= $title; ?>"><?= $label; ?></a>
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      <?php
      }


      if ($messenger) {
      ?>
        <div class="contact-col">
          <h3 class="contact-title">Мессенджеры:</h3>
          <div class="contact-block">
            <div class="contact-row">
              <?php
              foreach ($messenger as &$messlist) {
                foreach ($messlist as $key => &$mess) {
              ?>
                  <div class="contact-item">
                    <a href="<?= $mess; ?>" class="ico contact-ico <?= $key; ?>">
                      <?= $svg->get_ico($key); ?>
                    </a>
                  </div>
              <?php
                }
              }
              ?>
            </div>
          </div>
        </div>
      <?php
      }


      if ($socials) {
      ?>
        <div class="contact-col">
          <h3 class="contact-title">Соц. сети:</h3>
          <div class="contact-block">
            <div class="contact-row">
              <?php
              foreach ($socials as $key => &$soc) {
              ?>
                <div class="contact-item">
                  <a href="<?= $soc; ?>" class="ico contact-ico <?= $key; ?>">
                    <?= $svg->get_ico($key); ?>
                  </a>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
</section>