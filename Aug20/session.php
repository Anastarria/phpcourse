<?php

if ($_COOKIE['session_id'] ?? []) {
  session_id($_COOKIE['session_id']);
  session_start();
} else {
  $sessionId = md5(rand(1,100000) . md5(time()));
  session_id($sessionId);
  session_start();
  setcookie('session_id', session_id(), 0);
}

//$_SESSION['role'] = "admin"; // this approach will be always same
//$_SESSION['role'] = $user['Your_User_Role_coulmn_name']; // you need to store dynamic user role into the session
