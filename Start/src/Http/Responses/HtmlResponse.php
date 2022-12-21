<?php

namespace App\Http\Responses;
use App\Controllers\ViewData\ViewData;

class HtmlResponse extends AbstractResponse
{
    private array $dataview;
    function __construct(){
        $this->dataview=ViewData::getInstance()->viewdata;
    }

    private function renderHead(): string
    {
        return "
        <head>
            <title></title>
        </head>";
        return sprintf("
        <head>
            <title>%s</title>
        </head>
        ", $this->dataview['title']);

    }

    private function renderHeader(): string
    {
        return sprintf("
        <header>
            <h1>%s</h1>
        </header>
        ", $this->dataview['header']);
    }

    private  function renderMain(): string
    {
        return "<body><main>"
            . $this->data['htmlBodyMain']
            . "</main></body>";
    }


    public function render(): string
    {
        return
            "<html lang='uk'>"
            . $this->renderHead()
            . $this->renderHeader()
            . $this->renderMain()
            . "</html>";
    }
}