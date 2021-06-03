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
                array("datos" => $result,
                      "idOrden" => $idOrden
                    ));
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
        $idOrden = $request->get('idOrden');
        $sqlExamenCompleto = "SELECT id_estado_examen
                                FROM lab_detalle_orden
                                WHERE id = $idDetalleOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlExamenCompleto);
        $stm->execute();
        $examenCompleto = $stm->fetch();
        //var_dump($examenCompleto); exit();
        if ($examenCompleto['id_estado_examen'] == '2') {
            return new Response(2);
        }
        $sqlPosibleResultado = "select * from ctl_posible_resultado";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlPosibleResultado);
        $stm->execute();
        $posiblesResultado = $stm->fetchAll();
        $sqlEmpleados = "select * from mnt_empleado";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlEmpleados);
        $stm->execute();
        $empleados = $stm->fetchAll();
        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, t01.valor_final, t01.unidades,t02.resultado
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
                "nElementos" => $nElementos,
                "posiblesResultados" => $posiblesResultado,
                "empleados" => $empleados,
                "idOrden" => $idOrden
            ));
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
        //var_dump($datos); exit();
        $userId = $this->getUser()->getId();
        for ($i = 0; $i < $datos["nElementos"]*2;$i+=2){
                $row = $row."('".$datos["idElemento"][$i]."',".$datos["empleado"].",'".$datos["idDetalleOrden"].  "',".$userId.",'".$datos["idElemento"][$i+1]."','".$now."',true)";
                if($datos["nElementos"]*2-2 != $i)
                    $row =$row.",";
        }
        /* $sql = "INSERT INTO lab_resultados(id_elemento,id_empleado,id_detalle_orden,id_usuario_reg,resultado,fechahora_reg,activo)
                VALUES ".$row.";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();        
        $sql = "UPDATE lab_detalle_orden SET id_estado_examen = '2' WHERE id=".$datos["idDetalleOrden"].";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute(); */

        $sqlIdExamen = "SELECT id_examen
                            FROM lab_detalle_orden
                            WHERE id =". $datos['idDetalleOrden'].";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIdExamen);
        $stm->execute();
        $idExamen = $stm->fetch();

        $response = json_encode(array(
            "mesage" => 'Guardado Exitosamente',
            "idExamen" => $idExamen["id_examen"],
            "idOrden" => $datos["idOrden"],
            "idDetalleOrden" => $datos["idDetalleOrden"]
        ));

        //idExamen,idDetalleOrden,idOrden
        return new Response($response);
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

     /**
     * @Route("/borrar/resultado/examen", name="borrar_resultado_examen")
     */
     public function borrarResultadoExamen(): Response
     {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idDetOrden = $request->get('idDetOrden');
        $idElemento = $request->get('idExamen');

        $sqlIdResultado = "SELECT id
                            FROM lab_resultado
                            WHERE id_detalle_orden = $idDetOrden
                            AND id_elemento = $idElemento";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIdResultado);
        $stm->execute();
        $idResultado = $stm->fetch();
        
        $sql = "DELETE
                FROM lab_resultados    
                WHERE id = $idResultado";
         $stm = $this->getDoctrine()->getConnection()->prepare($sql);
         $stm->execute();
         //$result = $stm;
 
         return new Response("borrado");
     }
}
