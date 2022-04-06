<?php

//  1796fa09b8bd6fb12dfde24f4be9ffeb3a67edd70a81db9eb0ea2f9b88c8750ba9ecc43b99d01ea49619e

$token = $_POST['token'];
$group_id = $_POST['group_id'];

if($_POST['get_methods'] == 1){
    $methods = 'groups.get';
}
else if($_POST['get_methods'] == 2){
    $methods = 'groups.getCatalog';
}

// $request = 'https://api.vk.com/method/'.$methods.'?&user_id='.$group_id.'&fields=country,first_name,last_name&access_token='.$token.'&v=5.120';

$request = "https://api.vk.com/method/groups.getById?&group_id=rem_service_skynet&fields=first_name,last_name,city,country,cover,description,status&access_token=1796fa09b8bd6fb12dfde24f4be9ffeb3a67edd70a81db9eb0ea2f9b88c8750ba9ecc43b99d01ea49619e&v=5.120";

$ansver = json_decode($request);

echo '<pre>';
// print_r($token);
// echo '<br>';

// print_r($group_id);
// echo '<br>';

// print_r($methods);
// echo '<br>';
// var_dump($ansver);
print_r($ansver);
