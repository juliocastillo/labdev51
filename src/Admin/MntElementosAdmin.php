<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlExamen;
use App\Entity\CtlRangoEdad;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlSexo;
use App\Entity\CtlTipoElemento;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


final class MntElementosAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            ->add('nombreElemento')
            ->add('valorInicial')
            ->add('valorFinal')
            ->add('unidades')
            ->add('observacion')
            ->add('ordenamiento')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreElemento')
            ->add('idTipoElemento', EntityType::class,[
                'label' => 'Tipo de Elemento',
            ])
            ->add('idExamen', EntityType::class,[
                'label' => 'Examen',
            ])
            ->add('unidades')
            ->add('ordenamiento')
            ->add('idSexo', EntityType::class,[
                'label' => 'Sexo',
            ])
            ->add('idRangoEdad', EntityType::class,[
                'label' => 'Rango de Edad',
            ])
            ->add('valorInicial')
            ->add('valorFinal')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('observacion')
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
            ->with('Datos',['class' => 'col-lg-6 col-md-6 col-xs-6 '])
                ->add('nombreElemento', TextType::class, ['row_attr' => [
                    //'class' => 'col-md-12',
                    ]
                ])
                ->add('idTipoElemento', EntityType::class,[
                    'class' => CtlTipoElemento::class,
                    'label' => 'Tipo de Elemento',
                    'row_attr' => [
                        //'class' => 'col-md-12',
                    ]
                ])
                ->add('idExamen', EntityType::class,[
                    'class' => CtlExamen::class,
                    'label' => 'Examen',
                    'row_attr' => [
                        //'class' => 'col-md-12',
                    ]
                ])
                ->add('unidades', TextType::class, ['row_attr' => [
                    //'class' => 'col-md-6',
                    ],
                    'required' => FALSE

                ])
                ->add('ordenamiento', IntegerType::class, ['row_attr' => [
                    //'class' => 'col-md-6',
                    ],
                    'label' => 'Orden',
                ])
                ->add('idSexo', EntityType::class,[
                    'class' => CtlSexo::class,
                    'label' => 'Sexo',
                    'row_attr' => [
                        //'class' => 'col-md-6',
                    ]
                ])
                ->add('idRangoEdad', EntityType::class,[
                    'class' => CtlRangoEdad::class,
                    'label' => 'Rango Edad',
                    'row_attr' => [
                        //'class' => 'col-md-6',
                    ]
                ])
                ->add('observacion', TextareaType::class,['row_attr' => [
                    //'class' => 'col-md-12',
                    ],
                    'required' => FALSE
                ])
            -> end()
            ->with('Rangos',['class' => 'col-md-6'])
                ->add('valorInicial', TextType::class, ['row_attr' => [
                    //'class' => 'col-md-6',
                    ],
                    'required' => FALSE
                ])
                ->add('valorFinal', TextType::class, ['row_attr' => [
                    //'class' => 'col-md-6',
                    ],
                    'required' => FALSE
                ])
                ->add('fechaInicio', DateType::class,[
                    'widget' => 'single_text',
                    'row_attr' => [
                     //   'class' => 'col-md-6'
                    ],
                    'required' => FALSE
                ])
                ->add('fechaFin', DateType::class,[
                    'widget' => 'single_text',
                    'row_attr' => [
                      //  'class' => 'col-md-6'
                    ],
                    'required' => FALSE
                ])
                ->add('activo', CheckboxType::class, [
                    'row_attr' => [
                       // 'class' => 'col-md-6',
                    ]
                ])
            ->end()
            ;
            
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                    ->with('Datos',['class' => 'col-md-6'])
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
                    ->with('Datos',['class' => 'col-md-6'])
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ))
                    ->end()
                    ;
                }
            } else { // cuando se crea el registro
                $formMapper
                ->with('Datos',['class' => 'col-md-6'])
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
            ->add('nombreElemento')
            ->add('valorInicial')
            ->add('valorFinal')
            ->add('unidades')
            ->add('observacion')
            ->add('ordenamiento')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('fechahoraReg')
            ->add('fechahoraMod')
            ->add('activo')
            ;
    }

    /* public function getTemplate($name) {
        switch ($name) {
            case 'list':
                return 'CRUD/CtlEmpresa/list.html.twig';
                break;
            case 'edit':
                return 'CRUD/CtlEmpresa/edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    } */


    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
    }

    public function preUpdate($alias) : void {
        // llenar campos de auditoria
        $user = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }
}