<?php 

namespace App\Services;

class MySecondService{

    public function __construct(){
        dump("im from My 2nd Service");
    }
    public function doSomething(){
        //
    }
    public function doSomething2(){
        return "WOW!";
    }


}
