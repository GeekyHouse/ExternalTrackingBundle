<?php

namespace GeekyHouse\ExternalTrackingBundle\Tests\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{

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
