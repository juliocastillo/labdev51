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
    public function loadData(): Response {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $idExamen = $request->get('idExamen');
        $idDetOrden = $request->get('idDetOrden');

        $sql = "SELECT t01.id, t01.nombre_elemento, t01.id_tipo_elemento, t01.valor_inicial, t01.valor_final, t01.unidades,
                t02.resultado
        FROM mnt_elementos t01 
            left join lab_resultados t02 on t01.id = t02.id_elemento
            left join lab_detalle_orden t03 on t03.id = t02.id_detalle_orden
            left join lab_orden t04 on t04.id = t03.id_orden 
            left join mnt_paciente t05 on t05.id = t04.id_paciente 
        WHERE t01.id_examen = $idExamen 
        -- AND t03.id = $idDetOrden
        ORDER BY t01.ordenamiento";

        $stm = $this->getDoctrine()->getConnection()->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        //var_dump($result); exit();

        return $this->render('Reportes/reporte_resultados.html.twig',
            array(
                "datos" => $result,
            )
        );
    }

    /**
    * @Route("/mostrar-datos", name="mostrar_datos")
    */
    /* public function loadPage(){
        return $this->render("Reportes/reporte_resultados.html.twig"
            array(
                "datos" => $datos,
            )
        );
    } */

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
