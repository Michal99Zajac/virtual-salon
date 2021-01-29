<div class="nb-container">
  <h1 class="nb-logo">
    <a class="nb-logo-a" href="./search">Virtual Salon</a>
  </h1>
  <a class="nb-logo-svg" href="./search"><img src="public/assets/svg/salon/beauty-salon-white.svg"></a>
  <div class="nb-right-section">
    <?php if (isset($_SESSION['id'])): ?>
    <?php if ($_SESSION['role'] == 'business'): ?>
    <a class="nb-tab" href="./orders">orders.</a>
    <?php endif; ?>
    <a class="nb-tab" href="./reservations">reservations.</a>
    <a class="nb-tab" href="./info">my info.</a>
    <div class="nb-profile">
      <?php
        $files = scandir(dirname(__DIR__).'/uploads');
        $profile = null;
        if (in_array("profile_{$_SESSION['id']}.jpeg", $files)) {
          $profile = "profile_{$_SESSION['id']}.jpeg";
        } else {
          $profile = "profile_0.jpeg";
        }
      ?>
      <form action="logout" method="post">
        <img src="public/uploads/<?= $profile ?>" class="nb-profile-img">
        <button type="submit" class="nb-button">logout</button>
      </form>
    </div>
    <?php else: ?>
    <div class="nb-sign">
      <a  href="./login" class="nb-sign-button nb-sign-in">sign in</a>
      <a href="./register" class="nb-sign-button nb-sign-up">sign up</a>
    </div>
    <?php endif; ?>
  </div>
</div>