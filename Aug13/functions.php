<?php

const USERS_FILE = 'data.json';

function showTableform()
{
  $html = '
  <form action="http://localhost:20777?action=create" method="post">
        <input name="newfile" type="file">
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
  <th>ID</th>
  <th>Email</th>
  <th>Number</th>
  </thead>
  <tbody>';

    foreach (getContactData() as $contact) {
      $html .= "<tr><td>{$contact['user']}</td><td>{$contact['phone']}</td><td><img src='uploads/images.png' width='150'></td></tr>";
    }

    $html .= '</tbody></table>';

  echo $html;
}
//
// function getContactData(): array
// {
//     $jsonString = file_get_contents(USERS_FILE);
//     return json_decode($jsonString, true) ?? [];
// }
//
// function dataTransform() {  //переделать эту функцию чтобы она считывала данные
//   $users = getContactData();
//   $users[] = [
//     'user' => $name,
//     'phone' => $phone
//   ];
//   writeUsers($users);
// }
//
// function writeUsers(array $users){
//   $json = json_encode($users);
//
//   file_put_contents(USERS_FILE, $json);
// }
