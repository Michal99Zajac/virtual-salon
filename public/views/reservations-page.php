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
    <div class="nb-container">
      <h1 class="nb-logo">
        <a class="nb-logo-a" href="./search">Virtual Salon</a>
      </h1>
      <div class="nb-right-section">
        <a class="nb-tab" href="./orders">orders.</a>
        <a class="nb-tab" id="nb-current-tab" href="./reservations">reservations.</a>
        <a class="nb-tab" href="./info">my info.</a>
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
      <div class="panel">
        <div class="re-panel-left-area">
          <h1 class="re-header">employee data</h1>
          <div class="re-profile-header">
            <img src="public/assets/img/person-profile.jpeg" class="re-profile-img">
            <h1 class="re-profile-h1">Mary Adams</h1>
          </div>
          <ul class="re-data-ul">
            <li class="re-data-li">
              <img src="public/assets/svg/calendar/calendar-grey.svg" class="re-data-img">
              <p class="re-data-info">12 Nov 2021, 20:00</p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/placeholder/placeholder-grey.svg" class="re-data-img">
              <p class="re-data-info">Warsaw, Nowogordzka 96/12</p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/user/user-grey.svg" class="re-data-img">
              <p class="re-data-info">Mary Adams</p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="re-data-img">
              <p class="re-data-info">764 985 123</p>
            </li>
            <li class="re-data-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="re-data-img">
              <p class="re-data-info">email@email.com</p>
            </li>
          </ul>
        </div>
        <div class="re-panel-right-area">
          <h1 class="re-header">orders</h1>
          <ul class="re-price-ul">
            <li class="re-price-li">
              <p class="re-price-name">name</p>
              <p class="re-price-value">10 $</p>
            </li>
            <li class="re-price-li">
              <p class="re-price-name">name</p>
              <p class="re-price-value">10 $</p>
            </li>
            <li class="re-price-li">
              <p class="re-price-name">name</p>
              <p class="re-price-value">10 $</p>
            </li>
          </ul>
          <h1 class="re-price-sum">full: 10 $</h1>
        </div>
        <form>
          <button class="re-panel-cancel">cancel</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>