<?php 

namespace App\Services;
use App\Services\MySecondService;

class MyService implements ServiceInterface {
    
    public function __construct(){
        dump("Hello from MyService!");
    }
 
}    

