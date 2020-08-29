<?php
require_once "session.php";
require_once "functions.php";

if (getAuthUser()) {
  $table = "<br>" . showCommentsLog();
  echo sprintf(getSiteTemplate(), $table);
} else {
  include("403.html");
}

$action = $_GET['action'] ?? 'main';

switch ($action) {
  case "create":
    addThreadEndpoint();
    break;
  case 'main':
  default:
    showCommentsLog();
}

