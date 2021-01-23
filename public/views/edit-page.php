<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>edit page</title>
  <link rel="stylesheet" type="text/css" href="public/css/navbar/navbar.css">
  <link rel="stylesheet" type="text/css" href="public/css/standard-body/standard-body.css">
  <link rel="stylesheet" type="text/css" href="public/css/edit-page/edit-page.css">
</head>
<body>
  <div class="container">
    <div class="nb-container">
      <h1 class="nb-logo">
        <a class="nb-logo-a" href="./search">Virtual Salon</a>
      </h1>
      <div class="nb-right-section">
        <a class="nb-tab" href="./orders?id=<?= $_SESSION['id'] ?>">orders.</a>
        <a class="nb-tab" href="./reservations?id=<?= $_SESSION['id'] ?>">reservations.</a>
        <a class="nb-tab" href="./info?id=<?= $_SESSION['id'] ?>">my info.</a>
        <div class="nb-profile">
          <form action="logout" method="post">
            <img src="public/assets/img/person-profile.jpeg" class="nb-profile-img"></img>
            <button type="submit" class="nb-button">logout</button>
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
        <h1 class="panel-header">Change Photo</h1>
        <form>
          <input type="file" name="file" id="file-photo">
          <label class="file-label" for="file-photo">choose file</label>
          <button class="standard-button">upload</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Profile</h1>
        <form>
          <div>
            <span class="input-text-span">name</span>
            <input class="input-text" type="text" value="<?= $user->getName() ?>" placeholder="name">
          </div>
          <div>
            <span class="input-text-span">surname</span>
            <input class="input-text" type="text" value="<?= $user->getSurname() ?>" placeholder="surname">
          </div>
          <div>
            <span class="input-text-span">birth</span>
            <input class="input-text" value="<?= $user->getDateBirth() ?>" type="date">
          </div>
          <div>
            <span class="input-text-span">email</span>
            <input class="input-text" type="text" value="<?= $user->getEmail() ?>" placeholder="email@email.com">
          </div>
          <div>
            <span class="input-text-span">phone</span>
            <input class="input-text" type="text" value="<?= $user->getPhone() ?>" placeholder="phone number">
          </div>
          <div>
            <span class="input-text-span">country</span>
            <input class="input-text" type="text" value="<?= $user->getCountry() ?>" placeholder="country">
          </div>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Password</h1>
        <form>
          <div>
            <span class="input-text-span">old</span>
            <input class="input-text" type="password" placeholder="old password">
          </div>
          <div>
            <span class="input-text-span">new</span>
            <input class="input-text" type="password" placeholder="new password">
          </div>
          <div>
            <span class="input-text-span">repeat</span>
            <input class="input-text" type="password" placeholder="repeat password">
          </div>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Address</h1>
        <form>
          <div>
            <span class="input-text-span">city</span>
            <input class="input-text" type="text" value="<?= $user->getCity() ?>" placeholder="Warsaw">
          </div>
          <div>
            <span class="input-text-span">street/nr</span>
            <input class="input-text" type="text" value="<?= $user->getAddress() ?>" placeholder="Nowogrodzka 96">
          </div>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <?php if($user->getRole() == 'business') : ?>
      <div class="panel">
        <h1 class="panel-header">Edit Schedule</h1>
        <form>
          <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
          <input class="schedule-day-input" type="submit" name="day" value="Monday">
          <input class="schedule-day-input" type="submit" name="day" value="Tuesday">
          <input class="schedule-day-input" type="submit" name="day" value="Wednesday">
          <input class="schedule-day-input" type="submit" name="day" value="Thursday">
          <input class="schedule-day-input" type="submit" name="day" value="Friday">
          <input class="schedule-day-input" type="submit" name="day" value="Saturday">
          <input class="schedule-day-input" type="submit" name="day" value="Sunday">
        </form>
        <?php if (isset($schedules[$_GET['day']])): ; foreach ($schedules[$_GET['day']] as $schedule): ?>
        <form action="">
          <div class="schedule-time-container">
            <p class="schedule-time"><?= $schedule->getHour() ?></p>
            <div class="schedule-time-subcontainer">
              <p class="schedule-time-day"><?= $schedule->getDay() ?></p>
              <input type="hidden" name="hour" value="<?= $schedule->getHour() ?>">
              <input type="hidden" name="day" value="<?= $schedule->getDay() ?>">
              <button class="schedule-time-button" type="submit">delete</button>
            </div>
          </div>
        </form>
        <?php endforeach; endif; ?>
        <form class="form-margin-top form-row-reverse">
          <button class="add-button">add</button>
          <input placeholder="00:00" class="add-input-text" type="text" name="scheduleNewHour">
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Description</h1>
        <form>
          <textarea placeholder="description" maxlength="1024" name="description"><?= $employee->getDescription() ?></textarea>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Additional Informations</h1>
        <form>
          <h2 class="panel-subheader first-panel-subheader">proffesion</h2>
          <div>
            <span class="input-text-span">old profession</span>
            <p class="input-text"><?= $employee->getProfession() ?></p>
          </div>
          <div>
            <span class="input-text-span">new profession</span>
            <input class="input-text" type="text" placeholder="new profession">
          </div>
          <button class="standard-button">add</button>
        </form>
        <form>
          <h2 class="panel-subheader">payment methods</h2>
          <div>
            <input <?php if (in_array('cash', $employee->getPayment())): ?>checked<?php endif; ?> type="checkbox" name="payment-cash" value="cash" id="cash">
            <label class="checkbox-mock" for="cash"></label>
            <label class="checkbox-label" for="cash">cash</label>
          </div>
          <div>
            <input disabled <?php if (in_array('terminal', $employee->getPayment())): ?>checked<?php endif; ?> type="checkbox" value="terminal" name="payment-terminal" id="terminal">
            <label class="checkbox-mock" for="terminal"></label>
            <label class="checkbox-label" for="terminal">terminal</label>
          </div>
          <div>
            <input disabled <?php if (in_array('application', $employee->getPayment())): ?>checked<?php endif; ?> type="checkbox" value="application" name="payment-app" id="application">
            <label class="checkbox-mock" for="application"></label>
            <label class="checkbox-label" for="application">application</label>
          </div>
          <button class="standard-button">submit</button>
        </form>
        <form>
          <h2 class="panel-subheader">certificates</h2>
          <div>
            <span class="input-text-span">old certificate</span>
            <p class="input-text"><?= $employee->getCertificate() ?></p>
          </div>
          <div>
            <span class="input-text-span">new certificate</span>
            <input class="input-text" type="text" placeholder="new certificate">
          </div>
          <button class="standard-button">add</button>
        </form>
        <form>
          <h2 class="panel-subheader">web</h2>
          <div>
            <span class="input-text-span">old web</span>
            <p class="input-text"><?= $employee->getWeb() ?></p>
          </div>
          <div>
            <span class="input-text-span">new web</span>
            <input class="input-text" type="text" placeholder="new web">
          </div>
          <button class="standard-button">add</button>
        </form>
        <form>
          <h2 class="panel-subheader">years of experience</h2>
          <div>
            <span class="input-text-span">old job</span>
            <p class="input-text"><?= $employee->getLastJob() ?></p>
          </div>
          <div>
            <span class="input-text-span">new job</span>
            <input class="input-text" type="text" placeholder="new job">
          </div>
          <button class="standard-button">add</button>
        </form>
        <form>
          <h2 class="panel-subheader">the most favorite treatments</h2>
          <div>
            <span class="input-text-span">old the most favorite treatment</span>
            <p class="input-text"><?= $employee->getFavTreatment() ?></p>
          </div>
          <div>
            <span class="input-text-span">new the most favorite treatment</span>
            <input class="input-text" type="text" placeholder="new the most favorite treatment">
          </div>
          <button class="standard-button">add</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Price List</h1>
        <?php foreach ($treatments as $treatment): ?>
        <form class="form-align-center form-row-left">
          <button class="delete-button" type="submit">delete</button>
          <span class="list-span list-price"><?= $treatment->getPrice() ?> $</span>
          <span class="list-span"><?= $treatment->getName() ?></span>
        </form>
        <?php endforeach; ?>
        <form class="form-row-reverse form-align-center">
          <button class="add-button-product">add</button>
          <input placeholder="price" class="add-input-specjal add-price" type="text" name="priceValue">
          <input placeholder="product" class="add-input-specjal add-product" type="text" name="productValue">
        </form>
      </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>