<?php
require_once "functions.php";

$action = $_GET['action'] ?? ['main'];

switch ($action) {
  case 'create':
    // if (empty($_FILES['newfile'])) {
    //   die ("You need to choose a file to upload");
    // }
      dataTransform($_FILES['newfile']);//сделаем такую функцию для считывания-записи данных в таблицу.
      break;
  case 'main':
  default:
  showTableform();
  showContactTable();
  break;
}

//This part will be updated in functions.php

// const USERS_FILE = 'data.json';


function getContactData(): array
{
    $jsonString = file_get_contents(USERS_FILE);
    return json_decode($jsonString, true) ?? [];
}

function writeUsers(array $users){
  $f = fopen($_FILES['newfile'], 'r'); // fopen ( string $filename , string $mode [, bool $use_include_path = FALSE [, resource $context ]] ) : resource
  $json = json_encode($users);

  file_put_contents(USERS_FILE, $json);
}

function dataTransform() {  //переделать эту функцию чтобы она считывала данные
  $users = getContactData();
  $users[] = [
    'ID' => $id,
    'Email' => $email,
    'Number' => $number
  ];
  writeUsers($users);
}




