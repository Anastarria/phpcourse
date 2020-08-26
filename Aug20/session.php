<?php

if ($_COOKIE['session_id'] ?? []) {
  echo "recover old one";
  session_id($_COOKIE['session_id']);
  session_start();
} else {
  echo "new session";
  $sessionId = md5(rand(1,100000) . md5(time()));
  session_id($sessionId);
  session_start();
  setcookie('session_id', session_id(), time() + 10);
}

