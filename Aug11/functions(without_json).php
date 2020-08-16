<?php
const USERS_FILE = 'users.txt';

function showTableform()
{
  $html = '
  <form class="countform" action="http://localhost:21098?action=create" method="post">
    <input type="text" name="user" placeholder="Your Name">
    <input type="text" name="phone" placeholder="+380...">
  <button type="submit" name="submit" class="btn btn-dark">Submit</button>
  </form>
  ';
  echo $html;
}

function showContactTable()
{
  $html = '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <table class="table" border=1>
  <thead class="thead-dark">
  <th>User</th>
  <th>Number</th>
  <th>IMG</th>
  </thead>
  <tbody>';

    foreach (getContactData() as $contact) {
      $html .= "<tr><td>{$contact['user']}</td><td>{$contact['phone']}</td><td><img src='uploads/images.png' width='150'></td></tr>";
    }

    $html .= '</tbody></table>';

  echo $html;
}

function getContactData(): array
{
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

    return $users;
}

function createContacts(string $name, string $phone) {
  $users = getContactData();
  $users[] = [
    'user' => $name,
    'phone' => $phone
  ];
  writeUsers($users);
}

function writeUsers(array $users){
  $strToWrite = '';

  foreach ($users as $user) {
    foreach ($user as $key => $value) {
      $strToWrite .= "$key=$value;";
    }
    $strToWrite = rtrim($strToWrite, ';');
    $strToWrite .= PHP_EOL;
  }

  $strToWrite = rtrim($strToWrite, PHP_EOL);

  file_put_contents(USERS_FILE, $strToWrite);
}
