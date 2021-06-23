<?php

function isAuthorised($login, $password)         //авторизация
{
    if (isset($_GET["login"]) &&  isset($_GET["pass"])) {
        if (!isset($users[$_GET["login"]])) {
            echo "User doesn't exist";
        }
        if ($users[$_GET["login"]]["pass"] !== $_GET["pass"]) {
            echo "Wrong password";
        }
        echo "Authorisation completed";
        return true;
    }
}

function sendMessage($login,$password) {                       //отправка сообщений
    $getData = json_decode(file_get_contents('UserData.json'));
    $text = $_GET['message'];
    $date = date('Y-m-d H:i:s');
    if (isset($text)) {
        $newData = array('login' => $login, 'pass' => $password, 'message' => $text, 'date' => $date);
        array_push($getData->message, $newData);
        file_put_contents('file.json', json_encode($getData));
    }
}

function showMessages() {                            //вывод сообщений
    $getData = json_decode(file_get_contents('UserData.json'));
    for ($i = 0; $i < sizeof($getData->message); $i++) {
        echo "New message!";
        echo $getData[login] . ": " . $getData[message] . "<br/>";
    }
}

function main() {
    $login = $_GET['login'];
    $password = $_GET['password'];

    if(isAuthorised($login, $password)) {
        sendMessage($login,$password);               //если пользователь авторзован, то он может отправить сообшение
    } else {
        showMessages();                             //если не авторизован, то может только посмотреть чат
    }
}




