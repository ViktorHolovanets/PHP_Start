<?php

namespace App\Http\Responses;

class HtmlResponse extends AbstractResponse
{
    private function renderHead(): string
    {
        return "
        <head>
            <title> My first site </title>
        </head>";
    }

    private function renderHeader(): string
    {
        return "
        <header>
            <h1>My first site</h1>
        </header>
        ";
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