<?php 

namespace App\Services;

class MyService{

    public function __construct($param, $adminEmail, $globalParam){
        dump("im from myService");
        dump($param);
        dump($adminEmail);
        dump($globalParam);
    }


}