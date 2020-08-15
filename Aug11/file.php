<?php

const USERS_FILE = 'users.txt';
$usersString = file_get_contents(USERS_FILE);
   $u = explode(PHP_EOL, $usersString);

   $users = [];

   foreach ($u as $userRow) {
       $parts = explode(';', $userRow);
       $user = [];
       foreach ($parts as $keyValue) {
           $p = explode('=', $keyValue);
           $key = $p[0];
           $value = $p[1];
           $user[$key] = $value;
       }

       $users[] = $user;
   }


print_r($users);
