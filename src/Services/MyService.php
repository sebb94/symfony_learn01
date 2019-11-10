<?php 

namespace App\Services;
use App\Services\MySecondService;
class MyService{

    use OptionalServiceTrait;
    public function __construct(){
       
    }
    public function someAction(){
        dump($this->service->doSomething2());
    }
}