<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/master.css">
    <link href="https://fonts.googleapis.com/css2?family=Rakkas&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <title></title>
  </head>
<body>
  <div class="header">
    <div class="logo_container">
      <h1>Learn and <span>Grow</span></h1>
     </div>
       <ul class="navigation">
         <button type="button" class="btn btn-dark"><a href="#"><li>Register</li></a></button>
         <button type="button" class="btn btn-dark"><a href="#"><li>Login</li></a></button>
       </ul>
  </div>

<div class="leftf">
  <div class="formwrap">
    <form action="form.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="formGroupExampleInput">Add Title</label>
        <input type="text" name= "title" class="form-control" id="formGroupExampleInput" placeholder="Title here">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Add description</label>
        <textarea name ="descr" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add a short desctiprion here"></textarea>
      </div>

      <div class="form-group">
        <label for="exampleFormControlFile1">Choose the thumbnail</label>
        <input name="newfile" type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>


<button type="submit" name="submit" class="btn btn-dark">Submit</button>

    </form>
  </div>
</div>
<div class="rightt">
  <div class="tablewrap">
<?php
$tablearray = [
  [
    'Title' => 'Linux ate my RAM',
    'Description' => 'Don\'t Panic! Your ram is fine! Linux is borrowing unused memory for disk caching',
    'Thumbnail' => '<img src="img/linux.png" alt="linux" class="tableimg">'
  ],
  [
    'Title' => 'Apache',
    'Description' => 'Apache is an open source web server that\'s available for Linux servers free of charge',
    'Thumbnail' => '<img src="img/apache.png" alt="apache" class="tableimg">'
  ],
  [
    'Title' => 'WordPress',
    'Description' => 'WordPress powers 37% of all the websites on the Internet.',
    'Thumbnail' => '<img src="img/wordpress.png" alt="wordpress" class="tableimg">'
  ],
  [
    'Title' => 'MySQL',
    'Description' => 'Its name is a combination of "My", the name of co-founder Michael Widenius\'s daughter, and "SQL", the abbreviation for Structured Query Language.',
    'Thumbnail' => '<img src="img/mysql.png" alt="mysql" class="tableimg">'
  ],
  [
    'Title' => 'Joomla',
    'Description' => 'Joomla has a 4.4% share of the content management system market.',
    'Thumbnail' => '<img src="img/joomla.png" alt="joomla" class="tableimg">'
  ],
  [
    'Title' => 'Opencart',
    'Description' => 'OpenCart is an open source PHP-based online e-commerce solution.',
    'Thumbnail' => '<img src="img/opencart.png" alt="opencart" class="tableimg">'
  ]
];
$html = '<table class="table">';
$html .= '<thead class="thead-dark">';
$html .= '<th scope="col">Title</th>';
$html .= '<th scope="col">Description</th>';
$html .= '<th scope="col">Thumbnail</th>';
$html .= '</thead>';
$html .= '<tbody>';
foreach ($tablearray as $user) {
  $html .= "<tr><td>{$user['Title']}</td><td>{$user['Description']}</td><td>{$user['Thumbnail']}</td></tr>";
}
$html .= '</tbody>';
$html .= '</table>';

echo $html;
 ?>
</div>
</div>

<footer class="footer">
<div class="footercontainer">
  All rights reserved
  <br>Dnipro
  <br>2020
</div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
John Smith
TitleHorosholicartoon-penguin-icon.jpgSoletustry
