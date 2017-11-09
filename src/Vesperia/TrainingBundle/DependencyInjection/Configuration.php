<?php

namespace Vesperia\TrainingBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vesperia_training');

        $rootNode->children()
                ->scalarNode('text')
                    ->defaultValue('hello the world')
                ->end()
                ->scalarNode('title')
                    ->defaultValue('hello world title')
                ->end()
                ->arrayNode('range')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('min')
                            ->defaultValue(0)
                        ->end()
                        ->scalarNode('max')
                            ->defaultValue(10)
                        ->end()
                    ->end()
                ->end()
            ->end();
        
        return $treeBuilder;
    }
}
