<?php
require_once "session.php";
require_once "functions.php";

if (getAdminUser()) {
  $table = "<br>" . showLogTable();
  echo sprintf(getSiteTemplate(), $table);
} else {
  include("403.html");
}


