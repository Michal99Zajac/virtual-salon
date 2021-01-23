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
            <input class="input-text" type="text" placeholder="name">
          </div>
          <div>
            <span class="input-text-span">surname</span>
            <input class="input-text" type="text" placeholder="surname">
          </div>
          <div>
            <span class="input-text-span">birth</span>
            <input class="input-text" type="date">
          </div>
          <div>
            <span class="input-text-span">email</span>
            <input class="input-text" type="text" placeholder="email@email.com">
          </div>
          <div>
            <span class="input-text-span">phone</span>
            <input class="input-text" type="text" placeholder="phone number">
          </div>
          <div>
            <span class="input-text-span">country</span>
            <input class="input-text" type="text" placeholder="country">
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
            <input class="input-text" type="text" placeholder="Warsaw">
          </div>
          <div>
            <span class="input-text-span">street/nr</span>
            <input class="input-text" type="text" placeholder="Nowogrodzka 96">
          </div>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Schedule</h1>
        <form>
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Monday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Tuesday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Wednesday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Thursday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Friday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Saturday">
          <input class="schedule-day-input" type="submit" name="scheduleDay" value="Sunday">
        </form>
        <form>
          <div class="schedule-time-container">
            <p class="schedule-time">13:00</p>
            <div class="schedule-time-subcontainer">
              <p class="schedule-time-day">Monday</p>
              <input type="hidden" name="hour" value="13:30">
              <button class="schedule-time-button" type="submit">delete</button>
            </div>
          </div>
        </form>
        <form class="form-margin-top form-row-reverse">
          <button class="add-button">add</button>
          <input placeholder="00:00" class="add-input-text" type="text" name="scheduleNewHour">
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Description</h1>
        <form>
          <textarea placeholder="description" maxlength="1024" name="description"></textarea>
          <button class="standard-button">submit</button>
        </form>
      </div>
      <div class="panel">
        <h1 class="panel-header">Edit Additional Informations</h1>
        <form>
          <h2 class="panel-subheader first-panel-subheader">proffesion</h2>
          <div>
            <span class="input-text-span">old profession</span>
            <p class="input-text">barber</p>
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
            <input type="checkbox" name="payment-method" id="cash">
            <label class="checkbox-mock" for="cash"></label>
            <label class="checkbox-label" for="cash">cash</label>
          </div>
          <div>
            <input disabled type="checkbox" name="payment-method" id="terminal">
            <label class="checkbox-mock" for="terminal"></label>
            <label class="checkbox-label" for="terminal">terminal</label>
          </div>
          <div>
            <input disabled type="checkbox" name="payment-method" id="application">
            <label class="checkbox-mock" for="application"></label>
            <label class="checkbox-label" for="application">application</label>
          </div>
          <button class="standard-button">submit</button>
        </form>
        <form>
          <h2 class="panel-subheader">certificates</h2>
          <div>
            <span class="input-text-span">old certificate</span>
            <p class="input-text">barber</p>
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
            <p class="input-text">barber</p>
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
            <p class="input-text">barber</p>
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
            <p class="input-text">barber</p>
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
        <form class="form-align-center form-row-left">
          <button class="delete-button" type="submit">delete</button>
          <span class="list-span list-price">13 $</span>
          <span class="list-span">treatment treatment treatment treatment treatment treatment</span>
        </form>
        <form class="form-align-center form-row-left">
          <button class="delete-button" type="submit">delete</button>
          <span class="list-span list-price">13 $</span>
          <span class="list-span">treatment treatment treatment treatment</span>
        </form>
        <form class="form-row-reverse form-align-center">
          <button class="add-button-product">add</button>
          <input placeholder="price" class="add-input-specjal add-price" type="text" name="priceValue">
          <input placeholder="product" class="add-input-specjal add-product" type="text" name="productValue">
        </form>
      </div>
    </div>
  </div>
</body>
</html>