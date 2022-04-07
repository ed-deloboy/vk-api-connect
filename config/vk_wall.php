<?php

//  1796fa09b8bd6fb12dfde24f4be9ffeb3a67edd70a81db9eb0ea2f9b88c8750ba9ecc43b99d01ea49619e

$token = $_POST['token'];
$user_byId = trim($_POST['user_byId']);
$user_byId = ltrim($user_byId, 'https://vk.com/');

if($_POST['get_methods'] == 1){
    $methods = 'users.getFollowers';
}

// $file = file_get_contents('https://api.vk.com/method/groups.getMembers?group_id=rem_service_skynet&count=100&fields=first_name,last_name,sex,online&access_token='.$my_token.'&v=5.120');

$request_id = file_get_contents("https://api.vk.com/method/users.get?user_ids=".$user_byId."&access_token=".$token."&v=5.120");

$ansver = json_decode($request_id, true);

$request_subscribe = file_get_contents("https://api.vk.com/method/users.getFollowers?user_id=".$ansver['response'][0]['id']."&fields=id,first_name,last_name&access_token=".$token."&v=5.120", true);

$ansver_subscribe = json_decode($request_subscribe, true);



echo '<pre>';

var_dump($ansver_subscribe);





