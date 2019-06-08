<?php
class TelegramMessages
{
    public $message;
    public $chat_id;
    public $data;

    public function get_msg() {
        $json = file_get_contents('php://input');
        $this->data = json_decode($json, TRUE);

        $this->chat_id = $this->data['message']['chat']['id'];
        $this->message = $this->data['message']['text'];
        if ($this->message == '/start') {
            self::send_introduction();
        }

        return $this->data;
    }

    public function send_answer($answer) {
        $answer = urlencode($answer);
        $website = 'https://api.telegram.org/bot'.BOT_TOKEN.'/';
        file_get_contents($website."sendMessage?chat_id=".$this->chat_id."&text=$answer");
    }

    public function send_introduction() {
        $text_introduction = "Привіт! \nВітаю, я Бот. \nНадішліть номер ТТН";
        self::send_answer($text_introduction);
    }

}
