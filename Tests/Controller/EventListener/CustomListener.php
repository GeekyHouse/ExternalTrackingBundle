<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener;

use GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Demo tracker manager
 *
 * A demo class to show how to use the tracker manager
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent ExternalTrackingEvent
 * @uses    Symfony\Component\EventDispatcher\EventSubscriberInterface    EventSubscriberInterface
 */
class CustomListener implements EventSubscriberInterface
{

    /**
     * Constructor
     * Does nothing but it's here. Yeah, really.
     *
     * @return CustomListener A CustomListener instance
     */
    public function __construct()
    {
    }

    /**
     * Add some tracking datas when 'geekyhouse.event.before_get_trackers' is dispatched
     *
     * @param ExternalTrackingEvent $event An ExternalTrackingEvent instance
     */
    public function beforeGetTrackers(ExternalTrackingEvent $event)
    {
        $event->getExternalTrackingManager()->pushData(array(
            'event_before' => 'success'
        ));
    }

    /**
     * Add some tracking datas when 'geekyhouse.event.after_get_trackers' is dispatched
     *
     * @param ExternalTrackingEvent $event An ExternalTrackingEvent instance
     */
    public function afterGetTrackers(ExternalTrackingEvent $event)
    {
        $event->getExternalTrackingManager()->pushData(array(
            'event_after' => 'success'
        ));
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     * The array keys are event names and the value can be:
     *
     * * The method name to call (priority defaults to 0)
     * * An array composed of the method name to call and the priority
     * * An array of arrays composed of the method names to call and respective
     * priorities, or 0 if unset
     *
     * For instance:
     *
     * * array('eventName' => 'methodName')
     * * array('eventName' => array('methodName', $priority))
     * * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            'geekyhouse.event.before_get_trackers'  => 'beforeGetTrackers',
            'geekyhouse.event.after_get_trackers'   => 'afterGetTrackers',
        );
    }

}
