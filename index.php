<?php
echo "hey";
require_once('Logging.php');
require_once('ParentClass.php');

require_once('Update.php');
require_once('Client.php');
class DemoApp extends ParentClass
{
    public function run()
    {
        $log = new Logging();
//        $parenClass = new ParentClass();
        // set path and name of log file (optional)
        $log->lfile('log.txt');
        $json = file_get_contents('php://input');
        $log->lwrite("post: " . $json);

        $update = new Update($json);

        $message = $update->getMessage();
        $chat = $message->getChat();
        $chat_id = $chat->getId();
        $text = $message->getText();
        $client = new Client();

        $client->sendMessage($chat_id, $text, null, null, null);
        $client->sendLocation($chat_id, 53.480759, -2.242631, null, null);
        $client->sendPhoto($chat_id, 'pic.jpg', 'sweety', null, null);

        $log->lclose();
    }
}

$demo = new DemoApp();
$demo->run();
