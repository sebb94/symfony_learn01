<?php 

namespace App\Services;
use App\Services\MySecondService;
class MyService{
    
    public function __construct($service){
        dump($service);
        $this->secService = $service;
    }

}    

