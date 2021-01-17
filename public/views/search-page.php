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
        <?php
          if (!isset($_SESSION['userid'])) {
            echo '<a href="./login" class="sign-button">sign in</a>';
            echo '<a href="./register" class="sign-button">sign up</a>';
          } else {
            echo '<img src="public/assets/img/person-profile.jpeg" class="profile-photo">';
            echo '<form action="logout" method="post"><button type="submit" class="profile-logout">logout</button></form>';
          }
        ?>
      </div>
      <h1 class="logo-text">Virtual Salon</h1>
    </div>
    <div class="search-container">
      <form>
        <input class="search-input" type="text" placeholder="city">
        <input class="search-input" type="text" placeholder="street addres">
        <button class="search-button">search</button>
      </form>
    </div>
  </div>
</body>
</html>