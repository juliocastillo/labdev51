<?php

declare(strict_types = 1);

namespace App\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\LabOrden as LabOrden;

final class LabOrdenAdminController extends CRUDController {

    /**
     * Load action.
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function indexAction(Request $request): Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $em = $this->getDoctrine()->getManager();
        $idOrden = 0;
        $detalles = array();
        $laborden = array();

        if (isset($_POST['action'])) {
            extract($_POST);
        } else {
            $action = 'create';
        }
        $template = $this->admin->getTemplateRegistry()->getTemplate('lab_orden');
        switch ($action) {
            case 'create' :
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
                $action = 'save';
                break;
            case 'save' :
                $sql = "INSERT INTO lab_orden (
                        id_paciente,
                        id_medico,
                        id_tipo_documento,
                        id_forma_pago,
                        fecha_orden,
                        numero_documento,
                        id_estado_orden,
                        id_usuario_reg,
                        fechahora_reg,
                        activo)
                        VALUES ($idPaciente,$idMedico,$idTipodocumento,$idFormapago,NOW(),$numeroDocumento,1,1,NOW(),1)";

                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                //obtener ultimo id insertado
                $idOrden = (int) $this->getDoctrine()->getConnection()->lastInsertId();
                $sql = "INSERT INTO lab_detalle_orden (
                        id_orden,
                        id_examen,
                        id_tipo_muestra,
                        id_estado_examen,
                        id_usuario_reg,
                        fechahora_reg)
                        VALUES ($idOrden,$idexamen,$idtipomuestra,1,1,NOW())";

                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();

                $sql = "SELECT t01.id, t02.nombre,t02.apellido,t01.fecha_orden, t01.numero_documento 
                FROM lab_orden t01 
                LEFT JOIN mnt_paciente t02 ON t01.id_paciente = t02.id 
                WHERE t01.id = $idOrden";
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $laborden = $stm->fetch();

                $sql = "SELECT t01.id, t02.nombre_examen, t01.id_examen, t02.nombre_examen, t03.estado_examen, t04.tipo_muestra, t01.precio
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    INNER JOIN ctl_tipo_muestra t04 ON t04.id = t01.id_tipo_muestra
                    WHERE t01.id_orden=$idOrden";
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $detalles = $stm->fetchAll();

                $sql = "SELECT * FROM mnt_paciente INNER JOIN lab_orden ON mnt_paciente.id = lab_orden.id_paciente WHERE lab_orden.id = $idOrden  order by nombre, apellido";
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $pacientes = $stm->fetchAll();

                $sql = "SELECT * FROM mnt_medico INNER JOIN lab_orden ON mnt_medico.id = lab_orden.id_medico WHERE lab_orden.id = $idOrden  order by nombre, apellido";
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $medicos = $stm->fetchAll();

                $sql = "SELECT * FROM ctl_forma_pago INNER JOIN lab_orden ON ctl_forma_pago.id = lab_orden.id_forma_pago WHERE lab_orden.id = $idOrden";
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $formaspago = $stm->fetchAll();

                $sql = "SELECT * FROM ctl_tipo_documento INNER JOIN lab_orden ON ctl_tipo_documento.id = lab_orden.id_tipo_documento WHERE lab_orden.id = $idOrden";
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
                
                $action = 'edit';
                break;
        }

        return $this->renderWithExtraParams($template, [
                    'action'            => $action,
                    'pacientes'         => $pacientes,
                    'medicos'           => $medicos,
                    'formaspago'        => $formaspago,
                    'tiposdocumento'    => $tiposdocumento,
                    'examenes'          => $examenes,
                    'tiposmuestra'      => $tiposmuestra,
                    'orden'             => $laborden,
                    'idorden'           => $idOrden,
                    'detalles'          => $detalles,
                    'csrf_token'        => $this->getCsrfToken('sonata.batch'),
                        ], null);
    }

    /**
     * This method can be overloaded in your custom CRUD controller.
     * It's called from loadAction.
     */
    protected function preLoad(Request $request): ?Response {
        return null;
    }

}
