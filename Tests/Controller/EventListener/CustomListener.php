<?php

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener;

use GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CustomListener implements EventSubscriberInterface 
{

    public function __construct()
    {
    }

    public function beforeGetTrackers(ExternalTrackingEvent $event)
    {
        $event->getExternalTrackingManager()->pushData(array(
            'event_before' => 'success'
        ));
    }

    public function afterGetTrackers(ExternalTrackingEvent $event)
    {
        $event->getExternalTrackingManager()->pushData(array(
            'event_after' => 'success'
        ));
    }

    public static function getSubscribedEvents()
    {
        return array(
            'geekyhouse.event.before_get_trackers'  => 'beforeGetTrackers',
            'geekyhouse.event.after_get_trackers'   => 'afterGetTrackers',
        );
    }

}
