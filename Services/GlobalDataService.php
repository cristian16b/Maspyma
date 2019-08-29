<?php

namespace Maspyma\UsuariosBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GlobalDataService
 *
 * @author jdere
 */
class GlobalDataService {

    protected $container;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function getGlobals() {
        return array(
            'login_template' => $this->container->getParameter('usuarios.login_template'),
            'role_default' => $this->container->getParameter('usuarios.role_default'),
            'access_denied_redirect_route' => $this->container->getParameter('usuarios.access_denied_redirect_route'),
            'logout_redirect_route' => $this->container->getParameter('usuarios.logout_redirect_route'),
        );
    }

}
