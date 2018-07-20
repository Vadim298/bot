<?php
/**
 * Created by PhpStorm.
 * User: vadym
 * Date: 18.07.18
 * Time: 22:42
 */
include ('vendor/autoload.php');
include ('telegrambot.php');

/** получаем сообщения */

$telegramApi = new TelegramBot();
while (true) {

    sleep(2);

    $updates = $telegramApi->getUpdates();

    print_r($updates);

    /** цикл по сообщениям */

    foreach ($updates as $update) {

        /** Отвечает на каждое сообщение */

        $telegramApi->sendMessage($update->message->chat->id, 'Выберите пункт меню!');
    }
}