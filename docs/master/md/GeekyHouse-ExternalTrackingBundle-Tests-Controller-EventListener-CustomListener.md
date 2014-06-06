GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener
===============

Demo tracker manager

A demo class to show how to use the tracker manager


* Class name: CustomListener
* Namespace: GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener
* This class implements: Symfony\Component\EventDispatcher\EventSubscriberInterface






Methods
-------


### \GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::__construct()

```
\GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::\GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::__construct()()
```

Constructor
Does nothing but it's here. Yeah, really.



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::beforeGetTrackers()

```
mixed GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::\GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::beforeGetTrackers()(\GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent $event)
```

Add some tracking datas when 'geekyhouse.event.before_get_trackers' is dispatched



* Visibility: **public**

#### Arguments

* $event **[GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent](GeekyHouse-ExternalTrackingBundle-Event-ExternalTrackingEvent.md)** - &lt;p&gt;An ExternalTrackingEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::afterGetTrackers()

```
mixed GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::\GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::afterGetTrackers()(\GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent $event)
```

Add some tracking datas when 'geekyhouse.event.after_get_trackers' is dispatched



* Visibility: **public**

#### Arguments

* $event **[GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent](GeekyHouse-ExternalTrackingBundle-Event-ExternalTrackingEvent.md)** - &lt;p&gt;An ExternalTrackingEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::getSubscribedEvents()

```
array GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::\GeekyHouse\ExternalTrackingBundle\Tests\Controller\EventListener\CustomListener::getSubscribedEvents()()
```

Returns an array of event names this subscriber wants to listen to.

The array keys are event names and the value can be:

* The method name to call (priority defaults to 0)
* An array composed of the method name to call and the priority
* An array of arrays composed of the method names to call and respective
priorities, or 0 if unset

For instance:

* array('eventName' => 'methodName')
* array('eventName' => array('methodName', $priority))
* array('eventName' => array(array('methodName1', $priority), array('methodName2'))

* Visibility: **public**
* This method is **static**.


