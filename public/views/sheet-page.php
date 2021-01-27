<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>scheet</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/sheet-page/sheet-page.css">
</head>
<body>
  <div class="container">
    <div class="nb-container">
      <h1 class="nb-logo">
        <a class="nb-logo-a" href="./search">Virtual Salon</a>
      </h1>
      <div class="nb-right-section">
        <a class="nb-tab" href="./orders">orders.</a>
        <a class="nb-tab" href="./reservations">reservations.</a>
        <a class="nb-tab" href="./info">my info.</a>
        <div class="nb-profile">
          <form action="logout" method="post">
            <img src="public/assets/img/person-profile.jpeg" class="nb-profile-img"></img>
            <button type="submit" class="nb-button">logout</button>
          </form>
        </div>
        <div class="nb-sign nb-none">
          <a  href="./login" class="nb-sign-button nb-sign-in">sign in</a>
          <a href="./register" class="nb-sign-button nb-sign-up">sign up</a>
        </div>
      </div>
    </div>
    <div class="center-panels">
      <form class="form-width-max">
        <div class="panel">
          <h1 class="sheet-header">ordering a visit</h1>
          <div class="profile-beam">
            <img src="public/assets/img/person-profile.jpeg" class="profile-img">
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
          <form>
          <div class="sheet-section">
            <h2 class="sheet-section-header">Who are you making an appointment for?</h2>
            <div class="sheet-type">
              <div class="sheet-radio">
                <input checked class="radio-input" type="radio" name="type-visit" id="self-visit">
                <label class="radio-sheet-label" for="self-visit">for myself</label>
              </div>
              <div class="sheet-radio">
                <input class="radio-input" type="radio" name="type-visit" id="someone-visit">
                <label class="radio-sheet-label" for="someone-visit">for someone</label>
              </div>
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">treatments</h2>
            <ul class="sheet-treatment-ul">
              <?php foreach ($employee->getTreatments() as $treatment): ?>
              <li class="sheet-treatment-li">
                <input class="checkbox-input" type="checkbox" name="treatment[]" id="<?= $treatment->getName() ?>">
                <label class="treatment-checkbox" for="<?= $treatment->getName() ?>"></label>
                <p class="treatment-p"><?= $treatment->getName() ?></p>
                <p class="treatment-p treatment-value"><?= $treatment->getPrice() ?> $</p>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">ordering party's personal data</h2>
            <div class="sheet-personal-data">
              <input class="sheet-text-input" placeholder="name" type="text">
              <input class="sheet-text-input" placeholder="surname" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">personal data</h2>
            <div class="sheet-personal-data">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getName() ?>"<?php endif; ?> placeholder="name" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getSurname() ?>"<?php endif; ?> placeholder="surname" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">address</h2>
            <div class="sheet-address">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getCity() ?>"<?php endif; ?> placeholder="city" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getAddress() ?>"<?php endif; ?> placeholder="street and house number/apartment number" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">contact details</h2>
            <div class="sheet-contact">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getPhone() ?>"<?php endif; ?> placeholder="phone number" type="text">
              <input class="sheet-text-input" <?php if(isset($user)):?>value="<?= $user->getEmail() ?>"<?php endif; ?> placeholder="email@email.com" type="text">
            </div>
          </div>
        </div>
        <div class="panel">
          <button class="standard-button">order</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>