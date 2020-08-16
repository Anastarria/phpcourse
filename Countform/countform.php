<?php
require "functions.php";

showHTML();

if (!is_null($_POST['usernumber'] ?? null)) {
  guessNumber();
}
