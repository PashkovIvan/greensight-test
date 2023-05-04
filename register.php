<?php
//Реализует обработку AJAX запроса на php

require_once $_SERVER["DOCUMENT_ROOT"] . "/settings.php";

$response = [
    "success" => true,
    "data" => $_POST,
    "messages" => [],
];

if ($_SERVER["HTTP_X_CSRFTOKEN"] !== $_SESSION[CSRF_TOKEN] || !isAjaxRequest()) {
    $response["success"] = false;
    $response["messages"][] = "Доступ запрещён";
    sendResponse($response);
}

if (!filter_var($_POST[EMAIL_INPUT_NAME], FILTER_VALIDATE_EMAIL)) {
    $response["success"] = false;
    $response["messages"][] = sprintf(
        "E-mail адрес '%s' указан неверно",
        $_POST['email']
    );
}

if ($_POST[PASSWORD_INPUT_NAME] !== $_POST[PASSWORD_REPEAT_INPUT_NAME]) {
    $response["success"] = false;
    $response["messages"][] = "Пароли не совпадают";
}

$users = [
    [
        "id" => "1",
        "name" => "Коля",
        "email" => "nikolay@mail.ru",
    ],
    [
        "id" => "12",
        "name" => "Гриша",
        "email" => "gregory@mail.ru",
    ],
    [
        "id" => "13",
        "name" => "Петя",
        "email" => "petrovich@gmail.com",
    ],
    [
        "id" => "15",
        "name" => "Витя",
        "email" => "vitok@mail.ru",
    ],
    [
        "id" => "115",
        "name" => "Андрей",
        "email" => "andy@gmail.com",
    ],
];

foreach ($users as $user) {
    if ($user["email"] === $_POST[EMAIL_INPUT_NAME]) {
        $response["success"] = false;
        $response["messages"][] = "Почта уже занята, попробуйте войти";
        break;
    }
}

if ($response["success"]) {
    $response["messages"][] = "Вы были успешно зарегистрированы";
}

sendResponse($response);

function sendResponse($response)
{
    $logFileName = "/logs/" . date('d.m.Y');
    $logData = array_merge(
        $response,
        [
            "time" => date('d.m.Y H:i:s'),
            "event" => "reg form request",
            "type" => $response["success"] ? "INFO" : "ERROR",
        ]
    );
    file_put_contents(
        $_SERVER["DOCUMENT_ROOT"] . $logFileName,
        print_r($logData, true),
        FILE_APPEND
    );

    unset($response["data"]);

    header('Content-type: application/json');
    die(json_encode($response));
}