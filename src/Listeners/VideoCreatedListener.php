<?php
namespace App\Listeners;

class VideoCreatedListener{

    public function onVidCreatedEvent($event){
        dump($event->video->title);    
    }

}