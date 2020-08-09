<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Thank you!
    <br> We will add the following to the table:
    <br> Title: "<?php echo htmlspecialchars($_POST['title']); ?>";
    <br> Description: <?php echo htmlspecialchars($_POST['descr']);

//imagesuploadscript
if(!empty($_FILES['newfile']))
{
  $path = "uploads/";
  $path = $path . basename( $_FILES['newfile']['name']);
  if(move_uploaded_file($_FILES['newfile']['tmp_name'], $path)) {
    echo "<br>The file ".  basename( $_FILES['newfile']['name']).
    " has been uploaded";
  } else{
      echo "There was an error uploading the file, please try again!";
  }
}

?>
  </body>
</html>
