GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension
===============

ExternalTrackingExtension

This class define Twig functions to display tracking


* Class name: ExternalTrackingExtension
* Namespace: GeekyHouse\ExternalTrackingBundle\Twig\Extension
* Parent class: Twig_Extension





Properties
----------


### $ExternalTrackingManager

```
protected \GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager
```





* Visibility: **protected**


Methods
-------


### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::__construct()

```
\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::__construct()(\GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager $ExternalTrackingManager)
```

Constructor
Store some variables on the current instance



* Visibility: **public**

#### Arguments

* $ExternalTrackingManager **[GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager](GeekyHouse-ExternalTrackingBundle-Service-ExternalTrackingManager.md)** - &lt;p&gt;A ExternalTrackingManager instance&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getName()

```
mixed GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getName()()
```

{@inheritdoc}



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getFunctions()

```
mixed GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getFunctions()()
```

{@inheritdoc}



* Visibility: **public**



### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getExternalTrackers()

```
string GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::getExternalTrackers()(boolean $documentReady, integer $delay)
```

This method returns HTML formatted trackers



* Visibility: **public**

#### Arguments

* $documentReady **boolean** - &lt;p&gt;Define if the trackers have to wait until DOM is loaded&lt;/p&gt;
* $delay **integer** - &lt;p&gt;Define a delay before write the trackers&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::cleanJavascriptString()

```
string GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::cleanJavascriptString()(string $string)
```

This method alters JS string to be used by this extension



* Visibility: **private**

#### Arguments

* $string **string** - &lt;p&gt;The original Javascript string&lt;/p&gt;



### \GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::escapeDoubleQuoteJS()

```
string GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::\GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension::escapeDoubleQuoteJS()(array $matches)
```

This method has to be used preg_replace_callback
It escape double quotes and escaped double quotes



* Visibility: **private**

#### Arguments

* $matches **array** - &lt;p&gt;The matches returned by preg_replace_callbackers&lt;/p&gt;


