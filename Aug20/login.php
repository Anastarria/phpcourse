<?php

$email = $_POST['email'];
$password = $_POST['password'];

$users = [];

if (file_exists('users.json')) {
  $users = json_decode(file_get_contents('users.json'), true);
}

foreach ($users as $user) {
  if ($email === $user['email'] && md5($user['salt'] . $password . $user['salt']) === $user['password']) {
    die("Welcome $email!");
  }
}

die("invalid credentials");