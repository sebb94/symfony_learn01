<?php 

namespace App\Services;
use Psr\Log\LoggerInterface;

class RandomNum{

    public $numbers = [50,25,32];

    public function __construct(LoggerInterface $logger){
        $logger->info('Numbers are ranomize');
        shuffle($this->numbers);
    }

}