<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Index controller
 *
 * A demo controller for unit test
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    Symfony\Bundle\FrameworkBundle\Controller\Controller      Controller
 * @uses    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template Template
 */
class IndexController extends Controller
{

    /**
     * Controller for index action
     *
     * @Template("@test_views/index.html.twig")
     *
     * @param string $name A name to show on the page
     *
     * @return array An array of variables
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    /**
     * Controller for indexResponse action
     *
     * @param string $name A name to show on the page
     *
     * @return Response A Response instance
     */
    public function indexResponseAction($name)
    {
        return $this->render("@test_views/index.html.twig", array(
            'name' => $name
        ));
    }

}
