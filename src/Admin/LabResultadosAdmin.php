<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlMicroorganismo;
use App\Entity\MntElementos;
use App\Entity\MntEmpleado;
use App\Entity\LabDetalleOrden;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Route\RouteCollectionInterface;

final class LabResultadosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('observacion')
            ->add('cantidad')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('id')
            ->add('observacion')
            ->add('cantidad')
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
        $entity = $this->getSubject();   //obtiene el elemento seleccionado en un objeto
        $id = $entity->getId();

        $formMapper
            ->with('Datos',['class' => 'col-md-6'])
                ->add('idDetalleOrden', EntityType::class,[
                    'class' => LabDetalleOrden::class,
                    'label' => 'Detalle Orden',
                ])
                ->add('idElemento', EntityType::class,[
                    'class' => MntElementos::class,
                    'label' => 'Elemento',
                ])
                ->add('idEmpleado', EntityType::class,[
                    'class' => MntEmpleado::class,
                    'label' => 'Empleado',
                ])
                ->add('idMicroorganismo', EntityType::class,[
                    'class' => CtlMicroorganismo::class,
                    'label' => 'Microorganismo',
                ])
            ->end()
            ->with('Complemento',['class' => 'col-md-6'])
                ->add('cantidad')
                ->add('observacion', TextareaType::class, [
                    'required' => FALSE,
                ])
                ->add('activo')
            ->end()
            ;

            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                    ->with('Complemento',['class' => 'col-md-6'])
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE,
                                'attr' => array(
                                    'checked' => 'checked',
                    )))
                    ->end()
                    ;
                } else { // si el registro esta inactivo
                    $formMapper
                    ->with('Complemento',['class' => 'col-md-6'])
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ))
                    ->end()
                    ;
                }
            } else { // cuando se crea el registro
                $formMapper
                ->with('Complemento',['class' => 'col-md-6'])
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked'
                )))
                ->end()
                ;
            }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('observacion')
            ->add('cantidad')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        // on clear para quitar rutas.
        $collection
            ->add('index', 'index');
    }
    
      
    
//
//    public function getTemplate($name) {
//        switch ($name) {
//            case 'list':
//                return 'CRUD/LabResultados/list.html.twig';
//                break;
//            default:
//                return parent::getTemplate($name);
//                break;
//        }
//    }




}
