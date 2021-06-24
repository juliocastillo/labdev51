<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookupInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Component\Validator\Constraints\Length;

//use Dompdf\Dompdf;
//use Dompdf\Options;

class ReportesController extends AbstractController
{
    /**
    * @Route("/cargar-datos", name="cargar_datos")
    */
    //Pdf $pdf
    public function loadData(EntrypointLookupInterface $entrypointLookup,Pdf $pdf): Response {
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

        //var_dump(count($resultIds)); exit();
        $array_datos = array();

        for ($i=0; $i < count($resultIds); $i++) { 
            $resultIds[$i];
            if ($resultIds[$i]["id_examen"] == "16") {
            
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen
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
                $array_datos["datos_orina"] = $resultOrina;
            }else{
                $array_datos["datos_orina"] = 0;
            }
            if ($resultIds[$i]["id_examen"] == "6") {
            
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen
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
                $array_datos["datos_heces"] .= $resultHeces;
            }else{
                $array_datos["datos_heces"] = 0;
            }
            if($resultIds[$i]["id_examen"] == "4"){
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen
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
                $array_datos["datos_hemograma"] =  $resultHemograma;
            }else{
                $array_datos["datos_hemograma"] = 0;
            }
            if($resultIds[$i]["id_examen"] != "4" && $resultIds[$i]["id_examen"] != "6" && $resultIds[$i]["id_examen"] != "16"){
                $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t07.id AS id_examen, t07.nombre_examen,
                t08.id AS id_area, t08.nombre_area
                FROM mnt_elementos t01 
                    LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                    LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                    LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                    LEFT JOIN ctl_area_laboratorio t08 ON t08.id = t07.id_area_laboratorio
                WHERE t03.id_orden = $idOrden
                AND t07.id != 4 AND t07.id != 6 AND t07.id != 16
                ORDER BY t01.ordenamiento";
    
                $stm = $this->getDoctrine()->getConnection()->prepare($sql);
                $stm->execute();
                $result = $stm->fetchAll();
                $array_datos["datos"] =  $result;
            }else{
                $array_datos["datos"] = 0;
            }
        }
        //var_dump($array_datos);
        //exit();
        $html = $this->renderView(
            "Reportes/reporte_resultados.html.twig",
            array(
                "arrays"=>$array_datos,
                //"datos_orina"=>$resultOrina,
                "datos_head"=>$resultHead,
                //"datos_ids"=>$resultIds,
            ),
        );

        $header = $this->renderView("Reportes/header.html.twig",
            array(
                "datos_head"=>$resultHead,
            ),
        );
        //$footer = $this->renderView("Reportes/footer.html.twig");

        $entrypointLookup->reset();
        //var_dump($resultIds); exit();
        
        
        $response = new PdfResponse(
            $pdf->getOutputFromHtml($html,
            [   
                'images' => true,
                'enable-javascript' => true,
                'page-size' => 'LETTER',
                'viewport-size' => '1280x1024',
                'header-html' => $header,
                'margin-top' => '80mm',
                'margin-bottom' => '20mm',
                //'footer-html' => $footer,
            ]),
            /* 200,
            array(
                'Content-Type' => 'application/pdf',
            ) */
            //'reporte_'.$idDetOrden.'.pdf',
        );

        $response->headers->set('Content-Disposition','inline');
        return $response;

        
        /* $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled',true);
        //$pdfOptions->set('defaultFont','Arial');
        $dompdf = new Dompdf($pdfOptions); */

        //$html = $this->renderView(
        //    "Reportes/reporte_resultados.html.twig",
        //    array(
        //        "datos"=>$result,
        //    ),
            /* json_encode(array(
                "idExamen"=>$idExamen,
                "idDetOrden"=>$idDetOrden
            )), */
            //['title' => 'PDF test',]
        //);
        
        /* $dompdf->loadHtml($html);
        $dompdf->render();
        ob_get_clean();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
            ]
        ); */

        /* return new Response(
            json_encode(array(
                "idExamen"=>$idExamen,
                "idDetOrden"=>$idDetOrden
            ))
        ); */
        //exit(0);
        

        /* return $this->render('Reportes/reporte_resultados.html.twig',
            array(
                "arrays" => $array_datos,
                "datos_head"=>$resultHead,
            )
        ); */

        //"nombre_medico" => $nombre_medico,
                //"nombre_paciente" => $nombre_paciente,
                //"apellido_paciente" => $apellido_paciente,
                //"edad_anios" => $edad_anios,
                //"edad_meses" => $edad_meses,
                //"edad_dias" => $edad_dias,
                //"fecha_orden" => $fecha_orden
    }

    /**
    * @Route("/cargar-pdf", name="cargar_pdf")
    */
    public function loadPdf() : Response {
        return $this->render("Reportes/pdf.html.twig");
    }

    /**
    * @Route("/generate-pdf", name="generate_pdf")
    */

    /* public function convertPdf() {

        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont','Arial');
        //$pdfOptions->set('public_path', '/home/carlitox/proyectos/labdev51/public/build/images');
        $pdfOptions->setIsRemoteEnabled(true);

        //$pdfOptions->set('tempDir','/home/carlitox/Descargas/pdf-export/tmp');

        $dompdf = new Dompdf($pdfOptions);

        $html = $this->render("pdf/pdf.html.twig",[
            'title' => 'PDF test'
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_get_clean();
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
            ]
        ); */
        //exit(0);

        //$response = new Response($dompdf);

        //return $dompdf;

        /* $html = $this->render("pdf/pdf.html.twig");
        $filename = 'filename.pdf';

        $response = new PdfResponse(
            $pdf->getOutputFromHtml($html, array(
                'print-media-type' => true,
                'encoding' => 'utf-8',
                'orientation' => 'Landscape',
            )),
        ); */

        
        //$response->headers->set('Content-Disposition', 'inline');
        //$response->setCharset('UTF-8');
        /* 'Content-Disposition', 'inline' */

        //return $response;

        /* $pdf->generateFromHtml(
            $this->renderView("pdf/pdf.html.twig",
            array(
                'Content-Disposition' => 'in-line',
            )
            ),
            '/home/carlitox/Descargas/file.pdf'
        ); */

        /* $html = $this->renderView('pdf/pdf.html.twig');

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'file.pdf',
            array(
                'Content-Disposition' => 'in-line',
            )
        ); */
    //}

    //{id_solicitud}

    
    
}
