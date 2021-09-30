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
     * @Route("/lab/orden/list", name="lab_orden_list")
     */
    public function ordenList(): Response
    {
        return $this->render('LabOrden/orden_list.html.twig');
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
        $sql = "INSERT INTO lab_detalle_orden (
                id_orden,
                id_examen,
                id_tipo_muestra,
                id_estado_examen,
                id_usuario_reg,
                fechahora_reg)
                VALUES ($idOrden,$idExamen,$idTipoMuestra,1,1,NOW())
                ON DUPLICATE KEY UPDATE
                id_orden=$idOrden, id_examen=$idExamen, id_tipo_muestra=$idTipoMuestra, id_usuario_mod = 1, fechahora_mod = NOW()" ;

        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $sql = "SELECT t01.id, t02.nombre_examen, t01.id_examen, t02.nombre_examen, t03.estado_examen, t04.tipo_muestra, t01.precio
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    INNER JOIN ctl_tipo_muestra t04 ON t04.id = t01.id_tipo_muestra
                    WHERE t01.id_orden=$idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
        foreach($result as $r) {
            echo "+ ".$r['nombre_examen'].' '.$r['tipo_muestra'].' '.$r['precio']."<br>";
        }
        return new Response('Ok');
        
    }   

}
