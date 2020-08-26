<?php
require_once "functions.php";

$action = $_GET['action'] ?? ['main'];

switch ($action) {
  case 'create':
    if (empty($_FILES['newfile']['name'])) {
      die ("No file has been chosen for upload!");
    }
      addToTable();
      break;
  case 'main':
  default:
  showTableform();
  showContactTable();
  break;
}
