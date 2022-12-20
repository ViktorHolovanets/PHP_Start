<?php

namespace App\Controllers\Message;

use App\Http\Requests\Request;
use App\Http\Responses\Interfaces\IResponse;

class Telegram implements Interfaces\IMessage
{

    public static function send(Request $request, IResponse $response)
    {
        $data = [
            'chat_id' => $_ENV['TEL_ID'],
            'text' => $request->input('message')
        ];
        $response = file_get_contents("https://api.telegram.org/bot$_ENV[TEL_TOKEN]/sendMessage?" .
            http_build_query($data));
    }
}