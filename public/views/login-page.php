<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/login-page/login-page.css">
  <title>login page</title>
</head>
<body>
  <div class="container">
    <div class="lo-container">
      <h1 class="lo-logo"><a href="./search">Virtual Salon</a></h1>
      <form action="login" method="POST" class="form-width-auto">
        <?php
        if (isset($msg)) {
          echo $msg;
        }
        ?>
        <div class="lo-input-text-area">
          <input class="lo-input-text" type="text" name="email" placeholder="email">
          <input class="lo-input-text" type="password" name="pwd" placeholder="password">
        </div>
        <button type="submit" class="lo-button">sign in</button>
        <a href="./register">Not a member yet? sign up!</a>
      </form>
    </div>
  </div>
</body>
