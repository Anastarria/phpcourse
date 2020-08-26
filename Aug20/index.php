<?php

//require_once "session.php";

die(getRandomSalt());

function getRandomSalt(int $length = 32)
{
  $abc = array_merge(
    range('a', 'z'),
    range('A', 'Z'),
    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '!', '^']
  );

  $hash = '';

  $abcLen = count($abc);

  for ($i=0; $i < $length; $i++) {
    $index = rand(0, $abcLen - 1);
    $hash .= $abc[$index];
  }

  return $hash;

}