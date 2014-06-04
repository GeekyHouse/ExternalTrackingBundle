<?php

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\Service;

use GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager;

class TestTracker
{

    private $ExternalTrackingManager;

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

    public function myTracker1($event, $data = null)
    {
        return "Tracker 1";
    }

    public function myTracker2($event, $data = null)
    {
        return "Tracker 2";
    }

    public function myTracker3($event, $data = null)
    {
        return "Tracker 3";
    }

}