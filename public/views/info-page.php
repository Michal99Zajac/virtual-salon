<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>info page</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/info-page/info-page.css">
</head>
<body>
  <div class="container">
    <?php include_once 'navbar.php' ?>
    <div class="center-panels">
      <div class="panel panel-pink">
        <div class="profile-photo-container">
          <?php
            $files = scandir(dirname(__DIR__).'/uploads');
            $profile = null;
            if (in_array("profile_{$_SESSION['id']}.jpeg", $files)) {
              $profile = "profile_{$_SESSION['id']}.jpeg";
            } else {
              $profile = "profile_0.jpeg";
            }
          ?>
          <img src="public/uploads/<?= $profile ?>" class="profile-picture">
          <form method="get" action="edit">
            <button type="submit" class="profile-button edit-profile">edit profile</button>
          </form>
        </div>
        <ul class="info-ul">
          <li class="info-li"><span class="name-data">name</span><span class="data"><?= $user->getName(); ?></span></li>
          <li class="info-li"><span class="name-data">surname</span><span class="data"><?= $user->getSurname() ;?></span></li>
          <li class="info-li"><span class="name-data">email</span><span class="data"><?= $user->getEmail(); ?></span></li>
          <li class="info-li"><span class="name-data">date of birth</span><span class="data"><?= $user->getDateBirth(); ?></span></li>
          <li class="info-li"><span class="name-data">country or region</span><span class="data"><?= $user->getCountry(); ?></span></li>
          <li class="info-li"><span class="name-data">phone number</span><span class="data"><?= $user->getPhone(); ?></span></li>
        </ul>
      </div>
      <div class="panel panel-pink">
        <div class="address-cotainer">
          <div class="address-area">
            <img src="public/assets/svg/home/home-grey.svg" class="info-img">
            <p class="address-info"><?= $user->getCity(); ?></p>
          </div>
          <div class="address-area">
            <img src="public/assets/svg/placeholder/placeholder-grey.svg" class="info-img">
            <p class="address-info"><?= $user->getAddress(); ?></p>
          </div>
        </div>
      </div>
      <?php if($user->getRole() == 'business') : ?>
      <div class="panel">
        <h1 class="schedule-header">SCHEDULE</h1>
        <div class="schedule-container">
          <div class="day-container">
            <p class="day-label">Monday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Monday'])): foreach ($schedules['Monday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Tuesday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Tuesday'])): foreach ($schedules['Tuesday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Wednesday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Wednesday'])): foreach ($schedules['Wednesday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Thursday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Thursday'])): foreach ($schedules['Thursday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Friday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Friday'])): foreach ($schedules['Friday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Saturday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Saturday'])): foreach ($schedules['Saturday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Sunday</p>
            <ul class="day-schedule">
              <?php if (isset($schedules['Sunday'])): foreach ($schedules['Sunday'] as $schedule): ?>
                <li><?= $schedule->getHour() ?></li>
              <?php endforeach; endif; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel">
        <h1 class="decription-header">description</h1>
        <p class="description"><?= $employee->getDescription() ?></p>
      </div>
      <div class="panel">
        <h1 class="additional-info-header">additional information</h1>
        <div class="add-info-container">
          <img src="public/assets/svg/brush/brush-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">profession</h2>
            <ul class="informations">
              <li><?= $employee->getProfession() ?></li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/card/credit-card-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">payment methods</h2>
            <ul class="informations">
              <?php foreach ($employee->getPayment() as $payment): ?>
              <li><?= $payment ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/education/mortarboard-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">certificates</h2>
            <ul class="informations">
              <li><?= $employee->getCertificate() ?></li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/web/world-wide-web-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">web</h2>
            <ul class="informations">
              <li><?= $employee->getWeb() ?></li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/quality/quality-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">years of experience</h2>
            <ul class="informations">
              <li><?= $employee->getLastJob() ?></li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/pin/safety-pin-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">the most favorite treatments</h2>
            <ul class="informations">
              <li><?= $employee->getFavTreatment() ?></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel">
        <h1 class="price-header">PRICE LIST</h1>
        <ul class="price-list">
          <?php foreach ($treatments as $treatment): ?>
          <li class="price-li"><p class="name-price"><?= $treatment->getName() ?></p><p class="value-price"><?= $treatment->getPrice() ?> $</p></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>
      <div class="panel">
        <button class="standard-button">delete account</button>
      </div>
    </div>
  </div>
</body>
</html>
