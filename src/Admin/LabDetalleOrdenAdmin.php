<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\CtlExamen;
use App\Entity\CtlTipoMuestra;

final class LabDetalleOrdenAdmin extends AbstractAdmin
{
    public function __construct($code, $class, $baseControllerName, $container = null)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->add('idExamen', EntityType::class, [
                    'class' => CtlExamen::class,
                    'label' => 'Examen',
                ])
            ->add('idTipoMuestra', EntityType::class, [
                    'class' => CtlTipoMuestra::class,
                    'label' => 'Tipo de muestra',
                    'required' => true,
                    'placeholder' => "Seleccionar..."
                ])
            ->add('precio', TextType::class, [
                    'required' => false,
                    'attr' => array('style' => 'width:200px',  'readonly' => true,)
                ]);
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
       
    }
    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $em = $this->container->get('doctrine')->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
        $alias->setFechaOrden(new \DateTime());
        $alias->setActivo(TRUE);
        //$estadoExamen = $em->getRepository('App:CtlEstadoExamen')->find(1);
        
        $estadoOrden = $em->getRepository('App:CtlEstadoOrden'::class)->find(1);
        $alias->setIdEstadoOrden($estadoOrden);
    }

    public function preUpdate($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }
}
