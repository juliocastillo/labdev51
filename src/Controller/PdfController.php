<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;

class HtmlToPdf extends AbstractController
{
    /**
    * @Route("/generate-pdf", name="generate_pdf")
    */

    public function convertPdf(Pdf $pdf){
        $html = $this->renderView('pdf/pdf.html.twig');
        $filename = 'filename.pdf';

        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $filename
        );
    }
}
