<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\EventListener;

use GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * RequestListener
 *
 * This class set custom actions on events listeners
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager      ExternalTrackingManager
 * @uses    Symfony\Component\HttpKernel\Event\GetResponseEvent                    GetResponseEvent
 * @uses    Symfony\Component\HttpKernel\Event\FilterControllerEvent               FilterControllerEvent
 * @uses    Symfony\Component\HttpKernel\Event\FilterResponseEvent                 FilterResponseEvent
 * @uses    Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent GetResponseForControllerResultEvent
 */
class RequestListener implements EventSubscriberInterface
{

    /**
     * @var ExternalTrackingManager $ExternalTrackingManager An ExternalTrackingManager instance
     */
    private $ExternalTrackingManager;

    /**
     * Constructor
     * Store some variables on the current instance
     *
     * @param ExternalTrackingManager $ExternalTrackingManager A ExternalTrackingManager instance
     *
     * @return RequestListener A RequestListener instance
     */
    public function __construct(ExternalTrackingManager $ExternalTrackingManager)
    {
        $this->ExternalTrackingManager = $ExternalTrackingManager;
    }

    /**
     * Allows to create a response for a request
     * Call setResponse() to set the response that will be returned for the current request.
     * The propagation of this event is stopped as soon as a response is set.
     *
     * @param GetResponseEvent $event A GetResponseEvent instance
     */
    public function onKernelRequest(GetResponseEvent $event)
    {

    }

    /**
     * Allows filtering of a controller callable
     * You can call getController() to retrieve the current controller.
     * With setController() you can set a new controller that is used in the processing of the request.
     * Controllers should be callables.
     *
     * @param FilterControllerEvent $event A FilterControllerEvent instance
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        // Inject a default tracking event
        $this->ExternalTrackingManager->setDefaultEvent($event->getRequest()->get('_route'));
    }

    /**
     * Allows to create a response for the return value of a controller
     * Call setResponse() to set the response that will be returned for the current request.
     * The propagation of this event is stopped as soon as a response is set.
     *
     * @param GetResponseForControllerResultEvent $event A GetResponseForControllerResultEvent instance
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        // Inject all templates datas in global twig variable
        // /!\ Beware of PHP memory.
        $controllerResult = $event->getControllerResult();
        if(!is_array($controllerResult)) {
            $controllerResult = array($controllerResult);
        }
        $this->ExternalTrackingManager->pushData($event->getControllerResult());

        // Inject a default tracking event
        $this->ExternalTrackingManager->setDefaultEvent($event->getRequest()->get('_route'));

        // Here you can extend this method to add some default datas on ExternalTrackingManager

        // Set available trackers in session
        $this->ExternalTrackingManager->setSessionTrackers();
    }

    /**
     * Allows to filter a Response object
     * You can call getResponse() to retrieve the current response.
     * With setResponse() you can set a new response that will be returned to the browser.
     *
     * @param FilterResponseEvent $event A FilterResponseEvent instance
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        // Inject a default tracking event
        $this->ExternalTrackingManager->setDefaultEvent($event->getRequest()->get('_route'));
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
            KernelEvents::VIEW => 'onKernelView',
        );
    }

}
