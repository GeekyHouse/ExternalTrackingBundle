<?php

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IndexController extends Controller
{

    /**
     * @Template("@test_views/index.html.twig")
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }

    public function indexResponseAction($name)
    {
        return $this->render("@test_views/index.html.twig", array(
            'name' => $name
        ));
    }

}
