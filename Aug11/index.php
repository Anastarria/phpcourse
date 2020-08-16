<?php

require_once "functions.php";

$action = $_GET['action'] ?? ['main'];

switch ($action) {
  case 'create':
    if (empty($_POST['user']) || empty($_POST['phone'])) {
      die ("All fields must be filled");
    }
      createContacts($_POST['user'], $_POST['phone']);
      break;
  case 'main':
  default:
  showTableform();
  showContactTable();
  break;
}

// showTableform();
// showContactTable();
