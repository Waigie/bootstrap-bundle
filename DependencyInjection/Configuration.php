<?php
/**
 * This file is part of BraincraftedBootstrapBundle.
 *
 * (c) 2012-2013 by Florian Eckerstorfer
 */

namespace Braincrafted\Bundle\BootstrapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @package    BraincraftedBootstrapBundle
 * @subpackage DependencyInjection
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2013 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 * @link       http://bootstrap.braincrafted.com Bootstrap for Symfony2
 *
 * @codeCoverageIgnore
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        return $this->buildConfigTree();
    }

    private function buildConfigTree()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('braincrafted_bootstrap');

        $rootNode
            ->children()
                ->scalarNode('output_dir')->defaultValue('')->end()
                ->scalarNode('assets_dir')
                    ->defaultValue('%kernel.root_dir%/../vendor/twbs/bootstrap')
                ->end()
                ->scalarNode('jquery_path')
                    ->defaultValue('%kernel.root_dir%/../vendor/jquery/jquery/jquery-1.10.2.js')
                ->end()
                ->scalarNode('less_filter')
                    ->defaultValue('less')
                    ->validate()
                        ->ifNotInArray(array('less', 'lessphp', 'none'))
                        ->thenInvalid('Invalid less filter "%s"')
                    ->end()
                ->end()
                ->arrayNode('auto_configure')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('assetic')->defaultValue(true)->end()
                        ->booleanNode('twig')->defaultValue(true)->end()
                        ->booleanNode('knp_menu')->defaultValue(true)->end()
                        ->booleanNode('knp_paginator')->defaultValue(true)->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
