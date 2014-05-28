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

/**
 * External tracking manager
 *
 * This class manage a trackers list linked to events.
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Component\HttpFoundation\Session\Session
 */
class ExternalTrackingManager
{

    /**
     * @var Session $Session, A Session instance
     */
    private $Session;

    /**
     * @var array $trackersCollection, The list of trackers registered
     */
    private $trackersCollection = array();

    /**
     * @var string $defaultEvent, The default event used for tracking
     */
    private $defaultEvent;

    /**
     * @var string $event, The event used for tracking
     */
    private $event;

    /**
     * @var string $data, The datas available for tracking
     */
    private $data;

    /**
     * @var string SESSION_TRACKER_PREFIX, The session key to store trackers
     */
    const SESSION_TRACKER_PREFIX = '_external_trackers';

    /**
     * Constructor
     * Store some variables on the current instance
     *
     * @param  Session $Session,            A Session instance
     * @return ExternalTrackingManager
     */
    public function __construct(Session $Session)
    {
        $this->Session = $Session;
        $this->data    = array();
    }

    /**
     * This methods store an array of methods for an event
     * 
     * @param  string $event,   The event targeted
     * @param  array  $methods, The methods to invoke. Each method must have a label (= tracker name).
     * @return ExternalTrackingManager
     */
    public function registerEvent($event, array $methods)
    {
        if(!isset($this->trackersCollection[$event]) || !is_array($this->trackersCollection[$event])) {
            $this->trackersCollection[$event] = array();
        }
        $this->trackersCollection[$event] = array_merge($this->trackersCollection[$event], $methods);

        return $this;
    }

    /**
     * Set the default event
     *
     * @param  string $event,                  The default event to set
     * @param  boolean $force (default=false), Overwrite the default event if TRUE
     * @return ExternalTrackingManager
     */
    public function setDefaultEvent($event, $force = false)
    {
        if(!$this->defaultEvent || $force) {
            $this->defaultEvent = $event;
        }

        return $this;
    }

    /**
     * Set the current event
     *
     * @param  string  $event,                The event to set
     * @param  boolean $force (default=true), Overwrite the current event if TRUE
     * @return ExternalTrackingManager
     */
    public function setEvent($event, $force = true)
    {
        if(empty($this->event) || $force == true) {
            $this->event = $event;
        }

        return $this;
    }

    /**
     * This method returns the current event used
     *
     * @return string
     */
    public function getEvent()
    {
        return !empty($this->event) ? $this->event : $this->defaultEvent;
    }

    /**
     * This method allows to add data on current instance.
     *
     * @param  array $data,           The datas to insert
     * @param  force (default=false), Overwrite current datas if TRUE
     * @return ExternalTrackingManager
     */
    public function pushData(array $data, $force = false)
    {
        if($force) {
            $this->data = array_merge($this->data, $data);
        } else {
            $this->data = array_merge($data, $this->data);
        }

        return $this;
    }

    /**
     * This method returns the current datas
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * This method adds available trackers in session
     *
     * @return ExternalTrackingManager
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
     * @return array
     */
    public function getSessionTrackers()
    {
        $trackers = $this->Session->get(self::SESSION_TRACKER_PREFIX);
        if(!$trackers) {
            $trackers = array();
        }

        return $trackers;
    }

    /**
     * This method removes trackers from session
     *
     * @return ExternalTrackingManager
     */
    public function removeSessionTrackers()
    {
        $this->Session->set(self::SESSION_TRACKER_PREFIX, array());

        return $this;
    }

    /**
     * This method returns a string with all trackers available for writing.
     *
     * @return string
     */
    public function getTrackersHTML()
    {
        $return = '';

        $currentTrackers = $this->getTrackers();

        foreach($currentTrackers as $event => $trackers) {
            foreach($trackers as $htmlTracker) {
                $return .= $htmlTracker;
            }
        }

        return $return;
    }

