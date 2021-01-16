<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
  pre_r($_POST);
  ?>
  <form action="" method="post">
    <input name="name" type="text">
    <input type="submit" name="monday" value="Monday">
    <input type="submit" name="monday" value="Thu">
  </form>
</body>
</html>

<?php
  function pre_r( $array ) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
  }
?>