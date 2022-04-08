<?php

// Получаем посты со стены
$token = $_POST['token'];
$group_link = trim($_POST['group_link']);
$group_link = ltrim($group_link, 'https://vk.com/');


$request_url = file_get_contents('https://api.vk.com/method/wall.get?&domain=' . $group_link . '&access_token=' . $token . '&v=5.120');

$ansver_url = json_decode($request_url, true);

// echo '<pre>';

// print_r($ansver_url);

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
            <p class="h5">На этой странице <?= $ansver_url['response']['count'] ?> записей</p>
            <ul class="mt-4 col-12 list-group">
                <?php


                for ($i = 0; $i < count($ansver_url['response']['items']); $i++) {

                ?>

                    <li class="mt-4 list-group-item bg-dark text-white">
                        <div><?= $i ?></div>
                        <div class="">
                            ID <?= $ansver_url['response']['items'][$i]['id'] ?>
                        </div>
                        <div class="">
                            Дата и время создания статьи: 
                            <?php
                            $date = $ansver_url['response']['items'][$i]['date'];
                            echo date("d.m.y h:i:s", $date);
                            ?>
                        </div>
                        <div></div>
                        <div>
                            Заголовок: <?= $ansver_url['response']['items'][$i]['text'] ?>
                        </div>

                    </li>

                <?php
                }
                ?>

            </ul>
        </div>
    </div>



</body>

</html>