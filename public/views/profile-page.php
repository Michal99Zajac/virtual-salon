<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>profile page</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/profile-page/profile-page.css">
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
      <div class="panel">
        <div class="profile-beam">
          <img src="public/assets/img/person-profile.jpeg" class="profile-img">
          <div class="profile-info">
            <h1 class="profile-name"><?= $employee->getName() . ' ' . $employee->getSurname() ?></h1>
            <p class="profile-profession"><?= $employee->getProfession() ?></p>
          </div>
        </div>
        <p class="profile-description"><?= $employee->getDescription() ?></p>
      </div>
      <div class="panel">
        <div class="schedule-beam">
          <form action="profile" method="get">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <button type="submit" name="add" value="-5" class="schedule-arrow"><div class="arrow" id="schedule-arrow-left"></div></button>
            <h1 class="schedule-header">SCHEDULE</h1>
            <button type="submit" name="add" value="+5" class="schedule-arrow"><div class="arrow" id="schedule-arrow-right"></div></button>
          </form>
        </div>
        <div class="schedule-container">
          <?php foreach (array_keys($employee->getSchedules()) as $date): ?>
          <ul class="schedule-ul">
            <div class="schedule-ul-header">
              <p class="day"><?= date('l', strtotime($date)) ?></p>
              <p class="data"><?= $date ?></p>
            </div>
            <form method="get" action="sheet">
              <input type="hidden" value="<?= $_GET['id'] ?>" name="id">
              <input type="hidden" value="<?= $date ?>" name="date">
              <?php foreach ($employee->getSchedules()[$date] as $day): ?>
                <input <?= $day->getReserved() ? 'disabled' : '' ?> class="schedule-li" type="submit" name="hour" value="<?= $day->getHour() ?>">
              <?php endforeach; ?>
            </form>
          </ul>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="panel">
        <h1 class="contact-beam">Contact</h1>
        <ul class="contact-ul">
          <li class="contact-li">
            <p class="contact-type">phone number</p>
            <p class="contact-value"><?= $employee->getPhone() ?></p>
          </li>
          <li class="contact-li">
            <p class="contact-type">email</p>
            <p class="contact-value"><?= $employee->getEmail() ?></p>
          </li>
        </ul>
      </div>
      <div class="panel">
        <h1 class="price-beam">Price List</h1>
        <ul class="price-ul">
          <?php foreach ($employee->getTreatments() as $treatment): ?>
          <li class="price-li">
            <p class="price-name"><?= $treatment->getName() ?></p>
            <p class="price-value"><?= $treatment->getPrice() ?> $</p>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="panel">
        <h1 class="add-info-beam">Additional Informations</h1>
        <ul class="add-info-ul">
          <?php if($employee->getProfession()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/brush/brush-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">profession</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li"><?= $employee->getProfession() ?></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>
          <?php if($employee->getPayment()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/card/credit-card-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">payment methods</h1>
              <ul class="add-info-sub-ul">
                <?php foreach ($employee->getPayment() as $payment): ?>
                <li class="add-info-sub-li"><?= $payment ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          </li>
          <?php endif; ?>
          <?php if($employee->getCertificate()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/education/mortarboard-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">certificates</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li"><?= $employee->getCertificate() ?></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>
          <?php if($employee->getWeb()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/web/world-wide-web-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">web</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li"><?= $employee->getWeb() ?></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>
          <?php if($employee->getLastJob()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/quality/quality-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">years of experience</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li"><?= $employee->getLastJob() ?></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>
          <?php if($employee->getFavTreatment()): ?>
          <li class="add-info-li">
            <img src="public/assets/svg/pin/safety-pin-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">the most favorite treatments</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li"><?= $employee->getFavTreatment() ?></li>
              </ul>
            </div>
          </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>