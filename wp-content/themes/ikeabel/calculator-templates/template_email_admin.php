<?php
$name       = $data['name'];
$email      = $data['email'];
$phone      = $data['phone'];
$address    = $data['address'];

$totalPrice = $data['totalPrice'];
$totalShip  = $data['totalShip'];
$shipCost   = $data['shipCost'];

$order      = &$data['order'];

?>


<div style="color: #727272; padding: 30px;">
  <h3 style="margin-bottom: 15px; font-size: 18px; font-weight: bold;">Заказ с сайта <?= $_SERVER['HTTP_HOST']; ?></h3>
  <table style="font-size: 14px">
    <tr>
      <td style="width: 120px; padding: 10px; border-bottom: 1px solid #727272;">Имя:</td>
      <td style="color: #000; padding: 10px; border-bottom: 1px solid #727272; "><?= $name; ?></td>
    </tr>
    <tr>
      <td style="width: 120px; padding: 10px; border-bottom: 1px solid #727272;">E-mail:</td>
      <td style="color: #000; padding: 10px; border-bottom: 1px solid #727272; "><?= $email; ?></td>
    </tr>
    <tr>
      <td style="width: 120px; padding: 10px; border-bottom: 1px solid #727272;">Телефон:</td>
      <td style="color: #000; padding: 10px; border-bottom: 1px solid #727272; "><a href="tel://<?= $phone; ?>" target="_blank"><?= $phone; ?></a></td>
    </tr>
    <tr>
      <td style="width: 120px; padding: 10px; ">Адрес:</td>
      <td style="color: #000; padding: 10px; "><?= $address; ?></td>
    </tr>
  </table>
  <hr>
  <?php
    require ( dirname ( __FILE__ ) . '/template_order_review.php' );
   ?>
</div>
