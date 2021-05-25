<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;

class PdfController extends AbstractController
{
    /**
    * @Route("/generate-pdf", name="generate_pdf")
    */

    public function convertPdf(Pdf $pdf): Response{
        /* $html = $this->render("pdf/pdf.html.twig");
        $filename = 'filename.pdf';

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $filename
        ); */

        $snappy = $this->get('knp_snappy.pdf');
        $filename = 'myFirstPdf';

        $pageUrl = $this->;generateUrl('sandbox')
    }
}
