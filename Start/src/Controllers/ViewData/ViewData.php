<?php

namespace App\Controllers\ViewData;

class ViewData
{
    public array $viewdata=[];
    private static ?ViewData $instance=null;
    private function __construct(){
        $this->viewdata['title']='Document';
        $this->viewdata['header']='My first site';
    }
    public static function getInstance(): ViewData{
        if(is_null(self::$instance)){
            self::$instance=new ViewData();
        }
        return self::$instance;
    }

}