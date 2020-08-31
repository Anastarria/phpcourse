<?php

if (getEmployeeAge() > 55 || getEmployeeAge() < 18 || !is_numeric($_POST['age'])) {
  header("Location: /?action=register&error=Failed to add. Only people between 18 and 55 can be hired.");
  return;
}


if (getEmployeeAge() > 55 || getEmployeeAge() < 18 || !is_numeric($_POST['age'])) {
            die('
              <br><div class="alert alert-warning" role="alert">
                  Failed to add. Only people between 18 and 55 can be hired.
              </div>
            ');
        }


        if ($error = ($_GET['error'] ?? null)) {
          $form .= '
            <br><div class="alert alert-warning" role="alert">
                ' . $error . '
            </div>
          ';
        }