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
        //$numeroOrden = $request->get('numeroOrden');
        $sql = "SELECT t01.id, t02.nombre,t02.apellido,
                DATE_FORMAT(t01.fecha_orden,'%d-%m%-%Y %H:%i') AS fecha_orden
                FROM lab_orden t01 
                LEFT JOIN mnt_paciente t02 ON t01.id_paciente = t02.id 
                WHERE t01.id_estado_orden = 1
                ";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $array = array();
        foreach ($result as $r) {
            $array2 = array(
                '<div class="btn btn-success btn-block btn-sm" id="idsolicitud" onclick="mostrarDetalle('.$r['id'].')">'.$r['id'].'</div>',
                $r['fecha_orden'], 
                $r['nombre'] .' '. $r['apellido'],
                "<button id='btnBorrarOrden' class='btn btn-danger btn-sm'>Borrar
                    <i class='glyphicon glyphicon-trash'>
                </button>", 
                "<button id='btnCancelar' class='btn btn-warning btn-sm'>Cancelar
                <i class='glyphicon glyphicon-remove'>
                </button>");
            array_push($array, $array2);
        }

        $array = json_encode(array(
            "data" => $array
        ));
        //var_dump($array); exit();
        return new Response($array);

        //$this->render("LabResultados/resultados_busqueda.html.twig",
    }   
    /**
     * @Route("/lab/detalles/ordenes/pendientes", name="lab_detalles_ordenes_pendientes")
     */
    public function labDetallesOrdenesPendientes(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idOrden = $request->get('idOrden');
        $sql = "SELECT t01.id, t02.nombre_examen, t01.id_examen, t03.estado_examen, t04.id_estado_orden
                    FROM lab_detalle_orden t01 
                    INNER JOIN ctl_examen t02 ON t01.id_examen = t02.id
                    INNER JOIN ctl_estado_examen t03 ON t01.id_estado_examen = t03.id
                    INNER JOIN lab_orden t04 ON t04.id = t01.id_orden
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
        $sqlEdadEnDias = "SELECT datediff(NOW(),mp.fecha_nacimiento) AS dias_de_edad, mp.id_sexo
        from lab_orden ldo 
        inner join mnt_paciente mp on mp.id=ldo.id_paciente
        where ldo.id =$idOrden;";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlEdadEnDias);
        $stm->execute();
        $edadEnDias = $stm->fetchAll();
        $numeroDeDias = (Int)$edadEnDias[0]['dias_de_edad'];
        $idSexo=(Int)$edadEnDias[0]['id_sexo'];
        $sqlIdEdad = "SELECT id from ctl_rango_edad
                            where edad_minima <= $numeroDeDias AND edad_maxima >= $numeroDeDias";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIdEdad);
        $stm->execute();
        $arrayEdad = $stm->fetchAll();
        $idEdad = (Int)$arrayEdad[0]["id"];
        
        $sql = "SELECT t1.id, t1.nombre_elemento, t1.id_tipo_elemento,
                    t1.valor_inicial, t1.valor_final, t1.unidades, t1.protozoario
                FROM mnt_elementos t1
        
                LEFT JOIN ctl_examen t2 ON t2.id = t1.id_examen
                LEFT JOIN lab_detalle_orden t3 ON t3.id_examen = t2.id 
                LEFT JOIN lab_orden t4 ON t4.id = t3.id_orden
                LEFT JOIN mnt_paciente t5 ON t5.id = t4.id_paciente
        
                WHERE t4.id = $idOrden
                AND t2.id = $idExamen
                AND (t1.id_rango_edad = $idEdad OR t1.id_rango_edad IS NULL)
                AND (t1.id_sexo = $idSexo OR t1.id_sexo IS NULL)
                ORDER BY t1.ordenamiento";

        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();
        $nElementos = 0;
        $isProtozoario=false;
        foreach ($result as $r){
            if ($r["id_tipo_elemento"] == 2)
                $nElementos++;
            if ($r["protozoario"])
                $isProtozoario=true; 
        }
        
        return $this->render("LabResultados/resultado_detalle_elementos.html.twig",
                array("datos" => $result,
                "idDetalleOrden" => $idDetalleOrden,
                "nElementos" => $nElementos,
                "isProtozoario" => $isProtozoario,
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
        ini_set('xdebug.var_display_max_depth', -1);
        ini_set('xdebug.var_display_max_children', -1);
        ini_set('xdebug.var_display_max_data', -1);
        parse_str($request->get('datos'), $datos);
        $row               = "";
        $now               = date_create('now')->format('Y-m-d H:i:s');
        //var_dump($datos); exit();
        $userId            = $this->getUser()->getId();
        $errorMensaje      = "";
        $datoVacio         = false;
        $quisteVacio       = false;
        $empleadoVacio     = false;
        $detalleConError   = array();
        for ($i = 0; $i < $datos["nElementos"]*2;$i+=2){
                if ($datos["idElemento"][$i+1] == ""){
                    $errorMensaje      = !$datoVacio?$errorMensaje."Error resultado vacio \n":$errorMensaje;
                    $datoVacio         = true;
                    $detalleConError[] = $datos["idElemento"][$i];
                }
                if ($datos["idElementoQuiste"][$i+1] == "" && $datos["isProtozoario"] == "1" ){
                    $errorMensaje      = !$quisteVacio?$errorMensaje."Error Quiste vacio \n":$errorMensaje;
                    $quisteVacio       = true;
                    $detalleConError[] = $datos["idElementoQuiste"][$i];
                }
                if ($datos["empleado"]==""){
                    $errorMensaje      = !$empleadoVacio?$errorMensaje."Error Sin Usuario \n":$errorMensaje;
                    $empleadoVacio     = true;
                }
                $datos["idElementoQuiste"][$i+1] = $datos["idElementoQuiste"][$i+1]=="NULL"?null:$datos["idElementoQuiste"][$i+1];
                $row = $row."('".$datos["idElemento"][$i]."',".$datos["empleado"].",'".$datos["idDetalleOrden"].  "',".$userId.",'".$datos["idElemento"][$i+1]."','".$datos["observacion"]."','".$datos["idElementoQuiste"][$i+1]."','".$now."',true)";
                if($datos["nElementos"]*2-2 != $i)
                    $row =$row.",";
        }
        if ($datoVacio || $quisteVacio || $empleadoVacio){
            $response = json_encode(array(
                "message" => $errorMensaje,
                "idResultado" => $detalleConError,
                "error" => "true",
            ));
            return new Response($response);
        }
        $sql = "INSERT INTO lab_resultados(id_elemento,id_empleado,id_detalle_orden,id_usuario_reg,resultado,observacion,quiste,fechahora_reg,activo)
                VALUES ".$row.";";
        //var_dump($sql); exit();
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();        
        $sql = "UPDATE lab_detalle_orden SET id_estado_examen = '2',fecha_resultado=NOW(),observacion ='".$datos["observacion"]."' WHERE id=".$datos["idDetalleOrden"].";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();

        $sqlIdExamen = "SELECT id_examen
                            FROM lab_detalle_orden
                            WHERE id =". $datos['idDetalleOrden'].";";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIdExamen);
        $stm->execute();
        $idExamen = $stm->fetch();

        /* ESTADO DE EXAMENES Y ORDENES */
        $idOrden=$datos["idOrden"];
        $sqlEstOrden = "SELECT COUNT(id_estado_examen) AS exa_pendientes FROM lab_detalle_orden WHERE id_estado_examen = 1 AND id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlEstOrden);
        $stm->execute();
        $exaPendientes = $stm->fetch();

        /* CAMBIAR ESTADO DE ORDEN A COMPLETA */
        if ($exaPendientes["exa_pendientes"] == 0) {
            $sqlEstOrden = "UPDATE lab_orden SET id_estado_orden = '2' WHERE id = $idOrden";
            $stm = $this->getDoctrine()->getConnection()->prepare($sqlEstOrden);
            $stm->execute();
        }
        /* FIN DE CAMBIO DE ESTADO DE ORDEN  */

        $response = json_encode(array(
            "message" => 'Guardado Exitosamente',
            "idExamen" => $idExamen["id_examen"],
            "idOrden" => $datos["idOrden"],
            "idDetalleOrden" => $datos["idDetalleOrden"],
            //"exaPend" => $exaPendientes["exa_pendientes"]
        ));
        //var_dump($response); exit();
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
     * @Route("/lab/borrar/orden", name="lab_borrar_orden")
     */
    public function borrarOrden(): Response
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idDetOrden = $request->get('idDetOrden');
        $idOrden = $request->get('idOrden');
        /* BORRAR DETALLE ORDEN */
        $sql = "DELETE FROM lab_orden WHERE id = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
       /* $sqlNumEx = "SELECT COUNT(id_examen) AS num_examenes FROM lab_detalle_orden WHERE id_orden = $idOrden";
       $stm = $this->getDoctrine()->getConnection()->prepare($sqlNumEx);
       $stm->execute();
       $numEx = $stm->fetch();

       if ($numEx["num_examenes"] == 0) {
           $sqlEstOrden = "UPDATE lab_orden SET id_estado_orden = '3' WHERE id = $idOrden";
           $stm = $this->getDoctrine()->getConnection()->prepare($sqlEstOrden);
           $stm->execute();
       } */
       return new Response("borrada");
    }
    /**
     * @Route("/lab/borrar/examen/orden", name="lab_borrar_examen_orden")
     */
     public function borrarExamenSolicitud(): Response
     {
         $request = $this->container->get('request_stack')->getCurrentRequest();
         $idDetOrden = $request->get('idDetOrden');
         $idOrden = $request->get('idOrden');
         $sql = "DELETE
                 FROM lab_detalle_orden
                 WHERE id = $idDetOrden";
         $stm = $this->getDoctrine()->getConnection()->prepare($sql);
         $stm->execute();
         //$result = $stm;
        
        /* $sqlNumEx = "SELECT COUNT(id_examen) AS num_examenes FROM lab_detalle_orden WHERE id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlNumEx);
        $stm->execute();
        $numEx = $stm->fetch();

        if ($numEx["num_examenes"] == 0) {
            $sqlEstOrden = "UPDATE lab_orden SET id_estado_orden = '3' WHERE id = $idOrden";
            $stm = $this->getDoctrine()->getConnection()->prepare($sqlEstOrden);
            $stm->execute();
        } */
        return new Response("borrado");
     }
     /**
     * @Route("/borrar/resultado/examen", name="borrar_resultado_examen")
     */
     public function borrarResultadoExamen(): Response
     {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idDetOrden = $request->get('idDetOrden');
        $idOrden = $request->get('idOrden');

        $sql = "SELECT id_orden
                FROM lab_detalle_orden
                WHERE id = $idDetOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $idOrdenArray = $stm->fetch();
        $idOrden = $idOrdenArray['id_orden'];

        
        $sql = "DELETE
                FROM lab_resultados    
                WHERE id_detalle_orden = $idDetOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();

        $sql = "UPDATE lab_detalle_orden
                SET id_estado_examen = 1
                WHERE id = $idDetOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
 
        $response = json_encode(array(
            "message" => 'borrado',
            "idOrden" => $idOrden
        ));

        $sqlNumEx = "SELECT COUNT(id_examen) AS num_examenes FROM lab_detalle_orden WHERE id_orden = $idOrden";
        $stm = $this->getDoctrine()->getConnection()->prepare($sqlNumEx);
        $stm->execute();
        $numEx = $stm->fetch();

        /* CAMBIAR ESTADO DE SOLICITUD A DIGITADA */
        if ($numEx["num_examenes"] != 0) {
            $sqlEstOrden = "UPDATE lab_orden SET id_estado_orden = '1' WHERE id = $idOrden";
            $stm = $this->getDoctrine()->getConnection()->prepare($sqlEstOrden);
            $stm->execute();
        }

        //idExamen,idDetalleOrden,idOrden
        return new Response($response);
     }
}
