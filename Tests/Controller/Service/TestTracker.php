<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\Service;

use GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager;

/**
 * Demo tracker manager
 * 
 * A demo class to show how to use the tracker manager
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager ExternalTrackingManager
 */
class TestTracker
{

    /**
     * @var ExternalTrackingManager $ExternalTrackingManager An ExternalTrackingManager instance
     */
    private $ExternalTrackingManager;

    /**
     * Constructor
     * Store some variables on the current instance
     * Register some trackers by event
     *
     * @param ExternalTrackingManager $ExternalTrackingManager A ExternalTrackingManager instance
     *
     * @return TestTracker An TestTracker instance
     */
    public function __construct(ExternalTrackingManager $ExternalTrackingManager)
    {
        $this->ExternalTrackingManager = $ExternalTrackingManager;

        $this->ExternalTrackingManager->registerEvent('external_tracking_indexresponse', array(
            array($this, 'myTracker1'),
            array($this, 'myTracker2'),
        ));

        $this->ExternalTrackingManager->registerEvent('test_event', array(
            array($this, 'myTracker1'),
            array($this, 'myTracker3'),
        ));
    }

    /**
     * Demo tracker 1
     * 
     * @param string $event The current event when called
     * @param array  $data  The availables datas when called
     * 
     * @return string The tracker
     */
    public function myTracker1($event, $data = null)
    {
        return "Tracker 1";
    }

    /**
     * Demo tracker 2
     * 
     * @param string $event The current event when called
     * @param array  $data  The availables datas when called
     * 
     * @return string The tracker
     */
    public function myTracker2($event, $data = null)
    {
        return "Tracker 2";
    }

    /**
     * Demo tracker 3
     * 
     * @param string $event The current event when called
     * @param array  $data  The availables datas when called
     * 
     * @return string The tracker
     */
    public function myTracker3($event, $data = null)
    {
        return "Tracker 3";
    }

}