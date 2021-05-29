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
                WHERE t01.id = $numeroOrden AND t01.id_estado_orden = 1";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->render("LabResultados/resultados_busqueda.html.twig",
                array("datos" => $result));
    }   
    /**
     * @Route("/lab/detalles/ordenes/pendientes", name="lab_detalles_ordenes_pendientes")
     */
    public function labDetallesOrdenesPendientes(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden = $request->get('idOrden');
        $sql = "SELECT t01.id, t02.nombre_examen, t01.id_examen, t03.estado_examen
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    WHERE t01.id_examen = t02.id and t01.id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        return $this->render("LabResultados/resultados_busqueda_detalle.html.twig",
                array("datos" => $result));
    }   
    /**
     * @Route("/lab/detalles/elementos", name="lab_detalles_elementos")
     */
    public function labDetallesElementos(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        //$sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, t01.valor_final, t01.unidades";
        $idDetalleOrden = $request->get('idDetalleOrden');
        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, t01.valor_final, t01.unidades
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
        $nElementos = 0;
        foreach ($result as $r){
            if ($r["id_tipo_elemento"] == 2)
                $nElementos++; 
        }
        
        return $this->render("LabResultados/resultado_detalle_elementos.html.twig",
                array("datos" => $result,
                "idDetalleOrden" => $idDetalleOrden,
                "nElementos" => $nElementos));
    }   
    /**
     * @Route("/lab/detalles/guardar/elementos", name="lab_detalles_guardar_elementos")
     */
    public function labDetallesGuardarElementos(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        parse_str($request->get('datos'), $datos);
        $row = "";
        $now = date_create('now')->format('Y-m-d H:i:s');
        //var_dump($datos);
        //exit();
        for ($i = 0; $i < $datos["nElementos"]*2;$i+=2){
                $row = $row."('".$datos["idElemento"][$i]."','1','".$datos["idDetalleOrden"].  "','1','".$datos["idElemento"][$i+1]."','".$now."',true)";
                if($datos["nElementos"]*2-2 != $i)
                    $row =$row.",";
        }

        $sql = "INSERT INTO lab_resultados(id_elemento,id_empleado,id_detalle_orden,id_usuario_reg,resultado,fechahora_reg,activo)
                VALUES ".$row.";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();        

        return new Response('Guardado Exitosamente');
    }   

    /**
     * @Route("/lab/cancelar/orden", name="lab_cancelar_orden")
     */
    public function cambiarEstadoOrden(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden = $request->get('idOrden');
        $sql = "UPDATE lab_orden t01
                SET t01.id_estado_orden = 3
                WHERE t01.id = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        //$result = $stm;

        return new Response("exito!");
    }

    /**
     * @Route("/lab/borrar/examen/orden", name="lab_borrar_examen_orden")
     */
     public function borrarExamenSolicitud(): Response
     {
         $request = $this->container->get('request_stack')->getCurrentRequest();
         $idDetOrden = $request->get('idDetOrden');
         $sql = "DELETE
                 FROM lab_detalle_orden
                 WHERE id = $idDetOrden";
         $stm = $this->getDoctrine()->getConnection()->prepare($sql);
         $stm->execute();
         //$result = $stm;
 
         return new Response("borrado");
     }
}
