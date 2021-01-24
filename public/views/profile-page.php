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
      <?php print_r($employee->getSchedules())  ?>
      <div class="panel">
        <div class="schedule-beam">
          <form action="profile" method="get">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <button type="submit" name="add" value="-5" class="schedule-arrow"><div class="arrow" id="schedule-arrow-left"></div></button>
            <h1 class="schedule-header">SCHEDULE</h1>
            <button type="submit" name="add" value="+5"<?= date('Y-m-d', strtotime($employee->getSchedules()[4].'+1 day')) ?>" class="schedule-arrow"><div class="arrow" id="schedule-arrow-right"></div></button>
          </form>
        </div>
        <?php print_r(date('Y-m-d', strtotime($employee->getSchedules()[4].'+0 day'))) ?>
        <div class="schedule-container">
          <form>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input type="submit" name="hour" class="schedule-li" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
            </ul>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
            </ul>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
            </ul>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
            </ul>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
              <input class="schedule-li" type="button" value="13:30">
            </ul>
            <ul class="schedule-ul">
              <div class="schedule-ul-header">
                <p class="day">Monday</p>
                <p class="data">12 Nov</p>
              </div>
              <input class="schedule-li schedule-li-booked" type="button" value="13:30">
            </ul>
          </form>
        </div>
      </div>
      <div class="panel">
        <h1 class="contact-beam">Contact</h1>
        <ul class="contact-ul">
          <li class="contact-li">
            <p class="contact-type">phone number</p>
            <p class="contact-value">543 985 000</p>
          </li>
          <li class="contact-li">
            <p class="contact-type">email</p>
            <p class="contact-value">email@email.com</p>
          </li>
        </ul>
      </div>
      <div class="panel">
        <h1 class="price-beam">Price List</h1>
        <ul class="price-ul">
          <li class="price-li">
            <p class="price-name">price
            <p class="price-value">value $</p>
          </li>
          <li class="price-li">
            <p class="price-name">price</p>
            <p class="price-value">value $</p>
          </li>
          <li class="price-li">
            <p class="price-name">price</p>
            <p class="price-value">value $</p>
          </li>
          <li class="price-li">
            <p class="price-name">price</p>
            <p class="price-value">value $</p>
          </li>
          <li class="price-li">
            <p class="price-name">price</p>
            <p class="price-value">value $</p>
          </li>
        </ul>
      </div>
      <div class="panel">
        <h1 class="add-info-beam">Additional Informations</h1>
        <ul class="add-info-ul">
          <li class="add-info-li">
            <img src="public/assets/svg/brush/brush-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">profession</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li">text</li>
                <li class="add-info-sub-li">text</li>
                <li class="add-info-sub-li">text</li>
              </ul>
            </div>
          </li>
          <li class="add-info-li">
            <img src="public/assets/svg/card/credit-card-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">payment methods</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li">text</li>
              </ul>
            </div>
          </li>
          <li class="add-info-li">
            <img src="public/assets/svg/education/mortarboard-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">certificates</h1>
              <ul class="add-info-sub-ul">
                <li class="add-info-sub-li">text</li>
              </ul>
            </div>
          </li>
          <li class="add-info-li">
            <img src="public/assets/svg/web/world-wide-web-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">web</h1>
              <ul class="add-info-sub-ul">
              </ul>
            </div>
          </li>
          <li class="add-info-li">
            <img src="public/assets/svg/quality/quality-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">years of experience</h1>
              <ul class="add-info-sub-ul">
              </ul>
            </div>
          </li>
          <li class="add-info-li">
            <img src="public/assets/svg/pin/safety-pin-grey.svg" class="add-info-img">
            <div class="add-info-container">
              <h1 class="add-info-header">the most favorite treatments</h1>
              <ul class="add-info-sub-ul">
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>