<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="true">
  <title>reservations</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/reservations-page/reservations-page.css">
</head>
<body>
  <div class="container">
    <?php include_once 'navbar.php' ?>
    <div class="center-panels">
      <?php foreach ($orders as $order): ?>
      <?php [$employee, $client] = $order ?>
      <div class="panel">
        <div class="re-panel-left-area">
          <h1 class="re-header">Employee</h1>
          <div class="re-profile-header">
            <h1 class="re-profile-h1">fullname: <?= $employee->getName() . ' ' . $employee->getSurname() ?></h1>
          </div>
          <ul class="re-data-ul">
            <li class="re-data-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $employee->getPhone() ?></p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $employee->getEmail() ?></p>
            </li>
          </ul>
          <h1 class="re-header">Client</h1>
          <ul class="re-data-ul">
            <li class="re-data-li">
              <img src="public/assets/svg/calendar/calendar-grey.svg" class="re-data-img">
              <?php $schedule = $employee->getSchedules() ?>
              <p class="re-data-info"><?= $schedule->getDate() . ', ' . $schedule->getHour() ?></p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/placeholder/placeholder-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $client->getCity() . ', ' . $client->getAddress() ?></p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/user/user-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $client->getOrderingName() . ' ' . $client->getOrderingSurname() ?></p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $client->getPhone() ?></p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="re-data-img">
              <p class="re-data-info"><?= $client->getEmail() ?></p>
            </li>
          </ul>
        </div>
        <div class="re-panel-right-area">
          <h1 class="re-header">Treatments</h1>
          <?php $price = 0 ?>
          <ul class="re-price-ul">
            <?php foreach ($employee->getTreatments() as $treatment): ?>
            <li class="re-price-li">
              <p class="re-price-name"><?= $treatment->getName() ?></p>
              <p class="re-price-value"><?= $treatment->getPrice() ?> $</p>
            </li>
            <?php $price += $treatment->getPrice() ?>
            <?php endforeach; ?>
          </ul>
          <h1 class="re-price-sum">full: <?= $price ?> $</h1>
        </div>
        <form action="deleteReservation" method="post">
          <input type="hidden" value="<?= array_search($order, $orders) ?>" name="orderid">
          <button type="submit" value="<?= $client->getId() ?>" name="clientid" class="re-panel-cancel">cancel</button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>