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
        $sql = "SELECT id, fecha_orden, id_paciente
                FROM lab_orden
                WHERE id = $numeroOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->render("resultados_busqueda.twig",
                array("datos" => json_encode($result)));
    }   
}
