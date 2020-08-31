<?php
require_once "session.php";
require_once "functions.php";

$action = $_GET['action'] ?? 'main';

switch ($action) {
  case "addemployee":
    addEmployeeEndpoint();
    break;
  case "main":
  default:
    showEmployeeTable();
}

if (getAdminUser()) {
  $table = "<br>" . showEmployeeTable();
  echo sprintf(getSiteTemplate(), $table);
} else {
  include("403.html");
}