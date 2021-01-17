<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>account page</title>
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/account-page/account-page.css">
</head>
<body>
  <div class="container">
    <div class="panel">
      <h1 class="ac-logo">
        <a class="ac-a" href="./search">Virtual Salon</a>
      </h1>
      <form action="register" method="post" class="form-width-auto">
        <div class="ac-input-area">
          <div class="radio-container">
            <label class="radio-label" for="client">client</label>
            <input type="radio" name="role" value="client" id="client" checked>
            <label class="radio" for="client"><img src="public/assets/svg/chair/chair-white.svg"></label>
          </div>
          <div class="radio-container">
            <label class="radio-label" for="business">business</label>
            <input type="radio" name="role" value="business" id="business">
            <label class="radio" for="business"><img src="public/assets/svg/firm/signboard-white.svg"></label>
          </div>
          <input class="ac-input-text" name="email" placeholder="email" type="text">
          <input class="ac-input-text" name="name" placeholder="name" type="text">
          <input class="ac-input-text" name="surname" placeholder="surname" type="text">
          <input class="ac-input-text" name="pwd" placeholder="password" type="password">
          <input class="ac-input-text" name="pwdrepeat" placeholder="confirm password" type="password">
        </div>
        <button type="submit" class="standard-button">sign up</button>
      </form>
    </div>
    <div class="panel">
      <p class="ac-question">Have an account?</p>
      <a class="standard-button" href="./login">sign in</a>
    </div>
  </div>
</body>
