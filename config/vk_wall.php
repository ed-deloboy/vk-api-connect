<?php

//  1796fa09b8bd6fb12dfde24f4be9ffeb3a67edd70a81db9eb0ea2f9b88c8750ba9ecc43b99d01ea49619e

$token = $_POST['token'];
$user_byId = trim($_POST['user_byId']);
$user_byId = ltrim($user_byId, 'https://vk.com/');

$methods = $_POST['get_methods'];

switch ($methods) {
    case 1:
        $methods = 'users.getFollowers';
        break;
    default:
        header("Location: ../404.html");
        break;
}


// $file = file_get_contents('https://api.vk.com/method/groups.getMembers?group_id=rem_service_skynet&count=100&fields=first_name,last_name,sex,online&access_token='.$my_token.'&v=5.120');

$request_id = file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $user_byId . "&access_token=" . $token . "&v=5.120");

$ansver = json_decode($request_id, true);

$request_subscribe = file_get_contents("https://api.vk.com/method/".$methods."?user_id=" . $ansver['response'][0]['id'] . "&fields=id,first_name,last_name,about,bdate&access_token=" . $token . "&v=5.120", true);

$ansver_subscribe = json_decode($request_subscribe, true);



// echo '<pre>';

// print_r($ansver_subscribe);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>

    <div class="col-12 mt-4">
        <div class="container">
            <p class="col-12 h5">По аккаунту <?= $ansver['response'][0]['first_name'] . ' ' . $ansver['response'][0]['last_name'] ?> мы нашли <?= $ansver_subscribe['response']['count'] ?> подисчиков</p>
        </div>
    </div>

    <div class="container">
        <ul class="mt-4 col-12 list-group">

            <?php

            for ($i = 0; $i < count($ansver_subscribe['response']['items']); $i++) {

            ?>

                <li class="mt-4 list-group-item bg-dark text-white">
                    <div><?= $i ?></div>
                    <div class="">
                        ID <?= $ansver_subscribe['response']['items'][$i]['id'] ?>
                    </div>
                    <div></div>
                    <div>Имя: <?= $ansver_subscribe['response']['items'][$i]['first_name'] ?></div>
                    <div>Фамилия: <?= $ansver_subscribe['response']['items'][$i]['last_name'] ?></div>
                    <div>Дата рождения: <?= $ansver_subscribe['response']['items'][$i]['bdate'] ?></div>
                    <div>Описание аккаунта: <?= $ansver_subscribe['response']['items'][$i]['about'] ?></div>
                </li>


            <?php
            }
            ?>

        </ul>
    </div>

</body>

</html>