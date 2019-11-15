<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        // ...
        dump($event->video->title);
    }
    public function onKernelResponse1(FilterResponseEvent $event){
        dump("Ważniejszy - prio 2");
    }
        public function onKernelResponse2(FilterResponseEvent $event){
        dump("Mniej wazny - prio 1");
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => [
                ['onKernelResponse1', 2],
                ['onKernelResponse2', 1],
            ]
        ];
    }
}
