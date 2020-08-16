<?php

// $arr = [
// 'users' => [
//   [
//     'name' => 'Anastasia',
//     'age' => '28'
//   ],
//   [
//     'name' => 'Nikolai',
//     'age' => '29'
//   ],
//   'timestamp' => time()
// ]
// ];
//
// $jsonStr = (json_encode($arr));

$jsonStr = file_get_contents('test.json');

$arr = json_decode($jsonStr, true);

print_r($arr);