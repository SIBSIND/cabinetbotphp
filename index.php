<?php
$connect = mysqli_connect('a0160954.xsph.ru:3306','a0160954_bazis','Ghjcnjq2','a0160954_bazis');
if(!$connect) exit();

$output = json_decode(file_get_contents('php://input'),true);
$id = $output['message']['chat']['id'];
$message = $output['message']['text'];
$token = "332809777:AAHjqELf5LmeTgrqxWIp5BxtsTIi9upLsl4";

function sendMessage($token, $id, $message)
{
    file_get_contents("https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $id . "&text=" . $message);
}

if($message == "/start")
{
    $query = mysqli_query($connect, "SELECT `chatid` FROM `users` WHERE chatid = $id");
    $row = mysqli_fetch_array($query);
    if (!$row) 
    {
    mysqli_query($connect, "INSERT INTO `users` (`chatid`) VALUES ($id)");
    $message = "Вы зарегистрировались! Ваш chatid: $id";
    sendMessage($token, $id, $message);
    }
    $message = "Привет, меня зовут Бот Антон! ";
    sendMessage($token, $id, $message.KeyboardMenu());
    $message = 'Попав сюда, ты встретил самого выгодного телеграм бота! Выбери, чем ты хочешь заняться?';
    sendMessage($token, $id, $message.KeyboardMenu());
    $message = "Вы зарегистрированы! Ваш chatid: $id";
    sendMessage($token, $id, $message);
}




file_put_contents("logs.txt",$connection);


function KeyboardMenu(){
    $buttons = [['Заработать денег'],['Рекламировать проект']];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}
?>
