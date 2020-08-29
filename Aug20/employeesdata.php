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
  <tbody>';

    foreach (getEmployeeData() as $user) {
      $html .= "<tr><td>{$user['name']}</td><td>{$user['sex']}</td><td>{$user['age']}</td><td>{$user['salary']}</td><td>{$user['department']}</td></tr>";
    }

  return $html;
}