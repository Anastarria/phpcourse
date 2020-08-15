<?php
function showHTML()
{
  $html = '<html>
      <head> <link rel="stylesheet" type="text/css" href="../css/master.css">
      <meta charset="utf-8">
      <title></title>
      </head>
        <body>
          <form class="countform" action="" method="post">
            <label>Enter a number from 1 to 100</label><br>
            <input type="number" name= "usernumber">
          </form>
        </body>
            </html>';
  echo $html;
}

function guessNumber()
{
  $hundred = range(1, 100);
  $usernumber = (int) $_POST['usernumber']; //number entered on the page
  $counter = 1;
  //is_numeric - проверяет является ли переменная числом или строкой содержащей число. Если есть форма с перебором в коде, эту проверку ставить желательно.
  if ($usernumber < 1 || $usernumber > 100 || !is_numeric($_POST['usernumber'])) {
          die("Wrong data given.");
      }
  do {
    $rndnumber = getRandomNumber($hundred);
    $counter++;
  } while ($usernumber != $rndnumber);
  echo "Your number: $usernumber. Attempt: $counter<br>";
}

function getRandomNumber(array $array): int
{
    $len = count($array);// высчитываем длину массива
    $index = rand(0, $len - 1);//$len - 1 - длина массива -1. Функция вызывает индекс из массива начиная с 0, поэтому нам недо отнять один. Напр в диапазоне (1, 100) длина массива 100 но максимальный индекс 99 ведь отсчет с нуля.
    return $array[$index];//
}
