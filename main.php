<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" >
    <title>Authorization</title>
</head>
<body>
<?php


$login = $_GET['login'];
$password = $_GET['password'];

$admin = json_decode(file_get_contents('data.json'));
$num = 0;

for ($i = 0; $i < sizeof($admin->usersData); $i++) {
    if($admin->usersData[$i]->login === $login) {
        $num = $i;
        break;
    }
}

if(($admin->usersData[$num]->login === $login) && ($admin->usersData[$num]->password === $password)) {
    $text = $_GET['text'];
    $date = date('Y-m-d H:i:s');
    $messenger = array('login' => $login, 'mess' => $text, 'date' => $date);
    array_push($admin->message, $messenger);
    file_put_contents('file.json', json_encode($admin));
}
else {
    echo "Неверный логин или пароль";
}

$admin = json_decode(file_get_contents("file.json"));

for ($i = 0; $i < sizeof($admin->message); $i++) {
    echo "----------------------------";
    echo "<br/>";
    echo $admin->message[$i]->login;
    echo "<br/>";
    echo $admin->message[$i]->mess;
    echo "<br/>";
    echo $admin->message[$i]->date;
    echo "<br/>";
}
?>
</body>
</html>
