<?php
/**
 * NovaeZSEOBundle Configuration
 *
 * @package   Novactive\Bundle\eZSEOBundle
 * @author    Novactive <novaseobundle@novactive.com>
 * @copyright 2015 Novactive
 * @license   https://github.com/Novactive/NovaeZSEOBundle/blob/master/LICENSE MIT Licence
 */
namespace Novactive\Bundle\eZSEOBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use eZ\Bundle\EzPublishCoreBundle\DependencyInjection\Configuration\SiteAccessAware\Configuration as SiteAccessConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends SiteAccessConfiguration
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root( 'novae_zseo' );
        $systemNode  = $this->generateScopeBaseNode( $rootNode );
        $systemNode
            ->scalarNode( 'google_verification' )->defaultValue( '~' )->end()
            ->scalarNode( 'fieldtype_metas_identifier' )->defaultValue( 'metas' )->end()
            ->arrayNode( 'fieldtype_metas' )
                ->isRequired()
                ->prototype( 'array' )
                    ->children()
                        ->scalarNode( 'label' )->isRequired()->end()
                        ->scalarNode( 'default_pattern' )->end()
                        ->scalarNode( 'icon' )->end()
                    ->end()
                ->end()
            ->end()
            ->arrayNode( 'robots_disallow' )
                ->prototype( 'scalar' )
                ->end()
            ->end();
        return $treeBuilder;
    }
}