<?php

namespace Emarref\Bundle\TwigDoctrineLoaderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('emarref_twig_doctrine_loader');

        $rootNode
            ->children()
                ->scalarNode('repository')->defaultValue('EmarrefTwigDoctrineLoaderBundle:Template')->end()
                ->scalarNode('name_column')->defaultValue('name')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
