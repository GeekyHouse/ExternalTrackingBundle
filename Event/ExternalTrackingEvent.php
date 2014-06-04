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
 * External tracking manager
 *
 * This class manage datas sent with an EventDispatcher
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Component\EventDispatcher\Event
 * @uses    GeekyHouse\ExternalTrackingBundle\ExternalTrackingManager
 */
class ExternalTrackingEvent extends Event
{

    protected $ExternalTrackingManager = null;

    public function __construct(ExternalTrackingManager $ExternalTrackingManager)
    {
        $this->ExternalTrackingManager = $ExternalTrackingManager;
    }

    public function getExternalTrackingManager()
    {
        return $this->ExternalTrackingManager;
    }

}