<?php

?>

<div class="order-review">

  <h3 style="margin-bottom: 15px; font-size: 18px; font-weight: bold;">Детали заказа:</h3>
  <table style="width: 100%; margin-bottom: 20px;">
    <thead style="background-color: rgba(0, 0, 0, 0.1)">
      <tr>
        <th style="width: 20px; padding: 15px;">#</th>
        <th width="120px" style="width: 120px; padding: 15px;">Изображение</th>
        <th style="padding: 15px;">Название</th>
        <th width="45px" style="width: 70px; text-align: center; padding: 15px;">№</th>
        <th width="45px" style="width: 45px; text-align: center; padding: 15px;">Стоимость</th>
        <th width="45px" style="width: 45px; text-align: center; padding: 15px;">Количество</th>
        <th width="45px" style="width: 45px; text-align: center; padding: 15px;">Итог</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $count = 1;
      foreach ( $order as &$item ) {
        $name     = get_from_array( $item, 'name' );
        $img      = get_from_array( $item, 'image' );
        $cost     = get_from_array( $item, 'cost' );
        $quantity = get_from_array( $item, 'quantity' );
        $total    = get_from_array( $item, 'total' );
        $link     = get_from_array( $item, 'link' );
        $prodId   = get_from_array( $item, 'prodId' );
        ?>
        <tr style="background-color: rgba(0, 0, 0, 0.1)">
          <td style="padding: 15px;"><?= $count; ?></td>
          <td style="padding: 15px;">
            <?php
            if ( $img ) {
              ?>
              <img src="<?= $img; ?>" alt="image" width="100%">
              <?php
            }
            ?>
          </td>
          <td style="padding: 15px;">
            <?php
            if ( $name && $link ) {
              ?>
              <a href="<?= $link; ?>" target="_blank" style="color: #000;"><?= $name; ?></a>
              <?php
            }
            ?>
          </td>
          <td style="padding: 15px; text-align: center;"><?= $prodId ? $prodId : ''; ?></td>
          <td style="padding: 15px; text-align: center;"><?= $cost ? $cost . ' ' . $sets['final_currency'] : ''; ?></td>
          <td style="padding: 15px; text-align: center;"><?= $quantity ? $quantity : ''; ?></td>
          <td style="padding: 15px; text-align: center;"><?= $total ? $total . ' ' . $sets['final_currency'] : ''; ?></td>
        </tr>
        <?php
        $count++;
      }
      ?>
    </tbody>
  </table>

  <table width="100%" style="font-size: 16px;">
    <tr>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1)">Итог:</td>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1); font-weight: bold;"><?= $totalPrice . ' ' . $sets['final_currency']; ?></td>
    </tr>
    <tr>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1)">Итог с доставкой:</td>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1); font-weight: bold;"><?= $totalShip . ' ' . $sets['final_currency']; ?></td>
    </tr>
    <tr>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1)">Стоимость доставки:</td>
      <td style="padding: 15px; border: 1px solid rgba(0, 0, 0, 0.1); font-weight: bold;"><?= $shipCost . ' ' . $sets['final_currency']; ?></td>
    </tr>
  </table>

</div>
<?php
