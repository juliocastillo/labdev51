<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


final class LabResultadosAdminController extends CRUDController
{
    /**
     * Load action.
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function indexAction(Request $request): Response
    {
        
        //$this->admin->checkAccess('load');

        $preResponse = $this->preLoad($request);
        if (null !== $preResponse) {
            return $preResponse;
        }

        $template = $this->admin->getTemplateRegistry()->getTemplate('lab_resultados');

         $sql = "SELECT * FROM lab_orden";
         
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $ordenes = $stm->fetchAll();
        
        return $this->renderWithExtraParams($template, [
            'action' => 'index',
            'ordenes' => $ordenes,
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

