<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class LabOrdenAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('fechaOrden')
            ->add('fechaTomaMuestra')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('fechaOrden')
            ->add('fechaTomaMuestra')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Datos de la orden', ['class' => 'col-md-6'])
                ->add('fechaTomaMuestra', DateType::class, [
                        'widget' => 'single_text',
                        'label' => 'Fecha de la muestra',
                        'attr' => array('style' => 'width:200px')
                    ])
                ->add('idPaciente', ModelListType::class, [
                        'label' => 'Paciente',
                        'required' => true,
                        'btn_delete' => false,
                        'btn_list' => 'Buscar cliente',
                    ])
                ->add('idMedico', ModelListType::class, [
                        'label' => 'Medico',
                        'required' => false,
                        'btn_delete' => false,
                        'btn_list' => 'Buscar cliente',
                    ])
            ->end()
            ->with('Documento',['class' => 'col-md-6'])
                ->add('numeroDocumento', TextType::Class, [
                        'label' => 'Numero',
                        'attr' => array('style' => 'width:500px')
                    ])
                ->add('idTipoDocumento',null ,array(
                        'label' => 'Tipo de documento',
                        'attr' => array('style' => 'width:500px')
                    ))
                ->add('idFormaPago',null ,array(
                        'label' => 'Forma Pago',
                        'attr' => array('style' => 'width:500px')
                    ))
                ->end()
            ->with('Detalle')
                ->add('labDetalleOrdens', CollectionType::class, [
                    'label' => 'Items'], array(
                    'edit' => 'inline',
                    'inline' => 'table')
                )
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('fechaOrden')
            ->add('fechaTomaMuestra')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }
    

    public function prePersist($form) : void {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioReg($user);
        $form->setFechahoraReg(new \Datetime());
        $form->setFechaOrden(new \Datetime());
        $form->setActivo(true);
        
        // obtener el estado principal Digitada
        $estadoOrden = $em->getRepository('App:CtlEstadoOrden')->find(1);
        $form->setIdEstadoOrden($estadoOrden);
        
        $estadoExamen = $em->getRepository('App:CtlEstadoExamen')->find(1);
        
        foreach ($form->getLabDetalleOrdens() as $item) {
            // obtener el examen
            $examen = $em->getRepository('App:CtlExamen')->find($item->getIdExamen());
            $item->setIdUsuarioReg($user);
            $item->setFechahoraReg(new \Datetime());
            $item->setIdEstadoExamen($estadoExamen);
            //if (!$item->getPrecio()) {
                $item->setPrecio($examen->getPrecio());
            //}
        }
    }

    public function preUpdate($form) : void {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioMod($user);
        $form->setFechahoraMod(new \Datetime());
        
        $estadoExamen = $em->getRepository('App:CtlEstadoExamen')->find(1);
        
        foreach ($form->getLabDetalleOrdens() as $item) {
            // obtener el examen
            $examen = $em->getRepository('App:CtlExamen')->find($item->getIdExamen());
            if (!$item->getIdEstadoExamen()) {
                $item->setIdUsuarioReg($user);
                $item->setFechahoraReg(new \Datetime());
                $item->setIdEstadoExamen($estadoExamen);
            }
            //if (!$item->getPrecio()) {
                $item->setPrecio($examen->getPrecio());
            //}
            $item->setIdUsuarioMod($user);
            $item->setFechahoraMod(new \Datetime());
        }
    }
    
    
    
    
    
}
