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
    $msg = urlencode("Если тебя кто-то пригласил, напиши его реферальный код (получишь бонус!):");
    $but1 = "Нет кода ❗";
    sendMessage($token, $id, $msg.KeyboardMenu1($but1));
    $ref = $message;
}  
if($god != 0 and $message == "Нет кода ❗")
{
    $query = mysqli_query($connect, "SELECT `chatid` FROM `users` WHERE chatid = $id");
    $row = mysqli_fetch_array($query);
    if (!$row) 
    {
    mysqli_query($connect, "INSERT INTO `users` (`chatid`, `pts`) VALUES ($id, 0)");
    $message = urlencode("Вы зарегистрировались! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться?");
    $but1 = "Подзаработать денег! 💰";
    $but2 = "Рекламировать проект! 📢";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
    $god = 0;
    }
}else
{
    $query = mysqli_query($connect, "SELECT `chatid` FROM `users` WHERE chatid = $ref");
    $row = mysqli_fetch_array($query);
    if($row)
    {
        mysqli_query($connect, "INSERT INTO `users` (`chatid`, `pts`, `ref`) VALUES ($id, 0, $ref)");
        $message = urlencode("Вы зарегистрировались и получили бонус (+5 PTS на баланс)! Ваш ChatID: $id\nВаш реферер: $ref. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться?");
        $but1 = "Подзаработать денег! 💰";
        $but2 = "Рекламировать проект! 📢";
        sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
        $god = 0;
}





{
    $message = urlencode("Вы зарегистрированы! Ваш ChatID: $id. \n\nПривет, меня зовут Бот Антон!\nПопав сюда, ты встретил самого выгодного телеграм бота!\n\nВыбери, чем ты хочешь заняться");
    $but1 = "Подзаработать денег! 💰";
    $but2 = "Рекламировать проект! 📢";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
}




if($message == "Подзаработать денег! 💰")
{
    $message = urlencode("Отлично! \n\nУ меня ты можешь зарабатывать баллы выполняя всего три простых шага! \nЯ буду присылать тебе каналы, а твоя задача переходить по ним, изучать тематику канала и ответить на заданный вопрос!\n\nЕсли ты ответишь правильно - заработаешь 1 балл, если ответишь не верно, тогда мы спишем 1 балл с твоего баланса! \nБаллы можно обменивать на реальные рубли по курсу: \n1 балл = 50 копеек!");
    $but1 = "Отлично, жду квест! ⌛";
    $but2 = "Рекламировать проект! 📢";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2));
}

if ($message == "Отлично, жду квест! ⌛")
{
    $message = urlencode("В данный момент очередь на рекламу пуста!");
    sendMessage($token, $id, $message); 
}

if ($message == "Рекламировать проект! 📢")
{
    $message = urlencode("Хочешь пропиарить свой телеграм канал? - Ты по адресу!\nЯ помогу тебе набрать кучу подписчиков, но эта услуга стоит денег!\n\nВстать на рассылку стоит 500 баллов!\n\nЧто это тебе даст?\n1) Более 1000 человек увидят твой канал.\n\nГотов оплатить?");
    $but1 = "Да! 👍";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}

if($message == "Да! 👍")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = 343099999");
    $row = mysqli_fetch_assoc($query);
    $message = "Твой баланс: " . $row['pts'] . urlencode(" PTS.\n\nТебе не хватает денег для покупки рассылки!\nЕсть два варианта:\n1) Пополнить через QIWI\n2) Подзаработать денег");
    $but1 = "Пополнить через QIWI ✔";
    $but2 = "Подзаработать денег! 💰";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}

if($message == "Пополнить через QIWI ✔")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = 343099999");
    $row = mysqli_fetch_assoc($query);
    $commendrand = rand(1000,9999);
    $summ = 500 - $row['pts'];
    $message = "ТВОЙ БАЛАНС: " . $row['pts'] . urlencode(" PTS.\n\nПереведите на QIWI в течение 24 часов! \n\n🔻🔻🔻🔻🔻🔻🔻🔻🔻🔻\n1) КОШЕЛЕК: +79832356445\n2) СУММА: $summ рублей\n3) КОММЕНТАРИЙ: $commendrand\n🔺🔺🔺🔺🔺🔺🔺🔺🔺🔺\n\nБаланс пополнится в течении 3х минут.");
    $but1 = "Проверить 🔄";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}

if($message == "Проверить 🔄")
{
    $query = mysqli_query($connect, "SELECT `pts` FROM `users` WHERE `chatid` = $id");
    $row = mysqli_fetch_assoc($query);
    $message = "Твой баланс: " . $row['pts'] . urlencode(" PTS.\n\nБаланс обновляется раз в 3 минуты. ");
    $but1 = "Проверить 🔄";
    $but2 = "Выйти в меню 🔙";
    sendMessage($token, $id, $message.KeyboardMenu($but1,$but2)); 
}



file_put_contents("logs.txt",$connection);


function KeyboardMenu($but1,$but2){
    $buttons = [[$but1],[$but2]];
    $keyboard =json_encode($keyboard = ['keyboard' => $buttons,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup = '&reply_markup=' . $keyboard . '';

    return $reply_markup;
}

function KeyboardMenu1($but1){
    $buttons1 = [[$but1]];
    $keyboard1 =json_encode($keyboard1 = ['keyboard' => $buttons1,
        'resize_keyboard' => true,
        'one_time_keyboard' => false,
        'selective' => true]);
    $reply_markup1 = '&reply_markup=' . $keyboard1 . '';

    return $reply_markup1;
}
?>
