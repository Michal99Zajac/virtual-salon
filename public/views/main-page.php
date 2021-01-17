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
    <div class="mp-left-area">
      <div class="panel">
        <div class="mp-search-section">
          <form>
            <input class="mp-search-text-input" placeholder="person" type="text">
            <button class="mp-search-button">search</button>
          </form>
        </div>
      </div>
      <div class="panel">
        <form>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">location</h1>
            <input class="mp-search-text-input" placeholder="city" type="text">
            <input class="mp-search-text-input" placeholder="street" type="text">
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">profession</h1>
            <ul class="mp-search-ul">
              <li class="mp-search-li">
                <input type="checkbox" name="profession" id="profession-1">
                <label class="mp-checkbox" for="profession-1"></label>
                <label class="mp-checkbox-label" for="profession-1">barber</label>
              </li>
              <li class="mp-search-li">
                <input type="checkbox" name="profession" id="profession-2">
                <label class="mp-checkbox" for="profession-2"></label>
                <label class="mp-checkbox-label" for="profession-2">aaaaaaaaaaaaaaaaaaaaa</label>
              </li>
            </ul>
            <button class="mp-show-button">show more</button>
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">services</h1>
            <ul class="mp-search-ul">
              <li class="mp-search-li">
                <input type="checkbox" name="service" id="service-1">
                <label class="mp-checkbox" for="service-1"></label>
                <label class="mp-checkbox-label" for="service-1">barber</label>
              </li>
              <li class="mp-search-li">
                <input type="checkbox" name="service" id="service-2">
                <label class="mp-checkbox" for="service-2"></label>
                <label class="mp-checkbox-label" for="service-2">aaaaaaaaaaaaaaaaaaaaa</label>
              </li>
            </ul>
            <button class="mp-show-button">show more</button>
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">min price</h1>
            <input class="mp-search-text-input mp-price-text-input" placeholder="0.0 $" type="text">
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">max price</h1>
            <input class="mp-search-text-input mp-price-text-input" placeholder="100.0 $" type="text">
          </div>
          <div class="mp-search-section">
            <h1 class="mp-search-section-header">payment method</h1>
            <ul class="mp-search-ul">
              <li class="mp-search-li">
                <input type="checkbox" name="payment" id="payment-1">
                <label class="mp-checkbox" for="payment-1"></label>
                <label class="mp-checkbox-label" for="payment-1">cash</label>
              </li>
              <li class="mp-search-li">
                <input disabled type="checkbox" name="payment" id="payment-2">
                <label class="mp-checkbox" for="payment-2"></label>
                <label class="mp-checkbox-label" for="payment-2">terminal</label>
              </li>
              <li class="mp-search-li">
                <input disabled type="checkbox" name="payment" id="payment-3">
                <label class="mp-checkbox" for="payment-3"></label>
                <label class="mp-checkbox-label" for="payment-3">by application</label>
              </li>
            </ul>
          </div>
          <button class="mp-search-button">search</button>
        </form>
      </div>
    </div>
    <div class="center-panels">
      <div class="panel">
        <div class="mp-center-subarea">
          <div class="mp-profile-area">
            <div id="mp-photo" class="mp-profile-photo"></div>
            <div class="mp-profile-header">
              <h1 class="mp-profile-h1">Mary Adams</h1>
              <p class="mp-profile-p">hairdresser</p>
            </div>
          </div>
          <p class="mp-profile-description">Mary Adams is a 28-year-old former local activist who enjoys charity work, running and playing card games. She is friendly and entertaining, but can also be very standoffish and a bit lazy. She is Italian. She has a post-graduate degree in philosophy, politics and economics. She is obsessed with cats.</p>
          <ul class="mp-center-price-list">
            <li class="mp-center-price-li">
              <p class="mp-price-name">buns and pin-ups</p>
              <p class="mp-price-value"> 12.50 $</p>
            </li>
            <li class="mp-center-price-li">
              <p class="mp-price-name">buns and pin-ups</p>
              <p class="mp-price-value"> 12.50 $</p>
            </li>
            <li class="mp-center-price-li">
              <p class="mp-price-name">buns and pin-ups</p>
              <p class="mp-price-value"> 12.50 $</p>
            </li>
            <li class="mp-center-price-li">
              <p class="mp-price-name">buns and pin-ups</p>
              <p class="mp-price-value"> 12.50 $</p>
            </li>
            <li class="mp-center-price-li">
              <p class="mp-price-name">buns and pin-ups</p>
              <p class="mp-price-value"> 12.50 $</p>
            </li>
          </ul>
        </div>
        <div class="mp-center-subarea">
          <ul class="mp-schedule-column">
            <h2 class="mp-schedule-header">today</h2>
            <p class="mp-schedule-subheader">aa</p>
            <form class="form-width-max">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
            </form>
          </ul>
          <ul class="mp-schedule-column">
            <h2 class="mp-schedule-header">tommorow</h2>
            <p class="mp-schedule-subheader">aa</p>
            <form class="form-width-max">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
            </form>
          </ul>
          <ul class="mp-schedule-column">
            <h2 class="mp-schedule-header">aaa</h2>
            <p class="mp-schedule-subheader">aa</p>
            <form class="form-width-max">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li mp-reserved-li" type="button" value="13:30">
              <input class="mp-schedule-li" type="button" value="13:30">
            </form>
          </ul>
        </div>
        <form>
          <a class="mp-center-info" href="#">more info<div class="mp-info-img"></div></a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>