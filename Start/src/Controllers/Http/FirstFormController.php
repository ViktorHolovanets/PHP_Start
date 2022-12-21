<?php

namespace App\Controllers\Http;

use App\Controllers\Message\Mail;
use App\Controllers\Message\Telegram;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Http\Requests\Request;
use App\Http\Responses\Interfaces\IResponse;

class FirstFormController
{
    public function get(Request $request, IResponse $response)
    {

        $response->data['htmlBodyMain'] =
            "<form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>"
            . "<div><label> Name: <input type='text' name = 'name' value='Viktor'></label></div>"
            . "<div><label> Email: <input type='text' name = 'email'></label></div>"
            . "<div><label> Message: <textarea name = 'message'></textarea></label></div>"
            . "<div><select name='type'>
                    <option value='mail'>Mail</option>
                    <option value='telegram' selected>Telegram</option>
                </select></div>"
            . "<input type='submit'>"
            . "</form>";

    }

    public function post(Request $request, IResponse $response) {
        $response->data['htmlBodyMain'] = "<div> \n\n Все хорошо \n\n </div>";
    }

    public function put(Request $request, IResponse $response) {
        if(!is_null($request->input('type'))){
            switch ($request->input('type')){
                case 'mail': Mail::send($request, $response);
                    break;
                case 'telegram': Telegram::send($request, $response);
                    break;
            }
        }

        $response->data['data'] = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message')
        ];
    }

}