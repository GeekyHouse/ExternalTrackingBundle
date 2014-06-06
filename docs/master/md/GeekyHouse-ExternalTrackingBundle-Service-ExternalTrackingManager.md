GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager
===============

External tracking manager

This class manage a trackers list linked to events.


* Class name: ExternalTrackingManager
* Namespace: GeekyHouse\ExternalTrackingBundle\Service



Constants
----------


### SESSION_TRACKER_PREFIX

```
const SESSION_TRACKER_PREFIX = '_external_trackers'
```





Properties
----------


### $Session

```
private \Symfony\Component\HttpFoundation\Session\Session $Session
```





* Visibility: **private**


### $EventDispatcherInterface

```
private \Symfony\Component\EventDispatcher\EventDispatcherInterface $EventDispatcherInterface
```





* Visibility: **private**


### $trackersCollection

```
private array $trackersCollection = array()
```





* Visibility: **private**


### $defaultEvent

```
private string $defaultEvent
```





* Visibility: **private**


### $event

```
private string $event
```





* Visibility: **private**


### $data

```
private string $data
```





* Visibility: **private**


Methods
-------


### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::__construct()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::__construct()(\Symfony\Component\HttpFoundation\Session\Session $Session, \Symfony\Component\HttpFoundation\Session\Session $EventDispatcherInterface)
```

Constructor
Store some variables on the current instance



* Visibility: **public**

#### Arguments

* $Session **Symfony\Component\HttpFoundation\Session\Session** - &lt;p&gt;A Session instance&lt;/p&gt;
* $EventDispatcherInterface **Symfony\Component\HttpFoundation\Session\Session** - &lt;p&gt;An EventDispatcherInterface instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::registerEvent()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::registerEvent()(string $event, array $methods)
```

This methods store an array of methods for an event



* Visibility: **public**

#### Arguments

* $event **string** - &lt;p&gt;The event targeted&lt;/p&gt;
* $methods **array** - &lt;p&gt;The methods to invoke&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setDefaultEvent()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setDefaultEvent()(string $event, boolean $force)
```

Set the default event



* Visibility: **public**

#### Arguments

* $event **string** - &lt;p&gt;The default event to set&lt;/p&gt;
* $force **boolean** - &lt;p&gt;Overwrite the default event if TRUE&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setEvent()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setEvent()(string $event, boolean $force)
```

Set the current event



* Visibility: **public**

#### Arguments

* $event **string** - &lt;p&gt;The event to set&lt;/p&gt;
* $force **boolean** - &lt;p&gt;Overwrite the current event if TRUE&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getEvent()

```
string GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getEvent()()
```

This method returns the current event used



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::pushData()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::pushData()(array $data, boolean $force)
```

This method allows to add data on current instance.



* Visibility: **public**

#### Arguments

* $data **array** - &lt;p&gt;The datas to insert&lt;/p&gt;
* $force **boolean** - &lt;p&gt;Overwrite current datas if TRUE&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getData()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getData()()
```

This method returns the current datas



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setSessionTrackers()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::setSessionTrackers()()
```

This method adds available trackers in session



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getSessionTrackers()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getSessionTrackers()()
```

This method returns trackers from session



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::removeSessionTrackers()

```
\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::removeSessionTrackers()()
```

This method removes trackers from session



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackersHTML()

```
string GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackersHTML()()
```

This method returns a string with all trackers available for writing.



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getMethodsListByEvent()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getMethodsListByEvent()(string $event)
```

This returns all methods registered for an event



* Visibility: **protected**

#### Arguments

* $event **string** - &lt;p&gt;The event called&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackersByEvent()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackersByEvent()(string $event)
```

Returns an array of trackers with their methods.



* Visibility: **protected**

#### Arguments

* $event **string** - &lt;p&gt;The event sended&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackers()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::getTrackers()()
```

This method returns an array with all trackers available for writing



* Visibility: **protected**



### \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::mergeTrackersByEvent()

```
array GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager::mergeTrackersByEvent()(string $event, array $currentTrackers)
```

This method is an array_merge-like for array of trackers



* Visibility: **private**

#### Arguments

* $event **string** - &lt;p&gt;The event sended&lt;/p&gt;
* $currentTrackers **array** - &lt;p&gt;The current trackers list to merge in&lt;/p&gt;


