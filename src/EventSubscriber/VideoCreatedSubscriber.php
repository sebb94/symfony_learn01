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
    public function onKernelResponse(FilterResponseEvent $event){
        $response = new Response('43243324');
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            'video.created.event' => 'onVideoCreatedEvent',
            KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }
}
