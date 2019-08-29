<?php

namespace Maspyma\UsuariosBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UsuariosExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
        
        if (!isset($config['login_template'])) {
            throw new \InvalidArgumentException('The "login_template" option must be set');
        }
        
        if (!isset($config['role_default'])) {
            throw new \InvalidArgumentException('The "role_default" option must be set');
        }

        if (!isset($config['access_denied_redirect_route'])) {
            throw new \InvalidArgumentException('The "access_denied_redirect_route" option must be set');
        }

        if (!isset($config['logout_redirect_route'])) {
            throw new \InvalidArgumentException('The "logout_redirect_route" option must be set');
        }

        $container->setParameter('usuarios.login_template', $config['login_template']);
        $container->setParameter('usuarios.role_default', $config['role_default']);
        $container->setParameter('usuarios.access_denied_redirect_route', $config['access_denied_redirect_route']);
        $container->setParameter('usuarios.logout_redirect_route', $config['logout_redirect_route']);
    }
}
