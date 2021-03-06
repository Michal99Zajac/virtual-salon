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
    <?php include_once 'navbar.php' ?>
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
    <?php $files = scandir(dirname(__DIR__).'/uploads'); ?>
    <div class="center-panels">
      <?php foreach ($employees as $employee): ?>
      <?php
        $id = array_search($employee, $employees);
        $profile = null;
        if (in_array("profile_{$id}.jpeg", $files)) {
          $profile = "profile_{$id}.jpeg";
        } else {
          $profile = "profile_0.jpeg";
        }
      ?>
      <div class="panel">
        <div class="mp-center-subarea">
          <div class="mp-profile-area">
            <img src="public/uploads/<?= $profile ?>" class="mp-profile-photo">
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
          <?php foreach (array_keys($employee->getSchedules()) as $date): ?>
          <ul class="mp-schedule-column">
            <h2 class="mp-schedule-header"><?= date('l', strtotime($date)) ?></h2>
            <p class="mp-schedule-subheader"><?= $date ?></p>
            <?php foreach ($employee->getSchedules()[$date] as $day): ?>
            <form method="get" action="sheet" class="form-width-max">
              <input type="hidden" value="<?= $date ?>" name="date">
              <input type="hidden" name="id" value="<?= array_search($employee, $employees) ?>">
              <input <?= $day->getReserved() ? 'disabled' : '' ?> class="mp-schedule-li" type="submit" name="hour" value="<?= $day->getHour() ?>">
            </form>
            <?php endforeach; ?>
          </ul>
          <?php endforeach; ?>
        </div>
        <form action="profile" method="get">
          <button type="submit" name="id" value="<?= $id ?>" class="mp-center-info">more info<div class="mp-info-img"></div></button>
        </form>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>