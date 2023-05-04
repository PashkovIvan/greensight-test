<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/settings.php";

?>
<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="<?= $_SESSION[CSRF_TOKEN] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Форма регистрации">
    <meta name="keywords" content="регистрация">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="/register.css" rel="stylesheet">
    <link rel="icon" href="https://getbootstrap.com/docs/5.3/assets/img/favicons/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" crossorigin="anonymous"
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="></script>
    <title>Регистрация</title>
</head>
<body class="text-center">
<main class="form-signin w-100 m-auto">
    <form id="regForm" action="/register.php">
        <!-- Form -->
        <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

        <div class="alert alert-danger" style="display: none;" role="alert" id="errorAlert"></div>

        <div class="form-floating">
            <input type="text" required class="form-control" id="firstName" placeholder="Иван"
                   name="<?= FIRST_NAME_INPUT_NAME ?>">
            <label for="firstName">Имя</label>
        </div>
        <div class="form-floating">
            <input type="text" required class="form-control" id="lastName" placeholder="Иванов"
                   name="<?= LAST_NAME_INPUT_NAME ?>">
            <label for="lastName">Фамилия</label>
        </div>
        <div class="form-floating">
            <input type="email" required class="form-control" id="email" placeholder="ivanov.i@mail.ru"
                   name="<?= EMAIL_INPUT_NAME ?>">
            <label for="email">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" required class="form-control" id="password" placeholder="Пароль"
                   name="<?= PASSWORD_INPUT_NAME ?>">
            <label for="password">Пароль</label>
        </div>
        <div class="form-floating">
            <input type="password" required class="form-control" id="passwordRepeat" placeholder="Повторите пароль"
                   name="<?= PASSWORD_REPEAT_INPUT_NAME ?>">
            <label for="passwordRepeat">Повторите пароль</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>
        <div class="spinner-border text-dark" id="formLoader" style="display: none;" role="status">
            <span class="visually-hidden">Регистрируем...</span>
        </div>
        <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">ОК</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="/register.js"></script>
</body>
</html>
