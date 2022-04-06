<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>VK API</title>
</head>

<body>
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Features</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">Pricing</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
                    <li><a href="#" class="nav-link px-2 text-white">About</a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..." aria-label="Search">
                </form>

                <div class="text-end">
                    <button type="button" class="btn btn-outline-light me-2">Login</button>
                    <button type="button" class="btn btn-warning">Sign-up</button>
                </div>
            </div>
        </div>
    </header>
    <section class="hero">
        <div class="container">
            <div class="d-flex mt-4">
                <form action="config/vk_api.php" method="post">
                    <!-- token -->
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="inputToken" class="col-form-label">Ведите токен</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="inputToken" class="form-control" name="token">
                        </div>
                        <div class="col-auto">
                            <span class="form-text">
                                Скопируйте и вставьте в это поле ваш токен
                            </span>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <h3>Выборка по группам</h3>
                        <!-- group id -->
                        <div class="row g-3 align-items-center mt-4 mb-4">
                            <div class="col-auto">
                                <label for="group_id" class="col-form-label">Введите id группы после /</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" id="group_id" class="form-control" name="group_id" value="https://vk.com/">
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                    Скопируйте и вставьте в это поле id группы
                                </span>
                            </div>
                        </div>

                        <div class="col-6 left">
                            <select class="form-select" name="get_methods">
                                <option selected>Выбрать</option>
                                <option value="1">Группам</option>
                                <option value="2">По выбранной категории</option>
                            </select>

                        </div>
                        <div class="col-6 right">

                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-4">Отправить</button>

                </form>
            </div>
        </div>
    </section>
</body>

</html>