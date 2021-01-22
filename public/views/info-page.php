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
    <div class="nb-container">
      <h1 class="nb-logo">
        <a class="nb-logo-a" href="./search">Virtual Salon</a>
      </h1>
      <div class="nb-right-section">
        <a class="nb-tab" href="./orders">orders.</a>
        <a class="nb-tab" href="./reservations">reservations.</a>
        <a class="nb-tab" id="nb-current-tab" href="./info">my info.</a>
        <div class="nb-profile">
          <form action="" method="get">
            <img src="public/assets/img/person-profile.jpeg" class="nb-profile-img"></img>
            <button class="nb-button">logout</button>
          </form>
        </div>
        <div class="nb-sign nb-none">
          <a  href="./login" class="nb-sign-button nb-sign-in">sign in</a>
          <a href="./register" class="nb-sign-button nb-sign-up">sign up</a>
        </div>
      </div>
    </div>
    <div class="center-panels">
      <div class="panel panel-pink">
        <div class="profile-photo-container">
          <img src="public/assets/img/person-profile.jpeg" class="profile-picture">
          <form>
            <button class="profile-button edit-profile">edit profile</button>
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
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Tuesday</p>
            <ul class="day-schedule">
              <li>13:45</li>
              <li>13:45</li>
              <li>13:45</li>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Wednesday</p>
            <ul class="day-schedule">
              <li>13:45</li>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Thursday</p>
            <ul class="day-schedule">
              <li>13:45</li>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Friday</p>
            <ul class="day-schedule">
              <li>13:45</li>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Saturday</p>
            <ul class="day-schedule">
              <li>13:45</li>
            </ul>
          </div>
          <div class="day-container">
            <p class="day-label">Sunday</p>
            <ul class="day-schedule">
              <li>13:45</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel">
        <h1 class="decription-header">description</h1>
        <p class="description">Elliot Bernard Patel is a 25-year-old P.P.E. student who enjoys bargain hunting, watching sport and social media. She is giving and smart, but can also be very rude and a bit violent. She is addicted to video games, something which her friend Christine Monique Shaw pointed out when she was 17. The problem intensified in 2014. In 2018, Elliot Bernard lost her job as a town counsellor as a result of her addiction. She is French who defines herself as pansexual. She is currently at college. studying philosophy, politics and economics.</p>
      </div>
      <div class="panel">
        <h1 class="additional-info-header">additional information</h1>
        <div class="add-info-container">
          <img src="public/assets/svg/brush/brush-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">profession</h2>
            <ul class="informations">
              <li>text</li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/card/credit-card-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">payment methods</h2>
            <ul class="informations">
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/education/mortarboard-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">certificates</h2>
            <ul class="informations">
              <li>text</li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/web/world-wide-web-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">web</h2>
            <ul class="informations">
              <li>text</li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/quality/quality-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">years of experience</h2>
            <ul class="informations">
              <li>text</li>
            </ul>
          </div>
        </div>
        <div class="add-info-container">
          <img src="public/assets/svg/pin/safety-pin-grey.svg" class="add-info-img">
          <div class="add-info-area">
            <h2 class="add-info-subheader">the most favorite treatments</h2>
            <ul class="informations">
              <li>text</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="panel">
        <h1 class="price-header">PRICE LIST</h1>
        <ul class="price-list">
          <li class="price-li"><p class="name-price">price</p><p class="value-price">value</p></li>
          <li class="price-li"><p class="name-price">price</p><p class="value-price">value</p></li>
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
