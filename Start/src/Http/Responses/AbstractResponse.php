<?php

namespace App\Http\Responses;

use App\Http\Responses\Interfaces\IResponse;

abstract class AbstractResponse implements IResponse
{

    public array $data = [];

    private function __construct() {}

    private static ?IResponse $instance = null;

    public static function getInstance(?ResponseTypesEnum $type = null): IResponse
    {
        if(!is_null(self::$instance)) {
            return self::$instance;
        }



        switch ($type) {
            case ResponseTypesEnum::HTML:
                self::$instance = new HtmlResponse();
                break;
            case ResponseTypesEnum::JSON:
            case null:
                self::$instance = new JsonResponse();
                break;
        }
        return self::$instance;
    }
}
