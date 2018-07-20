<?php
/**
 * Created by PhpStorm.
 * User: vadym
 * Date: 18.07.18
 * Time: 22:10
 */
class telegrambot
{

    protected $token = "627434362:AAGdZFT7dFZEhBsCJGaw9NKMV9hRtbSOhIw";

    protected $updateId;

    protected function query($method, $params = [])
    {
        $url  = "https://api.telegram.org/bot";

        $url .= $this->token;

        $url .= "/".$method;

        if (!empty($params)){
            $url.= "?" . http_build_query($params);
        }

        $client = new \GuzzleHttp\Client([
            'base_uri' => $url
        ]);

        $result = $client->request('GET');

        return json_decode($result->getBody());
    }
    public function getUpdates()
    {
        $response = $this->query('getUpdates',[
            'offset' => $this->updateId +1
        ]);

        if(!empty($response->result)){
            $this->updateId = $response->result[count($response->result) - 1]->update_id;
        }

        return $response->result;
    }
    public function sendMessage($chat_id, $text)
    {
        $response = $this->query('sendMessage', [
            'text'   =>$text,
            'chat_id'=>$chat_id

        ]);
        return $response;
    }
}