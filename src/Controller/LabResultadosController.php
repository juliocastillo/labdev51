<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LabResultadosController extends AbstractController
{
    /**
     * @Route("/lab/resultados/ordenes/pendientes", name="lab_resultados_ordenes_pendientes")
     */
    public function labResultadosOrdenesPendientes(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $numeroOrden = $request->get('numeroOrden');
        $sql = "SELECT t01.id, t02.nombre,t02.apellido,t01.fecha_orden 
                FROM lab_orden t01 
                LEFT JOIN mnt_paciente t02 ON t01.id_paciente = t02.id 
                WHERE t01.id = $numeroOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->render("resultados_busqueda.html.twig",
                array("datos" => $result));
    }   
    /**
     * @Route("/lab/detalles/ordenes/pendientes", name="lab_detalles_ordenes_pendientes")
     */
    public function labDetallesOrdenesPendientes(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden = $request->get('idOrden');
        $sql = "SELECT t02.nombre_examen, t01.id_examen, t01.id_estado_examen
                FROM lab_detalle_orden t01, ctl_examen t02
                WHERE t01.id_examen = t02.id and t01.id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->render("resultados_busqueda_detalle.html.twig",
                array("datos" => $result));
    }   
    /**
     * @Route("/lab/detalles/elementos", name="lab_detalles_elementos")
     */
    public function labDetallesElementos(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento 
                FROM mnt_elementos t01 
                    left join lab_resultados t02 on t01.id = t02.id_elemento
                    left join lab_detalle_orden t03 on t03.id = t02.id_detalle_orden
                    left join lab_orden t04 on t04.id = t03.id_orden 
                    left join mnt_paciente t05 on t05.id = t04.id_paciente 
                WHERE t01.id_examen = $idExamen 
                ORDER BY t01.ordenamiento";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        
        return $this->render("resultado_detalle_elementos.html.twig",
                array("datos" => $result));
    }   
    /**
     * @Route("/lab/detalles/guardar/elementos", name="lab_detalles_guardar_elementos")
     */
    public function labDetallesGuardarElementos(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        parse_str($request->get('datos'), $datos);
        var_dump($datos); exit();

        return new Response('guardado');
    }   
}
