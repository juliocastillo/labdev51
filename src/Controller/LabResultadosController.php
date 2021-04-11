<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LabResultadosController extends AbstractController
{
    /**
     * @Route("/lab/resultados", name="lab_resultados")
     */
    public function index(): Response
    {
        return $this->render('lab_resultados/index.html.twig', [
            'controller_name' => 'LabResultadosController',
        ]);
    }





    
}
