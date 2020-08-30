<?php
require_once "session.php";
require_once "functions.php";

if (getAdminUser()) {
  $table = "<br>" . showEmployeeTable();
  echo sprintf(getSiteTemplate(), $table);
} else {
  include("403.html");
}

$action = $_GET['action'] ?? 'main';

switch ($action) {
  case "addemployee":
    addEmployeeEndpoint();
    break;
  case "main":
  default:
    showEmployeeTable();
}

function getEmployeeData()
{
  $jsonString = file_get_contents('employee.json');
  return json_decode($jsonString, true) ?? [];
}

function addEmployeeEndpoint()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    addEmployeeToTable($_POST['name'], $_POST['sex'], $_POST['age'], $_POST['salary'], $_POST['department']);
    header("Location: /employeesdata.php");
    die();
  }
  showEmployeeTable();
}

function addEmployeeToTable(string $name, string $sex, string $age, int $salary, string $department)
{
  $users = [];
  if ($age > 55 || $age < 18 || !is_numeric($_POST['age'])) {
          die('
            <br><div class="alert alert-warning" role="alert">
                Failed to add an employee. Only a person above 18 or below 55 can work with the company.
            </div>
          ');
      }
  if (file_exists('employee.json')) {
    $users = json_decode(file_get_contents('employee.json'), true);
  }

  $users[] = [
    'name' => $name,
    'sex' => $sex,
    'age' => $age,
    'salary' => $salary,
    'department' => $department
    ];

  file_put_contents('employee.json', json_encode($users));
}


function showEmployeeTable()
{
  $html = '
  <h2>Add employee data to the table using this form</h2>
  <form action="/employeesdata.php?action=addemployee" method="POST">
    <div class="form-group">
      <label>Name</label>
      <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Employee Name" required>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="Male" checked>
      <label class="form-check-label" for="exampleRadios1">
        Male
      </label>
    </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="sex" id="exampleRadios1" value="Female" checked>
      <label class="form-check-label" for="exampleRadios1">
      Female
    </label>
  </div>
    <div class="form-group">
      <label>Age</label>
      <input type="number" name="age" class="form-control" id="exampleFormControlInput1" placeholder="Employee age" required>
    </div>
    <div class="form-group">
      <label>Salary</label>
      <input type="number" name="salary" class="form-control" id="exampleFormControlInput1" placeholder="$" required>
    </div>
    <div class="form-group">
    <label for="exampleFormControlSelect1">Department</label>
    <select name ="department" class="form-control" id="exampleFormControlSelect1">
      <option>HR</option>
      <option>Customer Support</option>
      <option>Technical Support</option>
      <option>Management</option>
      <option>Lawyers</option>
    </select>
  </div>
    <button type="submit" for="validationDefault01" class="btn btn-dark"">Add Employee</button>

  </form>

  <table class="table" border=1>
  <thead class="thead-dark">
  <th>Name</th>
  <th>Sex</th>
  <th>Age</th>
  <th>Salary</th>
  <th>Department</th>
  </thead>
  <tbody>

  ';

    foreach (getEmployeeData() as $user) {
      $html .= "<tr><td>{$user['name']}</td><td>{$user['sex']}</td><td>{$user['age']}</td><td>{$user['salary']}</td><td>{$user['department']}</td></tr>";
    }

    $html .= '
    </tbody>
    </table>
    <br>
    <h2>Salary report</h2>';
    $users = json_decode(file_get_contents('employee.json'), true);
    $salaries = array_column($users, 'salary');
    $count = (array_sum($salaries));
    $html .= "
    <br> <div class='card'>
      <div class='card-header'>
        Total Sum paid for all employees per month
      </div>
      <div class='card-body'>
        <blockquote class='blockquote mb-0'>
          <p>{$count}$</p>
        </blockquote>
      </div>
    </div>
    <br>
    ";

    $html .= '
    <h3>Custom Filters</h3>


    ';

  return $html;
}
//Форма для стат