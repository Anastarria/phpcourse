<?php

function loginEndpoint()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    makeLogin($_POST['email'], $_POST['password']);
    // header('Location: /');
    die();
  }
  showLoginForm();
}

function showLoginForm()
{
  $email = $_GET['email'] ?? '';

  $form = '';

  if ($error = ($_GET['error'] ?? null)) {
    $form .= '
      <br><div class="alert alert-warning" role="alert">
          ' . $error . '
      </div>
    ';
  }


  $form .= '<h2>Login</h2><form action="/?action=login" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value=' . $email . '>
    <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-dark">Login</button>
</form>';

  echo sprintf(getSiteTemplate(), $form);
}

function registerEndpoint()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      makeRegistration($_POST['username'], $_POST['email'], $_POST['password']);
      die();
    }
    showRegisterForm();
}

function makeLogin(string $email, string $password)
{
  $users = [];

  if (file_exists('users.json')) {
    $users = json_decode(file_get_contents('users.json'), true);
  }

  foreach ($users as $user) {
    if ($email === $user['email'] && md5($user['salt'] . $password . $user['salt']) === $user['password']) {
      $_SESSION['user'] = $user;
      header("Location: /");
      return;
    }
  }

  header("Location: /?action=login&email=$email&error=Incorrect details");
}

function makeRegistration(string $username, string $email, string $password)
{
  $users = [];

  if (file_exists('users.json')) {
    $users = json_decode(file_get_contents('users.json'), true);
  }

  foreach ($users as $user) {
    if ($user['email'] === $email) {
      header("Location: /?action=register&error=User with such email is already registered in the system");
      return;
    }
  }

  $salt = getRandomSalt();

  $users[] = [
    'username' => $username,
    'email' => $email,
    'salt' => $salt,
    'password' => md5($salt . $password . $salt)
    // $role;
  ];

  if (strlen($password) < 12) {
    header("Location: /?action=register&error=Password should contain at least 12 symbols");
    return;
  }

  if (ctype_alnum($password)) {
    header("Location: /?action=register&error=Password must contain at least one special symbol");
    return;
  }

  file_put_contents('users.json', json_encode($users));
  header("Location: /?action=login&email=$email");
}

function showRegisterForm()
{
  $form = '';

  if ($error = ($_GET['error'] ?? null)) {
    $form .= '
      <br><div class="alert alert-warning" role="alert">
          ' . $error . '
      </div>
    ';
  }

  $form .= '<h2>New user registration</h2><form action="/?action=register" method="POST">
  <div class="form-group">
    <label for="exampleInputUsername">Your Name</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter the username you wish to use">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <small id="emailHelp" class="form-text text-muted">The password should contain special symbols and be at least 12 characters long.</small>
  </div>
  <button type="submit" class="btn btn-dark">Register</button>
</form>';

  echo sprintf(getSiteTemplate(), $form);
}

function logoutEndpoint()
{
  session_destroy();
  header("Location: /");
}

function mainEndpoint()
{
  $table = showPhoneTable();
  $showtext = "<br>$table %s";
  $html = sprintf($showtext, getAuthUser() ?? "<br>You must log in if you wish to make any changes!");

  echo sprintf(getSiteTemplate(), $html);
}

function getSiteTemplate() : string
{
    $html = '<html>';
    $html .= '<head>';
    $html .= getBootstrapHead();
    $html .= '</head>';
    $html .= '<body>';
    $html .= '<div>';
    $html .= '
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Sitish</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>';
      if ($user = getAuthUser()) {
        $html .= '
              <div class="collapse collapse-add navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav nav-right">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    ' . "Howdy, $user!" . '
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#">Dashboard</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="/?action=logout">Logout</a>
                      </div>
                  </li>
                </ul>
              </div>';
      } else {
        $html .= '
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="/?action=login">Login<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/?action=register">Register</a>
                  </li>
                </ul>
              </div>';
      }

$html .= '
    </nav>
    ';
    $html .= '</div>';
    $html .= '<div class="container">';
    $html .= '%s';
    $html .= '</div>';
    $html .= getBootstrapJS();
    $html .= '</body>';
    $html .= '</html>';

    return $html;
}

function getBootstrapHead()
{
  return '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  ';
}

function getBootstrapJS()
{
  return '
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  ';
}

function getRandomSalt(int $length = 32)
{
  $abc = array_merge(
    range('a', 'z'),
    range('A', 'Z'),
    [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, '!', '^']
  );

  $hash = '';

  $abcLen = count($abc);

  for ($i=0; $i < $length; $i++) {
    $index = rand(0, $abcLen - 1);
    $hash .= $abc[$index];
  }
  return $hash;
}

function getAuthUser(): ?string
{
  return $_SESSION['user']['username'] ?? null;
}

function showPhoneTable()
{
  $html = '';
if ($user = getAuthUser())
{
  $html .= '
  <h2>Add data to the table using this form</h2>
  <form action="/?action=create" method="POST">
    <div class="form-group">
      <label class="sr-only" for="inlineFormInputName">Name</label>
      <input type="text" name="name" class="form-control" id="validationServer01" placeholder="Name" required>
    </div>
    <div class="form-group">
      <label class="sr-only" for="exampleInputEmail1">Email address</label>
      <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
    </div>
    <div class="form-group">
      <label>Contact Phone Number</label>
      <input type="phone" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="+380..." required>
    </div>
    <button type="submit" for="validationDefault01" class="btn btn-dark"">Submit</button>

  </form>';
}

  $html .= '
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <table class="table" border=1>
  <thead class="thead-dark">
  <th>Name</th>
  <th>Contact Email</th>
  <th>Contact Number</th>
  </thead>
  <tbody>';

    foreach (getContactData() as $user) {
      $html .= "<tr><td>{$user['name']}</td><td>{$user['email']}</td><td>{$user['phone']}</td></tr>";
    }

    $html .= '</tbody></table>';
    if ($user = getAuthUser()) {
      $html .= "You are logged in as";
    }
    ;

  return $html;
}

function getContactData(): array
{
    $jsonString = file_get_contents('tabledata.json');
    return json_decode($jsonString, true) ?? [];
}

function addUserEndpoint()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addUserToTable($_POST['name'], $_POST['email'], $_POST['phone']);
      header("Location: /");
    die();
  }
  mainEndpoint();
}

function addUserToTable(string $name, string $email, string $phone)
{
  $users = [];

  if (file_exists('tabledata.json')) {
    $users = json_decode(file_get_contents('tabledata.json'), true);
  }

  $users[] = [
    'name' => $name,
    'email' => $email,
    'phone' => $phone
    ];

  file_put_contents('tabledata.json', json_encode($users));
}

//for admin user:
//
// if ( is_admin($current_user) ) {
// 	echo "Вы находитесь в админке";
// }
// else {
// 	echo "Вы просматриваете фронт-энд сайта (тему)";
// }




// $_SESSION['role'] = "admin"; // this approach will be always same
// $_SESSION['role'] = $user['Your_User_Role_coulmn_name']; // you need to store dynamic user role into the session
// if((isset($_SESSION['role']) && $_SESSION['role'] == "admin")){
//     header("location: Upload.php");
// }else{
//     header("location: Home.php");
// }