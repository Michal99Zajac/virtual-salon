<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>search</title>
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/search-page/search-page.css">
</head>
<body>
  <div class="container">
    <div class="top-area">
      <div class="profile-area">
        <?php if(!isset($_SESSION['id'])) : ?>
          <a href="./login" class="sign-button">sign in</a>
          <a href="./register" class="sign-button">sign up</a>
        <?php else : ?>
          <?php
            $files = scandir(dirname(__DIR__).'/uploads');
            $profile = null;
            if (in_array("profile_{$_SESSION['id']}.jpeg", $files)) {
              $profile = "profile_{$_SESSION['id']}.jpeg";
            } else {
              $profile = "profile_0.jpeg";
            }
          ?>
          <form method="GET" action="info">
            <button class="profile-button" type="submit"><img src="public/uploads/<?= $profile ?>" class="profile-photo"></button>
          </form>
          <form action="logout" method="post"><button type="submit" class="profile-logout">logout</button></form>
        <?php endif; ?>
      </div>
      <h1 class="logo-text">Virtual Salon</h1>
    </div>
    <div class="search-container">
      <form action="main" method="GET">
        <input class="search-input" name="city" type="text" placeholder="city">
        <input class="search-input" name="street" type="text" placeholder="street">
        <button type="submit" name="search" value="spec" class="search-button">search</button>
      </form>
    </div>
  </div>
</body>
</html>