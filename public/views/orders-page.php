<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orders</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/orders-page/orders-page.css">
</head>
<body>
  <div class="container">
    <?php include_once 'navbar.php' ?>
    <div class="center-panels">
      <?php foreach ($orders as $order): ?>
      <?php [$employee, $client] = $order ?>
      <div class="panel">
        <div class="or-panel-left-area">
          <h1 class="or-header">client data</h1>
          <ul class="or-data-ul">
            <li class="or-data-li">
              <img src="public/assets/svg/calendar/calendar-grey.svg" class="or-data-img">
              <?php $schedule = $employee->getSchedules() ?>
              <p class="or-data-info"><?= $schedule->getDate() . ', ' . $schedule->getHour() ?></p>
            </li>
            <li class="or-data-li">
              <img src="public/assets/svg/placeholder/placeholder-grey.svg" class="or-data-img">
              <p class="or-data-info"><?= $client->getCity() . ', ' . $client->getAddress() ?></p>
            </li>
            <li class="or-data-li">
              <img src="public/assets/svg/user/user-grey.svg" class="or-data-img">
              <p class="or-data-info"><?= $client->getOrderingName() . ' ' . $client->getOrderingSurname() ?></p>
            </li>
            <li class="or-data-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="or-data-img">
              <p class="or-data-info"><?= $client->getPhone() ?></p>
            </li>
            <li class="or-data-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="or-data-img">
              <p class="or-data-info"><?= $client->getEmail() ?></p>
            </li>
          </ul>
        </div>
        <div class="or-panel-right-area">
          <h1 class="or-header">orders</h1>
          <?php $price = 0 ?>
          <ul class="or-price-ul">
            <?php foreach ($employee->getTreatments() as $treatment): ?>
            <li class="or-price-li">
              <p class="or-price-name">name</p>
              <p class="or-price-value">10 $</p>
            </li>
            <?php $price += $treatment->getPrice() ?>
            <?php endforeach; ?>
          </ul>
          <h1 class="or-price-sum">full: <?= $price ?>  $</h1>
        </div>
        <form action="deleteOrder" method="post">
          <input type="hidden" value="<?= array_search($order, $orders) ?>" name="orderid">
          <button type="submit" value="<?= $client->getId() ?>" name="clientid" class="or-panel-done">done!</button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>