<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LabDetalleOrdenController extends AbstractController
{
    /**
     * @Route("/lab/detalle/orden", name="lab_detalle_orden")
     */
    public function index(): Response
    {
        return $this->render('lab_detalle_orden/index.html.twig', [
            'controller_name' => 'LabDetalleOrdenController',
        ]);
    }
}
