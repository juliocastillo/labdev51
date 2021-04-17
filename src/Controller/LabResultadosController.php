<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use \Doctrine\ORM\Query;



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

    /**
     * @Route("/lab/resultados", name="ordeneslab")
     * @Method("GET")
     */

    public function getOrden(Request $request) : Response{
        $em         = $this->getDoctrine()->getConnection();
        $clue       = ltrim($request);
        $limit      = $request->get('page_limit');
        $page       = ($request->get('page') - 1) * 10;
        $id         = $request->get('id');
        $condition  = '';
        $template   = $this->admin->getTemplateRegistry()->getTemplate('lab_resultados');

        $sql = "SELECT id, fecha_orden, id_paciente
                FROM lab_orden
                WHERE $condition = ltrim(id,'0') ILIKE '$clue%'";

        $em->prepare($sql);
        $em->execute();
        $get_ordenes = $em->fetchAll();
        
        /* return $this->renderWithExtraParams($template, [
            'action' => 'index',
            'ordenes' => $ordenes,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ], null); */

        return new Response(json_encode($get_ordenes));
    }

    /**
     * @Route("/lab/ordenes", name="ordenes")
     * @Method("GET")
     */
    public function getOrdenAction(Request $request) : Response{
        $em             = $this->getDoctrine()->getConnection();
        $id             = $request->get('id') ? : null;
        $anotaciones    = null;
        $id_orden       = null;
        $result         = null;

        $id_orden = $em->getRepository('LabOrden')->findOneBy($id);

        $dql = "SELECT a
                FROM LabOrden a
                WHERE a.id = :id";
        
        $em->prepare($dql);
        $em->execute();
        $ordenes = $em->fetchAll();

        return $ordenes;   

    }
    
}
