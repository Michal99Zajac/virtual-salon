<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>scheet</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/sheet-page/sheet-page.css">
  <script type="text/javascript" src="./public/js/script-sheet.js" defer></script>
</head>
<body>
  <div class="container">
    <?php include_once 'navbar.php' ?>
    <div class="center-panels">
      <form method="post" action="order" class="form-width-max">
        <div class="panel">
          <h1 class="sheet-header">ordering a visit</h1>
          <div class="profile-beam">
            <?php
              $files = scandir(dirname(__DIR__).'/uploads');
              $profile = null;
              if (in_array("profile_{$_GET['id']}.jpeg", $files)) {
                $profile = "profile_{$_GET['id']}.jpeg";
              } else {
                $profile = "profile_0.jpeg";
              }
            ?>
            <img src="public/uploads/<?= $profile ?>" class="profile-img">
            <div class="profile-info">
              <h1 class="profile-name"><?= $employee->getName() . ' ' . $employee->getSurname() ?></h1>
              <p class="profile-profession"><?= $employee->getProfession() ?></p>
            </div>
          </div>
          <ul class="sheet-info-ul">
            <li class="sheet-info-li">
              <img src="public/assets/svg/calendar/calendar-grey.svg" class="sheet-info-img">
              <p class="sheet-info"><?= $employee->getSchedules()->getDate() ?>, <?= $employee->getSchedules()->getHour() ?></p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="sheet-info-img">
              <p class="sheet-info"><?= $employee->getPhone() ?></p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="sheet-info-img">
              <p class="sheet-info"><?= $employee->getEmail() ?></p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/card/credit-card-grey.svg" class="sheet-info-img">
              <p class="sheet-info"><?php foreach ($employee->getPayment() as $payment): ?><?= $payment . ' ' ?><?php endforeach; ?></p>
            </li>
          </ul>
        </div>
        <div class="panel">
          <div class="sheet-section">
            <h2 class="sheet-section-header">Who are you making an appointment for?</h2>
            <div class="sheet-type">
              <div class="sheet-radio">
                <input checked class="radio-input" type="radio" name="type-visit" value="myself" id="self-visit">
                <label class="radio-sheet-label" for="self-visit">for myself</label>
              </div>
              <div class="sheet-radio">
                <input class="radio-input" type="radio" name="type-visit" value="someone" id="someone-visit">
                <label class="radio-sheet-label" for="someone-visit">for someone</label>
              </div>
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">treatments</h2>
            <ul class="sheet-treatment-ul">
              <?php foreach ($employee->getTreatments() as $treatment): ?>
              <li class="sheet-treatment-li">
                <input class="checkbox-input" type="checkbox" name="treatments[]" value="<?= $treatment->getName() ?>" id="<?= $treatment->getName() ?>">
                <label class="treatment-checkbox" for="<?= $treatment->getName() ?>"></label>
                <p class="treatment-p"><?= $treatment->getName() ?></p>
                <p class="treatment-p treatment-value"><?= $treatment->getPrice() ?> $</p>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div id="sheet-ordering-person" class="sheet-section">
            <h2 class="sheet-section-header">ordering party's personal data</h2>
            <div class="sheet-personal-data">
              <input class="sheet-text-input" name="ordering_name" placeholder="name" type="text">
              <input class="sheet-text-input" name="ordering_surname" placeholder="surname" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">personal data</h2>
            <div class="sheet-personal-data">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getName() ?>"<?php endif; ?> name="name" placeholder="name" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getSurname() ?>"<?php endif; ?> name="surname" placeholder="surname" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">address</h2>
            <div class="sheet-address">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getCity() ?>"<?php endif; ?> name="city" placeholder="city" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getAddress() ?>"<?php endif; ?> name="address" placeholder="street and house number/apartment number" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">contact details</h2>
            <div class="sheet-contact">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getPhone() ?>"<?php endif; ?> name="phone" placeholder="phone number" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getEmail() ?>"<?php endif; ?> name="email" placeholder="email@email.com" type="text">
            </div>
          </div>
        </div>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <input type="hidden" name="date" value="<?= $_GET['date'] ?>">
        <input type="hidden" name="hour" value="<?= $_GET['hour'] ?>">
        <div class="panel">
          <button type="submit" class="standard-button">order</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>