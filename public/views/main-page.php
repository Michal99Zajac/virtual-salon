<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>main page</title>
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/main-page/main-page.css">
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
    <div class="mp-left-area">
      <div class="panel">
        <div class="mp-search-section">
          <form method="get" action="main">
            <input class="mp-search-text-input" name="person" placeholder="person" type="text">
            <button type="submit" name="search" value="person" class="mp-search-button">search</button>
          </form>
        </div>
      </div>
      <div class="panel">
        <form action="main" method="get">
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">location</h1>
            <input name="city" class="mp-search-text-input" placeholder="city" type="text">
            <input name="street" class="mp-search-text-input" placeholder="street" type="text">
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">profession</h1>
            <ul class="mp-search-ul">
              <?php foreach ($professions as $profession): ?>
              <li class="mp-search-li">
                <input type="checkbox" name="professions[]" value="<?= $profession->getName() ?>" id="<?= $profession->getName() ?>">
                <label class="mp-checkbox" for="<?= $profession->getName() ?>"></label>
                <label class="mp-checkbox-label" for="<?= $profession->getName() ?>"><?= $profession->getName() ?></label>
              </li>
              <?php endforeach; ?>
            </ul>
            <button style="display: none;" class="mp-show-button">show more</button>
          </div>
          <button type="submit" name="search" value="spec" class="mp-search-button">search</button>
        </form>
      </div>
    </div>
    <div class="center-panels">
      <?php foreach ($employees as $employee): ?>
      <div class="panel">
        <div class="mp-center-subarea">
          <div class="mp-profile-area">
            <div id="mp-photo" class="mp-profile-photo"></div>
            <div class="mp-profile-header">
              <h1 class="mp-profile-h1"><?= $employee->getName() . ' ' . $employee->getSurname() ?></h1>
              <p class="mp-profile-p"><?= $employee->getProfession() ?></p>
            </div>
          </div>
          <p class="mp-profile-description"><?= $employee->getDescription() ?></p>
          <ul class="mp-center-price-list">
            <?php foreach ($employee->getTreatments() as $treatment): ?>
            <li class="mp-center-price-li">
              <p class="mp-price-name"><?= $treatment->getName() ?></p>
              <p class="mp-price-value"><?= $treatment->getPrice() ?> $</p>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="mp-center-subarea">
          <?php foreach ($employee->getSchedules() as $schedule): ?>
          <ul class="mp-schedule-column">
            <h2 class="mp-schedule-header"><?= date('l', strtotime(array_search($schedule, $employee->getSchedules()))) ?></h2>
            <p class="mp-schedule-subheader"><?= array_search($schedule, $employee->getSchedules()) ?></p>
            <form method="get" action="sheet" class="form-width-max">
              <input type="hidden" value="<?= array_search($schedule, $employee->getSchedules()) ?>" name="date">
              <input type="hidden" name="id" value="<?= array_search($employee, $employees) ?>">
              <?php foreach ($schedule as $day): ?>
              <input <?= $day->getReserved() ? 'disabled' : '' ?> class="mp-schedule-li" type="submit" name="hour" value="<?= $day->getHour() ?>">
              <?php endforeach; ?>
            </form>
          </ul>
          <?php endforeach; ?>
        </div>
        <form action="profile" method="get">
          <button type="submit" name="id" value="<?= array_search($employee, $employees) ?>" class="mp-center-info">more info<div class="mp-info-img"></div></button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>