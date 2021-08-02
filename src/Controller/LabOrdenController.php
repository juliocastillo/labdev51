<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LabOrdenController extends AbstractController
{
    /**
     * @Route("/laborden/ordenes/save", name="laborden_ordenes_save")
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
     * @Route("/lab/ordenes/completas/list", name="ordenes_completas_list")
     */
    public function ordenesCompletas() : Response {
        $sql = "SELECT DISTINCT(t01.id), t02.nombre, t02.apellido, t03.nombre_estado,
                        DATE_FORMAT(t01.fecha_orden,'%d-%m%-%Y %H:%i:%s') AS fecha_orden
                        FROM lab_orden t01 
                        LEFT JOIN mnt_paciente t02 ON t01.id_paciente = t02.id
                        LEFT JOIN ctl_estado_orden t03 ON t01.id_estado_orden = t03.id
                        LEFT JOIN lab_detalle_orden t04 ON t04.id_orden = t01.id
                        WHERE t01.id_estado_orden = 2";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        //var_dump($result); exit();
        return $this->render("LabOrden/ordenes_completas.html.twig",
                array("datos" => $result)
        );
    }
    /**
     * @Route("/lab/detalle/orden/list", name="detalle_orden_list")
     */
    public function detalleOrden() : Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden = $request->get('idOrden');
        $sql = "SELECT t04.id, t02.nombre_examen, t01.id_examen, t03.estado_examen, t04.id_estado_orden, t01.id AS id_detalle_orden
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    INNER JOIN lab_orden t04 ON t04.id = t01.id_orden
                    WHERE t01.id_examen = t02.id 
                    AND t01.id_orden = $idOrden
                    AND t04.id_estado_orden = 2";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        //var_dump($result); exit();
        return $this->render("LabOrden/examenes_list.html.twig",
                array("datos" => $result)
        );
    }       
}
