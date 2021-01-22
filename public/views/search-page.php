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
          <form method="GET" action="info">
            <button value="<?= $_SESSION['id'] ?>" name="id" type="submit"><img src="public/assets/img/person-profile.jpeg" class="profile-photo"></button>
          </form>
          <form action="logout" method="post"><button type="submit" class="profile-logout">logout</button></form>
        <?php endif; ?>
      </div>
      <h1 class="logo-text">Virtual Salon</h1>
    </div>
    <div class="search-container">
      <form action="main" method="GET">
        <input class="search-input" name="city" type="text" placeholder="city">
        <input class="search-input" name="address" type="text" placeholder="street address">
        <button type="submit" class="search-button">search</button>
      </form>
    </div>
  </div>
</body>
</html>