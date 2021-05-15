<?php

declare(strict_types=1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class LabOrdenAdminController extends CRUDController
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

        $request->get('action') ? $action = $request->get('action') : $action = 'create';
        
        $template = $this->admin->getTemplateRegistry()->getTemplate('lab_orden');

        $sql = "SELECT * FROM mnt_paciente order by nombre, apellido";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $pacientes = $stm->fetchAll();
        
        $sql = "SELECT * FROM mnt_medico order by nombre, apellido";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $medicos = $stm->fetchAll();
        
        $sql = "SELECT * FROM ctl_forma_pago";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $formaspago = $stm->fetchAll();

        $sql = "SELECT * FROM ctl_tipo_documento";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $tiposdocumento = $stm->fetchAll();

        $sql = "SELECT * FROM ctl_examen";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $examenes = $stm->fetchAll();

        $sql = "SELECT * FROM ctl_tipo_muestra";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $tiposmuestra = $stm->fetchAll();

        return $this->renderWithExtraParams($template, [
            'action'        => 'create',
            'pacientes'     => $pacientes,
            'medicos'       => $medicos,
            'formaspago'    => $formaspago,
            'tiposdocumento'=> $tiposdocumento,
            'examenes'      => $examenes,
            'tiposmuestra'   => $tiposmuestra,
            'csrf_token'    => $this->getCsrfToken('sonata.batch'),
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