    /**
     * This returns all methods registered for an event
     *
     * @param  string $event, The event called
     * @return array
     */
    protected function getMethodsListByEvent($event)
    {
        foreach($this->trackersCollection as $evt => $methods) {
            if($evt == $event) {
                return $methods;
            }
        }

        return array();
    }

    /**
     * Returns an array of trackers with their methods.
     *
     * @param  string $event, The event sended
     * @return array
     */
    protected function getTrackersByEvent($event)
    {
        $methodsList = $this->getMethodsListByEvent($event);

        $trackers    = array();

        foreach($methodsList as $method) {
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
     * @return array
     */
    protected function getTrackers()
    {
        // Get trackers already in session
        $trackers = $this->getSessionTrackers();
        if(!$trackers) {
            $trackers = array();
        }

        // Get trackers for current event
        $trackers = $this->mergeTrackersByEvent($this->getEvent(), $trackers);

        // Get trackers for "all" event
        $trackers = $this->mergeTrackersByEvent('all', $trackers);

        return $trackers;
    }

    /**
     * This method is an array_merge-like for array of trackers
     *
     * @param  string $event,           The event sended
     * @param  array  $currentTrackers, The current trackers list to merge in
     * @return array
     */
    private function mergeTrackersByEvent($event, array $currentTrackers)
    {
        $tmpTrackers = $this->getTrackersByEvent($event);

        foreach($tmpTrackers as $htmlTracker) {
            if(
                   !array_key_exists($event, $currentTrackers) 
                || !in_array($htmlTracker, $currentTrackers[$event])
            ) {
                $currentTrackers[$event][] = $htmlTracker;
            }
        }

        return $currentTrackers;
    }

    /***************************************************************************
    * Here begins the list of trackers' behaviors                              *
    ****************************************************************************
    * The method names must start with "_tracker_" and must be                 *
    * followed by the name of the tracker                                      *
    * The method must have a $event argument in first position                 *
    * The method must have a $datas argument in second position                *
    * i.e.: for "groupon" tracker, method should be                            *
    * "_tracker_groupon($event, $datas)"                                       *
    ***************************************************************************/

    /**
     * Tracker for AD4SCREEN
     * Related task(s) : #7857
     */
    private function _tracker_ad4screen($event, $datas)
    {
        $output  = '';
        $methods = '';
        if(
               $this->event != 'wengo_mobile_front_bundle_expertsheetrating' 
            && $this->event != 'wengo_mobile_front_bundle_expertsheetavailability'
            && $this->event != 'wengo_mobile_front_bundle_status'
            && $this->datas['device'] == 'mobile'
            && $this->datas['locale'] == 'fr_fr' 
            && $this->datas['directoryKeyid'] == '1270'
        ) {
            $methods = '_a4s.push([\'_trackPageView\']);';
        }

        switch($event) {
            case 'wengo_mobile_front_bundle_expertsheetcallstep3':
                if(
                       $this->datas['device'] == 'mobile'
                    && $this->datas['locale'] == 'fr_fr' 
                    && $this->datas['directoryKeyid'] == '1270'
                ) {
                    $methods .= '_a4s.push([\'_trackPurchase\', \''.uniqid('', true).'\', \'euros\', 45]);';
                }
            break;
        }
        if(!empty($methods)) {
                    $output = '
                    <!-- Inclusion du SDK -->
                    <script type="text/javascript">
                        var _a4s = _a4s || [];
                        _a4s.push([\'_setPartnerId\', \'wengo80de7ba7e9b650a\']);
                        '.$methods.'
                        (function(){
                            var a = document.createElement("script"); a.type = "text/javascript"; a.async = true;
                                a.src = document.location.protocol + "//www.ad4push.com/js/sdk-insite-uncompressed.js";
                            var s = document.getElementsByTagName("script")[0];
                                s.parentNode.insertBefore(a, s);
                        })();
                    </script>
                    <!-- /fin Inclusion du SDK -->
                    ';
        }

        return $output;
    }

}