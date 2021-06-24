
<html>
<style>
    html, body {
        height: 100%;
        width: 100%;
    }
    .chat {
        border:1px solid #333;
        margin:15px;
        width:40%;
        height:70%;
        background:#555;
        color:#fff;
    }
    .chat-messages {
        min-height:93%;
        max-height:93%;
        overflow:auto;
    }
    .chat-messages__content {
        padding:1px;
    }

    .chat-input {
        min-height:6%;
    }
    input {
        font-family:arial;
        font-size:16px;
        vertical-align:middle;
        background:#333;
        color:#fff;
        border:0;
        display:inline-block;
        margin:1px;
        height:30px;
    }
    .chat-form__input {
        width:79%;
    }
    .chat-form__submit {
        width:18%;
    }
</style>

<div class='chat'>
	<div class='chat-messages'>
		<div class='chat-messages__content' id='messages'>
    Загрузка...
		</div>
	</div>
	<div class='chat-input'>
		<form method='post' id='chat-form'>
			<input type='text' id='message-text' class='chat-form__input' placeholder='Введите сообщение'> <input type='submit' class='chat-form__submit' value='=>'>
		</form>
	</div>
</div>
</html>

<?php
function isAuthorised($login, $password)                    //авторизация
{
    if (isset($_GET["login"]) && isset($_GET["pass"])) {
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





