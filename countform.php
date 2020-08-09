<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="countform">
      <form action="" method="post">
      <label>Enter a number from 1 to 100</label><br>
      <input type="number" name= "usernumber">
      <?php  ?>
      </form>
    </div>
<?php
$hundred = range(1, 100);
$usernumber = $_POST['usernumber']; //number entered on the page
$counter = 1;
do {
  $rndnumber = getRandomNumber($hundred);
  $counter++;
} while ($usernumber != $rndnumber);
echo "Your number: $usernumber. Attempt: $counter<br>";

function getRandomNumber(array $array): int
{
    $len = count($array);
    $index = rand(0, $len - 1);
    return $array[$index];
}
// echo $usernumber;
 ?>
  </body>
</html>
