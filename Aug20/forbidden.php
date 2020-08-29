<?php

$forbidden = [
  'heck',
  'hell',
  'corona',
  'delay'
];
$theusercomment = "What the hell is this corona";
foreach ($forbidden as $badword) {
  if(preg_match("/$badword/", $theusercomment))
  {
        $newcomment = str_ireplace($forbidden, '*****', $theusercomment);
  }
  else {
    $newcomment = $comment;
  }
}

echo $newcomment;
///////////////////////////////////////
function checkForbiddenWords()
{
  $forbidden = [
    'heck',
    'hell',
    'corona',
    'delay'
  ];
  $theusercomment = $_POST['comment'];
  foreach ($forbidden as $badword) {
    if(preg_match("/$badword/", $theusercomment))
    {
          $newcomment = str_ireplace($forbidden, '*****', $theusercomment);
        }

    addComment($_POST['title'], $newcomment, $_SESSION['user']['username']);
    }
  }
