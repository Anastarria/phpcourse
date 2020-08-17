<?php

const USERS_FILE = 'data.json';

function addToTable() {
  $users = getContactData();

  dataTransform($users);
}
function getContactData(): array
{
    $jsonString = file_get_contents(USERS_FILE);
    return json_decode($jsonString, true) ?? [];
}

function dataTransform() {
  $path = "";
  $path = $path . basename( $_FILES['newfile']['name']);
  if(!empty($_FILES['newfile']))
  {
    $fileType = strtolower(pathinfo($_FILES['newfile']['name'],PATHINFO_EXTENSION));
    if($fileType != "csv") {
    die ("Sorry, only CSV files are allowed.");
    $uploadOk = 0;
}
      elseif(move_uploaded_file($_FILES['newfile']['tmp_name'], $path)) {



      $fp = fopen($_FILES['newfile']['name'], 'r');
      $key = fgetcsv($fp,"1024",",");
      // parse csv rows into array
      $json = array();
        while ($row = fgetcsv($fp,"1024",",")) {
        $json[] = array_combine($key, $row);
         }
      $encode = json_encode($json);
      file_put_contents(USERS_FILE, $encode);

      fclose($fp);
      echo "<br>The table has been updated with the data from  ".  basename( $_FILES['newfile']['name']). " file";
      }

   }
}

function showTableform()
{
  $html = '
  <form action="http://localhost:9000?action=create" method="post" enctype="multipart/form-data">
        <input name="newfile" type="file">
        <button type="submit" name="import" class="btn btn-dark">Import Data</button>
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
      $html .= "<tr><td>{$contact['ID']}</td><td>{$contact['Email']}</td><td>{$contact['Phone']}</td></tr>";
    }

    $html .= '</tbody></table>';

  echo $html;
}