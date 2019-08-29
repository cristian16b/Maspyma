<?php

namespace Maspyma\UsuariosBundle\Handler;

use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Maspyma\UsuariosBundle\Services\GlobalDataService;
use Symfony\Component\HttpFoundation\Session\Session;

class AccessDeniedHandler implements AccessDeniedHandlerInterface {

    var $router;
    var $globalData;
    var $session;

    public function __construct(Session $session, Router $router, GlobalDataService $globalData) {
        $this->router = $router;
        $this->globalData = $globalData;
        $this->session = $session;
    }

    public function handle(Request $request, AccessDeniedException $accessDeniedException) {
        if ($request->isXmlHttpRequest()) {
            $response = new Response(json_encode(array('status' => 'protected')));
            return $response;
        } else {
            $globals = $this->globalData->getGlobals();
            $access_denied_redirect_route = $globals['access_denied_redirect_route'];
            $this->session->getFlashBag()->add('info', 'No posee los permisos necesarios para ingresar a esta sección.');
            return new RedirectResponse($this->router->generate($access_denied_redirect_route));
        }
    }

}
