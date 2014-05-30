<?php

/*
 * This file is part of the ExternalTrackingBundle.
 *
 * (c) Damien Jarry <dev.damienjarry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GeekyHouse\ExternalTrackingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener;

/**
 * Bundle configuration
 *
 * @author Damien Jarry <dev.damienjarry@gmail.com>
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('external_tracking');

        $rootNode
            ->children()
                ->scalarNode('manager_class')
                    ->defaultValue('GeekyHouse\ExternalTrackingBundle\Service\ExternalTrackingManager')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('request_listener_class')
                    ->defaultValue('GeekyHouse\ExternalTrackingBundle\EventListener\RequestListener')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('extension_class')
                    ->defaultValue('GeekyHouse\ExternalTrackingBundle\Twig\Extension\ExternalTrackingExtension')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }

}
