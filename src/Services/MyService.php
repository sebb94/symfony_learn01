<?php 

namespace App\Services;
use App\Services\MySecondService;
use Doctrine\ORM\Event\PostFlushEventArgs;
class MyService{
    
    public function __construct(){
        dump("Hello from MyService!");
    }
    public function postFlush(PostFlushEventArgs $args){
        dump("Post flush");
        dump($args);
    }
    public function clear(){
        dump("Clear...");
    }
}    

