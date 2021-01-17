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
      <form class="form-width-max">
        <div class="panel">
          <h1 class="sheet-header">ordering a visit</h1>
          <div class="profile-beam">
            <img src="public/assets/img/person-profile.jpeg" class="profile-img">
            <div class="profile-info">
              <h1 class="profile-name">Elliot Bernard Patel</h1>
              <p class="profile-profession">barber</p>
            </div>
          </div>
          <ul class="sheet-info-ul">
            <li class="sheet-info-li">
              <img src="public/assets/svg/calendar/calendar-grey.svg" class="sheet-info-img">
              <p class="sheet-info">12 Nov 2021, 20:00</p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/phone/telephone-grey.svg" class="sheet-info-img">
              <p class="sheet-info">865 305 731</p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/envelop/email-grey.svg" class="sheet-info-img">
              <p class="sheet-info">email@email.com</p>
            </li>
            <li class="sheet-info-li">
              <img src="public/assets/svg/card/credit-card-grey.svg" class="sheet-info-img">
              <p class="sheet-info">cash</p>
            </li>
          </ul>
        </div>
        <div class="panel">
          <form>
          <div class="sheet-section">
            <h2 class="sheet-section-header">Who are you making an appointment for?</h2>
            <div class="sheet-type">
              <div class="sheet-radio">
                <input class="radio-input" type="radio" name="type-visit" id="self-visit">
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
              <li class="sheet-treatment-li">
                <input class="checkbox-input" type="checkbox" name="treatment" id="treatment-1">
                <label class="treatment-checkbox" for="treatment-1"></label>
                <p class="treatment-p">treatment</p>
                <p class="treatment-p treatment-value">value</p>
              </li>
              <li class="sheet-treatment-li">
                <input class="checkbox-input" type="checkbox" name="treatment" id="treatment-2">
                <label class="treatment-checkbox" for="treatment-2"></label>
                <p class="treatment-p">treatment</p>
                <p class="treatment-p treatment-value">value</p>
              </li>
              <li class="sheet-treatment-li">
                <input class="checkbox-input" type="checkbox" name="treatment" id="treatment-3">
                <label class="treatment-checkbox" for="treatment-3"></label>
                <p class="treatment-p">treatment</p>
                <p class="treatment-p treatment-value">value</p>
              </li>
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
              <input class="sheet-text-input" placeholder="name" type="text">
              <input class="sheet-text-input" placeholder="surname" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">address</h2>
            <div class="sheet-address">
              <input class="sheet-text-input" placeholder="city" type="text">
              <input class="sheet-text-input" placeholder="street and house number/apartment number" type="text">
            </div>
          </div>
          <div class="sheet-section">
            <h2 class="sheet-section-header">contact details</h2>
            <div class="sheet-contact">
              <input class="sheet-text-input" placeholder="phone number" type="text">
              <input class="sheet-text-input" placeholder="email@email.com" type="text">
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