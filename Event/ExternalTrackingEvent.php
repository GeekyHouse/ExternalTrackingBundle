<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager;

/**
 * External Tracking Event
 *
 * This class manage datas sent with an EventDispatcher
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Component\EventDispatcher\Event                   Event
 * @uses    GeekyHouse\ExternalTrackingBundle\ExternalTrackingManager ExternalTrackingManager
 */
class ExternalTrackingEvent extends Event
{

    /**
     * @var ExternalTrackingManager $ExternalTrackingManager An ExternalTrackingManager instance
     */
    protected $ExternalTrackingManager = null;

    /**
     * Constructor
     * Store some variables on the current instance
     *
     * @param ExternalTrackingManager $ExternalTrackingManager An ExternalTrackingManager instance
     *
     * @return ExternalTrackingEvent An ExternalTrackingEvent instance
     */
    public function __construct(ExternalTrackingManager $ExternalTrackingManager)
    {
        $this->ExternalTrackingManager = $ExternalTrackingManager;
    }

    /**
     * This method returns ExternalTrackingManager instance
     *
     * @return ExternalTrackingManager An ExternalTrackingManager instance
     */
    public function getExternalTrackingManager()
    {
        return $this->ExternalTrackingManager;
    }

}
