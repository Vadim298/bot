<?php
/**
 * Created by PhpStorm.
 * User: vadym
 * Date: 22.07.18
 * Time: 18:08
 */
include('vendor/autoload.php'); //Подключаем библиотеку
use Telegram\Bot\Api;


// Устанавливаем токен, полученный у BotFather
$telegram = new Api('375466075:AAEARK0r2nXjB67JiB35JCXXhKEyT42Px8s');

// Передаем в переменную $result полную информацию о сообщении пользователя
$result = $telegram -> getWebhookUpdates();

// Текст сообщения
$text = $result["message"]["text"];

//Уникальный идентификатор пользователя
$chat_id = $result["message"]["chat"]["id"];

// Nickname пользователя
$name = $result["message"]["from"]["username"];

// Меню (5 кнопок)
$keyboard = [["Описание компании"],["Ссылка на сайт компании"],["Контакт Вадима"],
            ["Контакт тех. поддержки"], ["Приглашение в чат"]];

// Текст при нажатии кнопки "Запустить"
if($text){

    if ($text == "/start") {

        $reply = "Добро пожаловать! Спасибо, что подписались! 
                  Что я могу?
                  Я могу вам помочь заработать вместе с командой
                  Вадима Соловьёва!"; //Нужно доработать

        // Поднять, опустить меню
        $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true,
            'one_time_keyboard' => false ]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    // Текст при введении команды /help
    }elseif ($text == "/help") {
        $reply = "Выберите пункт меню, который вас интересует.";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);

    // Пункт меню "Описание компании"
    }elseif ($text == "Описание компании") {
        $reply = "Описание (Функция в разработке)";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);

    // Пункт меню "Ссылка на сайт компании"
    }elseif ($text == "Cсылка на сайт компании") {
        $reply = "https://github.com/Vadim298/bot/blob/master/bot/telegrambot.php (Мой гитхаб, тут можно посмотреть
        прогресс в написании бота)";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply]);

    // Пункт меню "Контакт Вадима Соловьёва
    }elseif ($text == "Контакт Вадима") {
        $reply = "@solovev_v (Функция в разработке)";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply]);

    // Пункт меню "Контакт тех. поддержки"
    }elseif ($text == "Контакт тех. поддержки") {
        $reply = "(Функция в разработке)";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply]);

    // Пункт меню "Приглашение в чат"
    }elseif ($text == "Приглашение в чат") {
        $reply = "https://t.me/joinchat/IqjRZE107Y0MbW0P9OyCvw (Функция в разработке)";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply]);

    // Текст если пользователь введет левую команду.
    }else{
        $reply = "По запросу \"<b>".$text."</b>\" ничего не найдено.";
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode'=> 'HTML', 'text' => $reply ]);
    }
}else{
    $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);
}
?>

