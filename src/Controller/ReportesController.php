<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
//use Knp\Snappy\Pdf;
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

        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, 
                t01.valor_final, t01.unidades, t02.resultado, t06.nombre AS nombre_medico, t05.nombre, 
                t05.apellido,t04.fecha_orden,t07.id AS id_examen, t07.nombre_examen,
                TIMESTAMPDIFF(YEAR,t05.fecha_nacimiento,CURDATE()) AS edad_anios,
                TIMESTAMPDIFF(MONTH,t05.fecha_nacimiento,CURDATE()) AS edad_meses,
                TIMESTAMPDIFF(DAY,t05.fecha_nacimiento,CURDATE()) AS edad_dias

                FROM mnt_elementos t01 
                    LEFT JOIN lab_resultados t02 ON t01.id = t02.id_elemento
                    LEFT JOIN lab_detalle_orden t03 ON t03.id = t02.id_detalle_orden
                    LEFT JOIN lab_orden t04 ON t04.id = t03.id_orden 
                    LEFT JOIN mnt_paciente t05 ON t05.id = t04.id_paciente
                    LEFT JOIN mnt_medico t06 ON t06.id = t04.id_medico
                    LEFT JOIN ctl_examen t07 ON t07.id = t03.id_examen
                WHERE t01.id_examen = $idExamen 
                AND t03.id = $idDetOrden
                ORDER BY t01.ordenamiento";

        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        /* $html = $this->renderView(
            "Reportes/reporte_resultados.html.twig",
            array(
                "datos"=>$result,
            ),
        ); */

        

        /* $response = new PdfResponse(
            $pdf->getOutputFromHtml($html),
            'file.pdf',
        ); */

        /* $response->headers->set('Content-Disposition','inline');
        return $response; */

        
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


        return $this->render('Reportes/reporte_resultados.html.twig',
            array(
                "datos" => $result,
                
            )
        );

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
