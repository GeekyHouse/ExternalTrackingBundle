ExternalTrackingBundle
=============

Symfony2 bundle for manage external tracking scripts/pixel trackers.

[![Build Status](https://travis-ci.org/GeekyHouse/ExternalTrackingBundle.png?branch=master)](https://travis-ci.org/GeekyHouse/ExternalTrackingBundle) [![Latest Stable Version](https://poser.pugx.org/geekyhouse/external-tracking-bundle/v/stable.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![Total Downloads](https://poser.pugx.org/geekyhouse/external-tracking-bundle/downloads.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![Latest Unstable Version](https://poser.pugx.org/geekyhouse/external-tracking-bundle/v/unstable.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![License](https://poser.pugx.org/geekyhouse/external-tracking-bundle/license.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![Dependency Status](https://www.versioneye.com/php/geekyhouse:external-tracking-bundle/dev-master/badge.svg)](https://www.versioneye.com/php/geekyhouse:external-tracking-bundle/dev-master)

[![knpbundles.com](http://knpbundles.com/GeekyHouse/ExternalTrackingBundle/badge-short)](http://knpbundles.com/GeekyHouse/ExternalTrackingBundle)

Introduction
============

This bundle allows you to manage pixeltrackers / script trackers your partners without interfering with user navigation :

* Trackers can be managed from one or more classes, and are added via an event handler. 
* The display of trackers can be pushed after the page loads, or even with a timer
* No more dependence to any JavaScript framework ;)

Installation
============

### Composer

Add to `composer.json` in your project to `require` section:

````
...
    {
        "geekyhouse/external-tracking-bundle": "dev-master"
    }
...
````

Run command:
`php composer.phar install`

### Add this bundle to your application's kernel
``` php
//app/AppKernel.php
public function registerBundles()
{
    return array(
         // ...
        new GeekyHouse\ExternalTrackingBundle\ExternalTrackingBundle(),
        // ...
    );
}
```

### Conﬁgure service in your YAML conﬁguration
You can overwrite bundle classes. Default values :
````
# app/conﬁg/conﬁg.yml
external_tracking:
	manager_class: GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager
	request_listener_class: GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener
	extension_class: GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension
````

### Custom events listeners
This bundle provides 2 events dispatchers that you can use :
* `geekyhouse.event.before_get_trackers` : Called first when "getTrackers" is called
* `geekyhouse.event.after_get_trackers` : Called juste before return when "getTrackers" is called

You can easily create a custom service which add datas just before writing trackers, like this :
````
# app/conﬁg/conﬁg.yml
services:
    my.custom.listener:
        class: My\Bundle\EventListener\CustomListener
        tags:
            - { name: kernel.event_listener, event: geekyhouse.event.before_get_trackers, method: beforeGetTrackers }
            - { name: kernel.event_listener, event: geekyhouse.event.after_get_trackers, method: afterGetTrackers }
        arguments: [@service_container]
````
````
// My/Bundle/EventListener/CustomListener.php
namespace My\Bundle\EventListener;

use GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent;

class CustomListener
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function beforeGetTrackers(ExternalTrackingEvent $event)
    {
        $UserManager = $this->container->get('my.user.manager');
        $this->ExternalTrackingManager->pushData(
            array(
                'user' => $UserManager->getCurrentUser()
            )
        );
    }

    public function afterGetTrackers(ExternalTrackingEvent $event)
    {
    }

}
````
In this example, we just add custom user datas on ExternalTrackingManager systematically.
