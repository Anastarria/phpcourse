<?php

$email = $_POST['email'];
$password = $_POST['password'];

$users = [];

if (file_exists('users.json')) {
  $users = json_decode(file_get_contents('users.json'), true);
}

$salt = getRandomSalt();

$users[] = [
  'email' => $email,
  'salt' => $salt,
  'password' => md5($salt . $password . $salt)
];

file_put_contents('users.json', json_encode($users));

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