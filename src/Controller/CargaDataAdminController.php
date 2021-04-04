<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


final class CargaDataAdminController extends CRUDController
{
    /**
     * Load action.
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function loadAction(Request $request): Response
    {
        $this->admin->checkAccess('load');

        $preResponse = $this->preLoad($request);
        if (null !== $preResponse) {
            return $preResponse;
        }

        $template = $this->admin->getTemplateRegistry()->getTemplate('load');

        $numero_expediente = "123-21";
        
        return $this->renderWithExtraParams($template, [
            'numero_expediente' => $numero_expediente,
            'action' => 'load',
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ], null);
    }

    /**
     * This method can be overloaded in your custom CRUD controller.
     * It's called from loadAction.
     */
    protected function preLoad(Request $request): ?Response
    {
        return null;
    }
}

