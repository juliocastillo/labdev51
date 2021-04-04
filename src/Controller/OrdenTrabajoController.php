<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ControlesService;

class OrdenTrabajoController extends AbstractController
{
    /**
     * @Route("/ordentrabajo", name="ordentrabajo")
     */
    public function index(): Response
    {
        // definir el entity manger
        $em = $this->getDoctrine()->getManager();

        // definir la busqueda 
        $laboratorio = $em->getRepository('App:CnfLaboratorio')->find(1);
        $array[] = array(
            "id" => $laboratorio->getId(),
            "texto" => $laboratorio->getNombreLaboratorio()
        );
        return new Response(json_encode($array)
        );
    }



    /**
     * @Route("/ordentrabajo/get", name="ordentrabajo_get", options={"expose"=true})
     */
    public function getOrden(Request $request): Response
    {
        $param = $request->query->get('param');
        $array = array(
            "id" => 1,
            "data" => $param
        );
        return new Response(json_encode($array));
    }
    
    /**
     * @Route("/controles_sexo", name="controles_sexo", options={"expose"=true})
     */
    public function sexo(ControlesService $controlesService): Response
    {
        //instanciendo entity manager
        $em 		= $this->getDoctrine()->getManager();
        
        //cargar service para los controles
        $control    = $controlesService->sexo();
        return new Response($control);
    }
    
    
    
}
