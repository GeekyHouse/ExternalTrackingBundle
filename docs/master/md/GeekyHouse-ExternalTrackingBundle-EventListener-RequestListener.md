GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener
===============

RequestListener

This class set custom actions on events listeners


* Class name: RequestListener
* Namespace: GeekyHouse\ExternalTrackingBundle\EventListener
* This class implements: Symfony\Component\EventDispatcher\EventSubscriberInterface




Properties
----------


### $ExternalTrackingManager

```
private \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager
```





* Visibility: **private**


Methods
-------


### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::__construct()

```
\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::__construct()(\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager)
```

Constructor
Store some variables on the current instance



* Visibility: **public**

#### Arguments

* $ExternalTrackingManager **[GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager](GeekyHouse-ExternalTrackingBundle-Service-ExternalTrackingManager.md)** - &lt;p&gt;A ExternalTrackingManager instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelRequest()

```
mixed GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelRequest()(\Symfony\Component\HttpKernel\Event\GetResponseEvent $event)
```

Allows to create a response for a request
Call setResponse() to set the response that will be returned for the current request.

The propagation of this event is stopped as soon as a response is set.

* Visibility: **public**

#### Arguments

* $event **Symfony\Component\HttpKernel\Event\GetResponseEvent** - &lt;p&gt;A GetResponseEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelController()

```
mixed GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelController()(\Symfony\Component\HttpKernel\Event\FilterControllerEvent $event)
```

Allows filtering of a controller callable
You can call getController() to retrieve the current controller.

With setController() you can set a new controller that is used in the processing of the request.
Controllers should be callables.

* Visibility: **public**

#### Arguments

* $event **Symfony\Component\HttpKernel\Event\FilterControllerEvent** - &lt;p&gt;A FilterControllerEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelView()

```
mixed GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelView()(\Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event)
```

Allows to create a response for the return value of a controller
Call setResponse() to set the response that will be returned for the current request.

The propagation of this event is stopped as soon as a response is set.

* Visibility: **public**

#### Arguments

* $event **Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent** - &lt;p&gt;A GetResponseForControllerResultEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelResponse()

```
mixed GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::onKernelResponse()(\Symfony\Component\HttpKernel\Event\FilterResponseEvent $event)
```

Allows to filter a Response object
You can call getResponse() to retrieve the current response.

With setResponse() you can set a new response that will be returned to the browser.

* Visibility: **public**

#### Arguments

* $event **Symfony\Component\HttpKernel\Event\FilterResponseEvent** - &lt;p&gt;A FilterResponseEvent instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::getSubscribedEvents()

```
array GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::\GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener::getSubscribedEvents()()
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


