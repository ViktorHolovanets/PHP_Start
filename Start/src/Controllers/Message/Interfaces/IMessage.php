<?php

namespace App\Controllers\Message\Interfaces;

use App\Http\Requests\Request;
use App\Http\Responses\Interfaces\IResponse;

interface IMessage
{
    public static function send(Request $request, IResponse $response);
}