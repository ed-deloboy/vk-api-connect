<?php

//  1796fa09b8bd6fb12dfde24f4be9ffeb3a67edd70a81db9eb0ea2f9b88c8750ba9ecc43b99d01ea49619e

$token = $_POST['token'];
$user_byId = trim($_POST['user_byId']);
$user_byId = ltrim($user_byId, 'https://vk.com/');
date_default_timezone_set('UTC');

// метод выпадающий список
$methods = $_POST['get_methods'];
switch ($methods) {
    case 1:
        $methods = 'users.getFollowers';
        break;
    default:
        header("Location: ../404.html");
        break;
}

// аватар
$avatar = $_POST['avatar'];
switch ($avatar) {
    case '1':
        $avatar = 'photo_max';
        break;
    default:
        $avatar = '';
        break;
}

///общие друзья
$common_couts = $_POST['common'];
switch ($common_couts) {
    case 1:
        $common_couts = 'common_count';
        break;

    default:
        $common_couts = '';
        break;
}


// $file = file_get_contents('https://api.vk.com/method/groups.getMembers?group_id=rem_service_skynet&count=100&fields=first_name,last_name,sex,online&access_token='.$my_token.'&v=5.120');

// Запрос подписчиков аккаунта
$request_id = file_get_contents("https://api.vk.com/method/users.get?user_ids=" . $user_byId . "&access_token=" . $token . "&v=5.120");

$ansver = json_decode($request_id, true);

$request_subscribe = file_get_contents("https://api.vk.com/method/" . $methods . "?user_id=" . $ansver['response'][0]['id'] . "&fields=id,domain,first_name,last_name,about,bdate,city,last_seen,online," . $avatar . "," . $common_couts . "&access_token=" . $token . "&v=5.120", true);

$ansver_subscribe = json_decode($request_subscribe, true);




// echo 'daatatime new';
// echo '<br>';

// $origin = date_create('2020-10-11');
// $today = date_create(date("Y-d-m"));
// $interval = date_diff($origin, $today);
// echo $interval->format('%y лет %m мес %d дней');




// exit;
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

                <li class="mt-4 list-group-item bg-light border-0 rounded-3 p-4">
                    <?php
                    if ($ansver_subscribe['response']['items'][$i]['online'] == 1) {
                    ?>

                        <p>
                            <span class="p-1 border border-1 border-success rounded text-muted" style="font-size: 0.8rem;">Онлайн</span>
                        </p>

                    <?php

                    } else {
                    ?>
                        <p>
                            <span class="p-1 border border-1 border-danger rounded text-muted" style="font-size: 0.8rem;">Не в сети</span>
                        </p>
                    <?php
                    }
                    ?>


                    <!-- вывод аватара -->
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h3>
                                <?= $ansver_subscribe['response']['items'][$i]['first_name'] ?> <?= $ansver_subscribe['response']['items'][$i]['last_name'] ?>
                            </h3>
                        </div>

                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <a href="<?= 'https://vk.com/' . $ansver_subscribe['response']['items'][$i]['domain'] ?>" target="_blanc">
                                <img class="d-block rounded-circle" style="width: 200px; height: 200px; background-color: #d2d2d2;" src="<?= $ansver_subscribe['response']['items'][$i]['photo_max'] ?>" alt="<?= $ansver_subscribe['response']['items'][$i]['first_name'] ?> <?= $ansver_subscribe['response']['items'][$i]['last_name'] ?>">
                            </a>

                            <!-- Условия проверки города  -->
                            <?php

                            if (isset($ansver_subscribe['response']['items'][$i]['city'])) {
                            ?>
                                <div class="mt-4"><?= $ansver_subscribe['response']['items'][$i]['city']['title'] ?></div>
                            <?php
                            } else {
                            ?>
                                <div class="mt-4"> <?= $ansver_subscribe['response']['items'][$i]['first_name'] ?> скрыл/ла город</div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    <div class="text-secondary">Номер карточки: <?= $i ?></div>
                    <div class="">
                        ID <?= $ansver_subscribe['response']['items'][$i]['id'] ?>
                    </div>


                    <?php

                    // проверка на общих друзей
                    if ($ansver_subscribe['response']['items'][$i]['common_count'] > 0) {
                    ?>

                        <div>
                            Количество общих друзей: <?= $ansver_subscribe['response']['items'][$i]['common_count'] ?>
                        </div>

                    <?php
                    } elseif ($ansver_subscribe['response']['items'][$i]['common_count'] < 1) {
                    ?>

                        <div>
                            У вас нет общих друзей :(
                        </div>

                    <?php
                    }
                    ?>

                    <!-- Условия дня рождения -->
                    <?php
                    if ($ansver_subscribe['response']['items'][$i]['bdate'] != '') {
                    ?>
                        <div>Дата рождения: <?= $ansver_subscribe['response']['items'][$i]['bdate'] ?></div>
                    <?php

                    } else {
                    ?>
                        <div>Дата рождения скрыта</div>
                    <?php
                    }
                    ?>

                    <p class="mt-4">Описание аккаунта: <?= $ansver_subscribe['response']['items'][$i]['about'] ?></p>

                    <!-- Когда заходил последний раз -->
                    <div>

                        <p class="text-success" style="font-size: 0.8rem;">
                            Был/ла онлайн <?php echo date('j-го F Y в h:i', $ansver_subscribe['response']['items'][$i]['last_seen']['time']); ?>
                        </p>


                        <!-- проверка -->
                        <?php
                        switch ($ansver_subscribe['response']['items'][$i]['last_seen']['platform']) {
                            case 1:

                        ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с мобильной версии сайта
                                </p>

                            <?php

                                break;
                            case 2:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с iPhone
                                </p>

                            <?php
                                break;
                            case 3:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с iPad
                                </p>

                            <?php
                                break;
                            case 4:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с Android
                                </p>

                            <?php
                                break;
                            case 5:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с Windows Phone
                                </p>

                            <?php
                                break;
                            case 6:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с Windows 10
                                </p>

                            <?php
                                break;
                            case 7:

                            ?>

                                <p class="text-muted fw-light" style="font-size: 0.8rem;">
                                    Заходил/ла с основного сайта
                                </p>

                        <?php
                        }

                        ?>

                    </div>
                </li>
            <?php
            }
            ?>




        </ul>
    </div>

</body>

</html>