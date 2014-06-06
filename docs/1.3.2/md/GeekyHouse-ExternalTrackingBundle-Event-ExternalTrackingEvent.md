GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent
===============

External Tracking Event

This class manage datas sent with an EventDispatcher


* Class name: ExternalTrackingEvent
* Namespace: GeekyHouse\ExternalTrackingBundle\Event
* Parent class: Symfony\Component\EventDispatcher\Event





Properties
----------


### $ExternalTrackingManager

```
protected \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager = null
```





* Visibility: **protected**


Methods
-------


### \GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::__construct()

```
\GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::\GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::__construct()(\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager)
```

Constructor
Store some variables on the current instance



* Visibility: **public**

#### Arguments

* $ExternalTrackingManager **[GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager](GeekyHouse-ExternalTrackingBundle-Service-ExternalTrackingManager.md)** - &lt;p&gt;An ExternalTrackingManager instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::getExternalTrackingManager()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::\GeekyHouse\ExternalTrackingBundle\Event\ExternalTrackingEvent::getExternalTrackingManager()()
```

This method returns ExternalTrackingManager instance



* Visibility: **public**


