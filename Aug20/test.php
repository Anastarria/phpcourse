<?php

// if ($year > $age || $year < $age) {
//
// }

// - Сколько денег, я как директор плачу департаменту
// - Сколько денег, я как директор плачу женщинам
// - Сколько денег, я как директор плачу тем, кто младше 30
// - Сколько денег, я как директор плачу всем

$users = json_decode(file_get_contents('employee.json'), true);
$salaries = array_column($users, 'salary');
$count = (array_sum($salaries));

$new = array_filter($users, function ($user) {
    return ($user['department'] == 'HR');
});
$fsalaries = array_column($new, 'salary');
$fcount = (array_sum($fsalaries));

$below30 = array_filter($users, function ($user) {
    return ($user['age'] < '30');
});
$salaries30 = array_column($new, 'salary');
$count30 = (array_sum($salaries30));


print_r($fcount);

//  $fsalaries = array_column($users, 'salary');

//print_r($fsalaries);
die();






$men = "";
$below30 = "";
$hr = "";
$customersupport = "";
$management = "";
$techsupport = "";
$lawyers = "";