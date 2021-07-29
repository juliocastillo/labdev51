<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
//use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
//use Knp\Snappy\Pdf;
use Symfony\Component\Validator\Constraints\Length;

//use Dompdf\Dompdf;
//use Dompdf\Options;

class ReportesController extends AbstractController
{
    /**
    * @Route("/cargar-datos", name="cargar_datos")
    */
    //Pdf $pdf
    public function loadData(): Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        $idDetOrden = $request->get('idDetOrden');
        $idOrden = $request->get('idOrden');

        /* QUERY HEADER */
        $sqlHead = "SELECT t01.nombre, t01.apellido, t02.fecha_orden, t03.nombre AS nombre_medico, 
                        t03.apellido AS apellido_medico,
                        TIMESTAMPDIFF(YEAR,t01.fecha_nacimiento,CURDATE()) AS edad_anios,
                        TIMESTAMPDIFF(MONTH,t01.fecha_nacimiento,CURDATE()) AS edad_meses,
                        TIMESTAMPDIFF(DAY,t01.fecha_nacimiento,CURDATE()) AS edad_dias 
                    
                    FROM mnt_paciente t01
                    
                    LEFT JOIN lab_orden t02 ON t01.id = t02.id_paciente
                    LEFT JOIN mnt_medico t03 ON t03.id = t02.id_medico
                    
                    WHERE t02.id = $idOrden";

