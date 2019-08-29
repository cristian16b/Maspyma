<?php

namespace Maspyma\UsuariosBundle\Handler;

use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Maspyma\UsuariosBundle\Services\GlobalDataService;

class LogoutSuccessHandler extends ContainerAware implements LogoutSuccessHandlerInterface {

    var $router;
    var $globalData;

    public function __construct(Router $router, GlobalDataService $globalData) {
        $this->router = $router;
        $this->globalData = $globalData;
    }

    public function onLogoutSuccess(Request $request) {
        $globals = $this->globalData->getGlobals();
        $logout_redirect_route = $globals['logout_redirect_route'];
        return new RedirectResponse($this->router->generate($logout_redirect_route));
    }

}
