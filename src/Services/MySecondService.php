<?php 

namespace App\Services;

class MySecondService{

    public function __construct(){
        dump("im from My 2nd Service");
    }

    public function someMethod(){
        dump("Hello!!");
    }
    public function otherMethod(){
        dump("HEllo from other method");
    }


}