        $stm = $this->getDoctrine()->getConnection()->prepare($sqlHead);
        $stm->execute();
        $resultHead = $stm->fetchAll();        
        /* END QUERY HEADER */
        /* QUERY ORDER IDS EXAMS*/
        $sqlIds = "SELECT t01.id_examen FROM lab_detalle_orden t01 WHERE t01.id_orden = $idOrden";

        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIds);
        $stm->execute();
        $resultIds = $stm->fetchAll();
        /* END ORDER IDS EXAMS */
        /* QUERY IDS AREA EXAMS*/
        $sqlIdsArea = "SELECT t02.id_area_laboratorio AS id_area 
                    FROM lab_detalle_orden t01
                    LEFT JOIN ctl_examen t02 ON t02.id = t01.id_examen
                    WHERE t01.id_orden = $idOrden";

        $stm = $this->getDoctrine()->getConnection()->prepare($sqlIdsArea);
        $stm->execute();
        $resultIdsArea = $stm->fetchAll();
        /* END ORDER IDS EXAMS */

        $array_datos = array();
        //$array = array();

        for ($i=0; $i < count($resultIds); $i++) { 
            $resultIds[$i];
            
            if ($resultIds[$i]["id_examen"] == "16") {

                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                t03.observacion
                FROM mnt_elementos t01 
                    LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                    LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                    LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                WHERE t03.id_orden = $idOrden
                AND t07.id = 16
                ORDER BY t01.ordenamiento";
    
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $resultOrina = $stm->fetchAll();
                $datos_orina = array();
                $datos_orina = $resultOrina;
                $array_datos["datos_orina"] = $datos_orina;
            }
            if ($resultIds[$i]["id_examen"] == "6") {
            
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                t03.observacion
                FROM mnt_elementos t01 
                    LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                    LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                    LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                WHERE t03.id_orden = $idOrden
                AND t07.id = 6
                ORDER BY t01.ordenamiento";
    
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $resultHeces = $stm->fetchAll();
                $datos_heces = array();
                $datos_heces = $resultHeces;
                $array_datos["datos_heces"] = $datos_heces;
            }
            if($resultIds[$i]["id_examen"] == "4"){
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                t03.observacion
                FROM mnt_elementos t01 
                    LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                    LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                    LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                WHERE t03.id_orden = $idOrden
                AND t07.id = 4
                ORDER BY t01.ordenamiento";
    
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $resultHemograma = $stm->fetchAll();
                $datos_hemograma = array();
                $datos_hemograma = $resultHemograma;
                $array_datos["datos_hemograma"] =  $datos_hemograma;
            }

            $datos_examenes = array();
            
            if($resultIds[$i]["id_examen"] != "4" && $resultIds[$i]["id_examen"] != "6" && $resultIds[$i]["id_examen"] != "16"){
                for ($i=0; $i < count($resultIdsArea); $i++) { 
                    $resultIdsArea[$i];

                    if ($resultIdsArea[$i]["id_area"] == 1) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 1
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_1 = array();
                        $datos_1 = $result;
                        $datos_examenes["datos_1"] =  $datos_1;
                    }
                    if(!array_key_exists('datos_1', $datos_examenes)){
                        $datos_examenes["datos_1"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 2) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 2
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_2 = array();
                        $datos_2 = $result;
                        $datos_examenes["datos_2"] =  $datos_2;
                    }
                    if(!array_key_exists('datos_2', $datos_examenes)){
                        $datos_examenes["datos_2"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 3) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 3
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_3 = array();
                        $datos_3 = $result;
                        $datos_examenes["datos_3"] =  $datos_3;
                    }
                    if(!array_key_exists('datos_3', $datos_examenes)){
                        $datos_examenes["datos_3"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 4) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 4
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_4 = array();
                        $datos_4 = $result;
                        $datos_examenes["datos_4"] =  $datos_4;
                    }
                    if(!array_key_exists('datos_4', $datos_examenes)){
                        $datos_examenes["datos_4"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 5) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 5
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_5 = array();
                        $datos_5 = $result;
                        $datos_examenes["datos_5"] =  $datos_5;
                    }
                    if(!array_key_exists('datos_5', $datos_examenes)){
                        $datos_examenes["datos_5"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 6) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 6
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_6 = array();
                        $datos_6 = $result;
                        $datos_examenes["datos_6"] =  $datos_6;
                    }
                    if(!array_key_exists('datos_6', $datos_examenes)){
                        $datos_examenes["datos_6"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 7) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 7
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_7 = array();
                        $datos_7 = $result;
                        $datos_examenes["datos_7"] =  $datos_7;
                    }
                    if(!array_key_exists('datos_7', $datos_examenes)){
                        $datos_examenes["datos_7"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 8) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 8
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_8 = array();
                        $datos_8 = $result;
                        $datos_examenes["datos_8"] = $datos_8;
                    }
                    if(!array_key_exists('datos_8', $datos_examenes)){
                        $datos_examenes["datos_8"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 9) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 9
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_9 = array();
                        $datos_9 = $result;
                        $datos_examenes["datos_9"] = $datos_9;
                    }
                    if(!array_key_exists('datos_9', $datos_examenes)){
                        $datos_examenes["datos_9"] = "";
                    }
                    if ($resultIdsArea[$i]["id_area"] == 10) {
                        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                            t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                            t08.id AS id_area, t08.nombre_area, t03.observacion
                            FROM mnt_elementos t01 
                                LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                                LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                                LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                                LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                            WHERE t03.id_orden = $idOrden
                            AND t07.id != 4 AND t07.id != 6 AND t07.id != 16 AND t08.id = 10
                            ORDER BY t01.ordenamiento";
                
                        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                        $stm->execute();
                        $result = $stm->fetchAll();
                        $datos_10 = array();
                        $datos_10 = $result;
                        $datos_examenes["datos_10"] = $datos_10;
                    }
                    if(!array_key_exists('datos_10', $datos_examenes)){
                        $datos_examenes["datos_10"] = "";
                    }
                }
                
            }
        }

        return $this->render('Reportes/reporte_resultados.html.twig',
            array(
                //DATOS ORINA, HECES, HEMOGRAMA
                "arrays"=>$array_datos,
                //DATOS RESTO DE EXAMENES
                "datos"=>$datos_examenes,
                //DATOS DE ENCABEZADO
                "datos_head"=>$resultHead,
                //"datos_ids"=>$resultIds,
            ),
        );
    }

    /**
    * @Route("/cargar/datos/heces", name="cargar_datos_heces")
    */
    public function loadDataHeces(): Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        $idDetOrden = $request->get('idDetOrden');
        $idOrden = $request->get('idOrden');
        /* QUERY HEADER */
        $sqlHead = "SELECT t01.nombre, t01.apellido, t02.fecha_orden, t03.nombre AS nombre_medico, 
                        t03.apellido AS apellido_medico,
                        TIMESTAMPDIFF(YEAR,t01.fecha_nacimiento,CURDATE()) AS edad_anios,
                        TIMESTAMPDIFF(MONTH,t01.fecha_nacimiento,CURDATE()) AS edad_meses,
                        TIMESTAMPDIFF(DAY,t01.fecha_nacimiento,CURDATE()) AS edad_dias 
                    
                    FROM mnt_paciente t01
                    
                    LEFT JOIN lab_orden t02 ON t01.id = t02.id_paciente
                    LEFT JOIN mnt_medico t03 ON t03.id = t02.id_medico
                    
                    WHERE t02.id = $idOrden";

        $stm = $this->getDoctrine()->getConnection()->prepare($sqlHead);
        $stm->execute();
        $resultHead = $stm->fetchAll();        
        /* END QUERY HEADER */

        /* QUERY DATA GENERAL DE HECES */
        $sql = "SELECT t1.id, t1.nombre_elemento, t1.id_tipo_elemento, t1.valor_inicial, t1.valor_final, 
                        t1.unidades, t6.resultado, t6.observacion, t2.id AS id_examen
                FROM mnt_elementos t1
                LEFT JOIN ctl_examen t2 ON t2.id = t1.id_examen
                LEFT JOIN lab_detalle_orden t3 ON t3.id_examen = t2.id
                LEFT JOIN lab_orden t4 ON t4.id = t3.id_orden
                LEFT JOIN mnt_paciente t5 ON t5.id = t4.id_paciente
                LEFT JOIN lab_resultados t6 ON t6.id_elemento = t1.id
                WHERE t4.id = $idOrden 
                AND t2.id = $idExamen 
                AND (t1.id_rango_edad = 3 OR t1.id_rango_edad IS NULL) 
                AND (t1.id_sexo = 2 OR t1.id_sexo IS NULL) 
                AND (t6.id_detalle_orden = $idDetOrden OR t6.id_detalle_orden IS NULL)
                ORDER BY t1.ordenamiento";
    
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $resultHeces = $stm->fetchAll();
        $datos_heces = array();
        $datos_heces = $resultHeces;
        $array_datos["datos_heces"] = $datos_heces;
        /* END QUERY GENERAL DE HECES */
        
        return $this->render('Reportes/report_heces.html.twig',
            array(
                "datos_head" => $resultHead,
                "arrays" => $array_datos
            )
        );
    }
    /**
    * @Route("/cargar/datos/orina", name="cargar_datos_orina")
    */
    public function loadDataOrina() : Response{
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        $idDetOrden = $request->get('idDetOrden');
        $idOrden = $request->get('idOrden');
        /* QUERY HEADER */
        $sqlHead = "SELECT t01.nombre, t01.apellido, t02.fecha_orden, t03.nombre AS nombre_medico, 
                        t03.apellido AS apellido_medico,
                        TIMESTAMPDIFF(YEAR,t01.fecha_nacimiento,CURDATE()) AS edad_anios,
                        TIMESTAMPDIFF(MONTH,t01.fecha_nacimiento,CURDATE()) AS edad_meses,
                        TIMESTAMPDIFF(DAY,t01.fecha_nacimiento,CURDATE()) AS edad_dias 
                    
                    FROM mnt_paciente t01
                    
                    LEFT JOIN lab_orden t02 ON t01.id = t02.id_paciente
                    LEFT JOIN mnt_medico t03 ON t03.id = t02.id_medico
                    
                    WHERE t02.id = $idOrden";

        $stm = $this->getDoctrine()->getConnection()->prepare($sqlHead);
        $stm->execute();
        $resultHead = $stm->fetchAll();        
        /* END QUERY HEADER */

        /* QUERY DATA GENERAL DE ORINA */
        $sql = "SELECT t1.id, t1.nombre_elemento, t1.id_tipo_elemento, t1.valor_inicial, t1.valor_final, 
                        t1.unidades, t6.resultado, t6.observacion, t2.id AS id_examen, t2.nombre_examen
                FROM mnt_elementos t1
                LEFT JOIN ctl_examen t2 ON t2.id = t1.id_examen
                LEFT JOIN lab_detalle_orden t3 ON t3.id_examen = t2.id
                LEFT JOIN lab_orden t4 ON t4.id = t3.id_orden
                LEFT JOIN mnt_paciente t5 ON t5.id = t4.id_paciente
                LEFT JOIN lab_resultados t6 ON t6.id_elemento = t1.id
                WHERE t4.id = $idOrden 
                AND t2.id = $idExamen 
                AND (t1.id_rango_edad = 3 OR t1.id_rango_edad IS NULL) 
                AND (t1.id_sexo = 2 OR t1.id_sexo IS NULL) 
                AND (t6.id_detalle_orden = $idDetOrden OR t6.id_detalle_orden IS NULL)
                ORDER BY t1.ordenamiento";
    
        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->render('Reportes/report_orina.html.twig',
            array(
                "datos_head" => $resultHead,
                "arrays" => $result
            )
        );
    }
        
}
