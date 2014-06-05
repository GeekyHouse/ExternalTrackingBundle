<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\Twig\Extension;

use GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager;
use Twig_Extension;

/**
 * ExternalTrackingExtension
 *
 * This class define Twig functions to display tracking
 *
 * @author  Damien Jarry
 * @version 1.0
 * @uses    GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager ExternalTrackingManager
 * @uses    Twig_Extension                                                    Twig_Extension
 */
class ExternalTrackingExtension extends Twig_Extension
{

    /**
     * @var ExternalTrackingManager $ExternalTrackingManager An ExternalTrackingManager instance
     */
    protected $ExternalTrackingManager;

    /**
     * Constructor
     * Store some variables on the current instance
     *
     * @param ExternalTrackingManager $ExternalTrackingManager A ExternalTrackingManager instance
     *
     * @return ExternalTrackingExtension An ExternalTrackingExtension instance
     */
    public function __construct(ExternalTrackingManager $ExternalTrackingManager)
    {
        $this->ExternalTrackingManager = $ExternalTrackingManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'external_tracking.twig.extension';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'get_external_trackers' => new \Twig_Function_Method($this, 'getExternalTrackers'),
        );
    }

    /**
     * This method returns HTML formatted trackers
     *
     * @param boolean $documentReady Define if the trackers have to wait until DOM is loaded
     * @param integer $delay         Define a delay before write the trackers
     *
     * @return string The HTML trackers (escaped format, use "raw()")
     */
    public function getExternalTrackers($documentReady = true, $delay = 500)
    {
        $output         = '';
        $delayIsOk      = $delay && is_numeric($delay);

        // Get trackers available for writing
        $trackersOutput = $this->cleanJavascriptString(
                            $this->ExternalTrackingManager->getTrackersHTML()
                        );

        // Remove trackers from session
        $this->ExternalTrackingManager->removeSessionTrackers();

        if (!empty($trackersOutput)) {
            // Open script
            $output .= '<div id="external-trackers-place"></div>
                        <script type="text/javascript">';

            // Open documentReady
            if ($documentReady) {
                $output .= '
                    var DOMReady = function(a,b,c){b=document,c=\'addEventListener\';b[c]?b[c](\'DOMContentLoaded\',a):window.attachEvent(\'onload\',a)}
                    DOMReady(function(){';
            }

            // Open timeout
            if ($delayIsOk) {
                $output .= 'setTimeout(function(){';
            }

            $output .= '
                var ExternalTrackerPlace = document.getElementById("external-trackers-place");
                    ExternalTrackerPlace.innerHTML = "'.$trackersOutput.'";
                var scripts = ExternalTrackerPlace.getElementsByTagName(\'script\');
                for (var i in scripts) {
                    window.eval(scripts[i].innerHTML);
                }
            ';

            // Close timeout
            if ($delayIsOk) {
                $output .= '}, '.$delay.');';
            }

            // Close documentReady
            if ($documentReady) {
                $output .= '});';
            }

            // Close script
            $output .= '</script>';
        }

        return $output;
    }

    /**
     * This method alters JS string to be used by this extension
     *
     * @param string $string The original Javascript string
     *
     * @return string The string cleaned to be used in "eval"
     */
    private function cleanJavascriptString($string)
    {
        // Escape JS chars
        $string = preg_replace_callback('~([\\\\]*)(["]+)~i', array($this, 'escapeDoubleQuoteJS'), $string);
        // Escape JS close tag
        $string = str_replace('</script>', '<\/script>', $string);
        // remove linebreaks
        $string = preg_replace('~\r|\n|\r\n~i', '', $string);

        return $string;
    }

    /**
     * This method has to be used preg_replace_callback
     * It escape double quotes and escaped double quotes
     *
     * @param array $matches The matches returned by preg_replace_callbackers
     *
     * @return string The string escaped
     */
    private function escapeDoubleQuoteJS($matches)
    {
        return addcslashes($matches[0], '"\\');
    }

}
