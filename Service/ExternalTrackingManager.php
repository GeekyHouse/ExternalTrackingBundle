<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Service;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent;

/**
 * External tracking manager
 *
 * This class manage a trackers list linked to events.
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Component\HttpFoundation\Session\Session              Session
 * @uses    Symfony\Component\EventDispatcher\EventDispatcherInterface    EventDispatcherInterface
 * @uses    GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent ExternalTrackingEvent
 */
class ExternalTrackingManager
{

    /**
     * @var Session $Session A Session instance
     */
    private $Session;

    /**
     * @var EventDispatcherInterface $EventDispatcherInterface An EventDispatcherInterface instance
     */
    private $EventDispatcherInterface;

    /**
     * @var array $trackersCollection The list of trackers registered
     */
    private $trackersCollection = array();

    /**
     * @var string $defaultEvent The default event used for tracking
     */
    private $defaultEvent;

    /**
     * @var string $event The event used for tracking
     */
    private $event;

    /**
     * @var string $data The datas available for tracking
     */
    private $data;

    /**
     * @var string SESSION_TRACKER_PREFIX The session key to store trackers
     */
    const SESSION_TRACKER_PREFIX = '_external_trackers';

    /**
     * Constructor
     * Store some variables on the current instance
     *
     * @param Session $Session                  A Session instance
     * @param Session $EventDispatcherInterface An EventDispatcherInterface instance
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function __construct(Session $Session, EventDispatcherInterface $EventDispatcherInterface)
    {
        $this->Session                  = $Session;
        $this->EventDispatcherInterface = $EventDispatcherInterface;
        $this->data                     = array();
    }

    /**
     * This methods store an array of methods for an event
     *
     * @param string $event   The event targeted
     * @param array  $methods The methods to invoke
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function registerEvent($event, array $methods)
    {
        if (!isset($this->trackersCollection[$event]) || !is_array($this->trackersCollection[$event])) {
            $this->trackersCollection[$event] = array();
        }
        $this->trackersCollection[$event] = array_merge($this->trackersCollection[$event], $methods);

        return $this;
    }

    /**
     * Set the default event
     *
     * @param string  $event The default event to set
     * @param boolean $force Overwrite the default event if TRUE
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function setDefaultEvent($event, $force = false)
    {
        if (!$this->defaultEvent || $force) {
            $this->defaultEvent = $event;
        }

        return $this;
    }

    /**
     * Set the current event
     *
     * @param string  $event The event to set
     * @param boolean $force Overwrite the current event if TRUE
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function setEvent($event, $force = true)
    {
        if (empty($this->event) || $force == true) {
            $this->event = $event;
        }

        return $this;
    }

    /**
     * This method returns the current event used
     *
     * @return string The current event
     */
    public function getEvent()
    {
        return !empty($this->event) ? $this->event : $this->defaultEvent;
    }

    /**
     * This method allows to add data on current instance.
     *
     * @param array   $data  The datas to insert
     * @param boolean $force Overwrite current datas if TRUE
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function pushData(array $data, $force = false)
    {
        if ($force) {
            $this->data = array_merge($this->data, $data);
        } else {
            $this->data = array_merge($data, $this->data);
        }

        return $this;
    }

    /**
     * This method returns the current datas
     *
     * @return array The datas stored in current instance
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * This method adds available trackers in session
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function setSessionTrackers()
    {
        $trackers = $this->getTrackers();
        $this->Session->set(self::SESSION_TRACKER_PREFIX, $trackers);

        return $this;
    }

    /**
     * This method returns trackers from session
     *
     * @return array The list of trackers in session
     */
    public function getSessionTrackers()
    {
        $trackers = $this->Session->get(self::SESSION_TRACKER_PREFIX);
        if (!$trackers) {
            $trackers = array();
        }

        return $trackers;
    }

    /**
     * This method removes trackers from session
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function removeSessionTrackers()
    {
        $this->Session->set(self::SESSION_TRACKER_PREFIX, array());

        return $this;
    }

    /**
     * This method returns a string with all trackers available for writing.
     *
     * @return string The trackers ready to be used on template
     */
    public function getTrackersHTML()
    {
        $return = '';

        $currentTrackers = $this->getTrackers();

        foreach ($currentTrackers as $event => $trackers) {
            foreach ($trackers as $htmlTracker) {
                $return .= $htmlTracker;
            }
        }

        return $return;
    }

    /**
     * This returns all methods registered for an event
     *
     * @param string $event The event called
     *
     * @return array The list of methods that have to be called to get trackers
     */
    protected function getMethodsListByEvent($event)
    {
        foreach ($this->trackersCollection as $evt => $methods) {
            if ($evt == $event) {
                return $methods;
            }
        }

        return array();
    }

    /**
     * Returns an array of trackers with their methods.
     *
     * @param string $event The event sended
     *
     * @return array The list of trackers (HTML version) for an event that can be used on a template
     */
    protected function getTrackersByEvent($event)
    {
        $methodsList = $this->getMethodsListByEvent($event);
        if($event == 'all') $event = $this->getEvent();

        $trackers    = array();

        foreach ($methodsList as $method) {
            $htmlTracker = call_user_func(
                $method,
                $event,
                $this->data
            );
            if(
                    gettype($htmlTracker) === 'string'
                && !empty($htmlTracker)
            ) {
                array_push($trackers, $htmlTracker);
            }
        }

        return $trackers;
    }

    /**
     * This method returns an array with all trackers available for writing
     *
     * @return array The complete list of trackers that can be used on a template
     */
    protected function getTrackers()
    {
        // Throw an event before
        $event = new ExternalTrackingEvent($this);
        $this->EventDispatcherInterface->dispatch('geekyhouse.event.before_get_trackers', $event);

        // Get trackers already in session
        $trackers = $this->getSessionTrackers();
        if (!$trackers) {
            $trackers = array();
        }

        // Get trackers for current event
        $trackers = $this->mergeTrackersByEvent($this->getEvent(), $trackers);

        // Get trackers for "all" event
        $trackers = $this->mergeTrackersByEvent('all', $trackers);

        // Throw an event after
        $event = new ExternalTrackingEvent($this);
        $this->EventDispatcherInterface->dispatch('geekyhouse.event.after_get_trackers', $event);

        return $trackers;
    }

    /**
     * This method is an array_merge-like for array of trackers
     *
     * @param string $event           The event sended
     * @param array  $currentTrackers The current trackers list to merge in
     *
     * @return array The list of unique trackers for an event
     */
    private function mergeTrackersByEvent($event, array $currentTrackers)
    {
        $tmpTrackers = $this->getTrackersByEvent($event);

        foreach ($tmpTrackers as $htmlTracker) {
            if(
                   !array_key_exists($event, $currentTrackers)
                || !in_array($htmlTracker, $currentTrackers[$event])
            ) {
                $currentTrackers[$event][] = $htmlTracker;
            }
        }

        return $currentTrackers;
    }

}
