<?php
/**
 * Точка входа в приложение
 * Именно с него начниается управление вашим веб приложением
 */

// Подключить настроки проекта
require_once '../vendor/autoload.php';

// Подключить необходимые классы
use App\Controllers\Http\DBController;
use App\Http\Requests\Request;
use App\Http\Responses\AbstractResponse;
use App\Http\Responses\ResponseTypesEnum;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();
var_dump($_ENV['APP_NAME']);


$users=DBController::getInstance()->getInfoCategoryIsNotInCartForUser();
if(!is_null($users))
    DBController::getInstance()->Show($users);


// Анализируем запрос - Request (POST, GET, COOKIE, FILES ...)
$request = Request::getInstance();

// Построение ответа (класс обертка куда я буду формировать ответ)
//$response = AbstractResponse::getInstance(ResponseTypesEnum::HTML);


// Необходимо понять - какому контроллеру передать управление
// Роутер

$mainController = new \App\Controllers\Http\FirstFormController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $response = AbstractResponse::getInstance(ResponseTypesEnum::HTML);
        $mainController->get($request, $response);
        break;
//    case 'POST':
//        $mainController->post($request, $response);
//        break;
    case 'POST':
    case 'PUT':
    case 'PATCH':
        $response = AbstractResponse::getInstance(ResponseTypesEnum::JSON);
        $mainController->put($request, $response);
    break;

}

echo $response->render();
