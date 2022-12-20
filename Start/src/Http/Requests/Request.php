<?php

namespace App\Http\Requests;

class Request
{
 private static ?Request $instance=null;
 private function __construct(){
     echo "Create singleton";
 }
 public static function getInstance(): Request{
     if(is_null(self::$instance)){
         self::$instance=new Request();
     }
     return self::$instance;
}
public function input($name):mixed{
     $val=null;
     if(isset($_GET[$name])){
         $val=$_GET[$name];
     }
     else if(isset($_POST[$name])){
         $val=$_POST[$name];
     }
     if(is_null($val)) return null;
     $this->validator($val);
     return $val;
}
private  function validator($value):void{
     if($value=='SQL')
         die('Attack Detected');
}
}