<?php 

namespace App\Services;
use App\Services\MySecondService;
class MyService{
    
    public function __construct($one){

        dump("Hello from MyService!");
        dump($one);

    }

}    

