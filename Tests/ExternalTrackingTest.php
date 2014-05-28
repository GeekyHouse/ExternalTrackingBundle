<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * ExternalTrackingTest
 *
 * This class tests ExternalTrackingBundle features
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Bundle\FrameworkBundle\Test\WebTestCase
 */
class ExternalTrackingTest extends WebTestCase
{

    private $client;

    /**
     * @Test
     */
    public function testDefaultEvent()
    {
        $this->initClient();

        $ExternalTrackingManager = $this->client->getContainer()->get('external_tracking.manager');

        $ExternalTrackingManager->setDefaultEvent('test_event1');
        $this->assertEquals('test_event1', $ExternalTrackingManager->getEvent());

        $ExternalTrackingManager->setDefaultEvent('test_event2', true);
        $this->assertEquals('test_event2', $ExternalTrackingManager->getEvent());

        $crawler = $this->client->request('GET', '/DamienJarry');
        $this->assertEquals('test_event2', $ExternalTrackingManager->getEvent());
    }

    /**
     * @Test
     */
    public function testEvent()
    {
        $this->initClient();

        $ExternalTrackingManager = $this->client->getContainer()->get('external_tracking.manager');

        $crawler = $this->client->request('GET', '/DamienJarry');
        $this->assertEquals('external_tracking_index', $ExternalTrackingManager->getEvent());

        $ExternalTrackingManager->setEvent('test_event');
        $crawler = $this->client->request('GET', '/DamienJarry');
        $this->assertEquals('test_event', $ExternalTrackingManager->getEvent());
    }

    /**
     * @Test
     */
    public function testDefaultData()
    {
        $this->initClient();

        $ExternalTrackingManager = $this->client->getContainer()->get('external_tracking.manager');
        $this->assertEquals(0, sizeof($ExternalTrackingManager->getData()));

        $crawler = $this->client->request('GET', '/DamienJarry');
        $this->assertEquals(1, sizeof($ExternalTrackingManager->getData()));

        $data = $ExternalTrackingManager->getData();
        $this->assertEquals('DamienJarry', $data['name']);
    }

    /**
     * @Test
     */
    public function testData()
    {
        $this->initClient();

        $ExternalTrackingManager = $this->client->getContainer()->get('external_tracking.manager');
        $this->assertEquals(0, sizeof($ExternalTrackingManager->getData()));

        $ExternalTrackingManager->pushData(array('home' => 'France'));
        $this->assertEquals(1, sizeof($ExternalTrackingManager->getData()));

        $ExternalTrackingManager->pushData(array('home' => 'Paris'));
        $this->assertEquals(1, sizeof($ExternalTrackingManager->getData()));

        $data = $ExternalTrackingManager->getData();
        $this->assertEquals('France', $data['home']);

        $ExternalTrackingManager->pushData(array('home' => 'Paris'), true);
        $this->assertEquals(1, sizeof($ExternalTrackingManager->getData()));

        $data = $ExternalTrackingManager->getData();
        $this->assertEquals('Paris', $data['home']);

        $crawler = $this->client->request('GET', '/DamienJarry');
        $this->assertEquals(2, sizeof($ExternalTrackingManager->getData()));

        $data = $ExternalTrackingManager->getData();
        $this->assertEquals('DamienJarry', $data['name']);
    }

    /**
     * @Test
     */
    public function testTracker()
    {
        $this->initClient();

        $crawler = $this->client->request('GET', '/response/DamienJarry');
        $this->assertEquals(1, $crawler->filter('html:contains("Tracker 1")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Tracker 2")')->count());

        $this->initClient();

        $ExternalTrackingManager = $this->client->getContainer()->get('external_tracking.manager');
        $ExternalTrackingManager->setEvent('test_event');
        $crawler = $this->client->request('GET', '/response/DamienJarry');
        $this->assertEquals(1, $crawler->filter('html:contains("Tracker 1")')->count());
        $this->assertEquals(1, $crawler->filter('html:contains("Tracker 3")')->count());
    }

    public function setUp()
    {
        parent::setUp();

        $this->initClient();
    }

    private function initClient()
    {
        $this->client = $this->createClient();
        $this->client->getContainer()->get('externaltracking.testtracker');
    }

}
