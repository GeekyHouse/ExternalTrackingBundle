ExternalTrackingBundle
=============

Symfony2 bundle for manage external tracking scripts/pixel trackers.

[![Build Status](https://travis-ci.org/GeekyHouse/ExternalTrackingBundle.png?branch=master)](https://travis-ci.org/GeekyHouse/ExternalTrackingBundle) [![Latest Stable Version](https://poser.pugx.org/geekyhouse/external-tracking-bundle/v/stable.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![Total Downloads](https://poser.pugx.org/geekyhouse/external-tracking-bundle/downloads.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![Latest Unstable Version](https://poser.pugx.org/geekyhouse/external-tracking-bundle/v/unstable.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle) [![License](https://poser.pugx.org/geekyhouse/external-tracking-bundle/license.svg)](https://packagist.org/packages/geekyhouse/external-tracking-bundle)

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
````
#app/conﬁg/conﬁg.yml
external_tracking:
	manager_class: ~
	request_listener_class: ~
	extension_class: ~
````