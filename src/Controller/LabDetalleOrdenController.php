<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LabDetalleOrdenController extends AbstractController
{
    /**
     * @Route("/lab/detalle/orden", name="lab_detalle_orden")
     */
    public function index(): Response
    {
        return $this->render('lab_detalle_orden/index.html.twig', [
            'controller_name' => 'LabDetalleOrdenController',
        ]);
    }

    /**
     * @Route("/lab/detalles/guardar/examenes", name="lab_detalles_guardar_examenes")
     */
    public function labDetallesGuardarExamenes(): Response
    {
        $request        = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden        = $request->get('idOrden');
        $idExamen       = $request->get('idExamen');
        $idTipoMuestra  = $request->get('idTipoMuestra');
        $precio         = $request->get('precio');
        $sql = "INSERT INTO lab_detalle_orden (
                id_orden,
                id_examen,
                id_tipo_muestra,
                id_estado_examen,
                precio,
                id_usuario_reg,
                fechahora_reg)
                VALUES ($idOrden,$idExamen,$idTipoMuestra,1,$precio,1,NOW())";

        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $sql = "SELECT t01.id, t02.nombre_examen, t01.id_examen, t03.estado_examen
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    WHERE t01.id_examen = t02.id and t01.id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        foreach($result as $r) {
            echo "+ ".$r['nombre_examen']."<br>";
        }
        return new Response('Ok');
    }   

}
