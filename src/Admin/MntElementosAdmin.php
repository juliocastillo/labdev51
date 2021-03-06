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
use Exception;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\DependencyInjection\ContainerInterface;


final class MntElementosAdmin extends AbstractAdmin
{
     /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct($code, $class, $baseControllerName, $container = null)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->container = $container;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
            /* ->add('nombreElemento')
            ->add('valorInicial')
            ->add('valorFinal')
            ->add('unidades')
            ->add('observacion')
            ->add('ordenamiento')
            ->add('fechaInicio')
            ->add('fechaFin')
            ->add('fechahoraReg')
            ->add('fechahoraMod') */
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('nombreElemento',null,[
                'route' => array('name' => 'show')
            ])
            ->add('idTipoElemento')
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
        $id     = $entity->getId();
        $fecha  = new \DateTime();

        $formMapper
            ->add('nombreElemento', TextType::class, [
                'required'      => FALSE,
                'label'         => 'Nombre de Elemento*',
                'attr'          => [
                    'placeholder'   => 'Linea Plaquetaria...'
                ]
                
            ])
            ->add('idTipoElemento', EntityType::class,[
                'class'         => CtlTipoElemento::class,
                'label'         => 'Tipo de Elemento*',
                'placeholder'   => 'Seleccionar...',
                'required'   => FALSE
            ])
            ->add('idExamen', EntityType::class,[
                'class' => CtlExamen::class,
                'label' => 'Examen*',
                'placeholder' => "Seleccionar...",
                'required'   => FALSE
            ])
            ->add('unidades', TextType::class,[ 
                'attr' => [
                    'placeholder' => 'mg/dL...',
                ],
                'required'  => FALSE
            ])
            ->add('ordenamiento', IntegerType::class, ['attr' => [
                    'min'           => '1',
                    'placeholder'   => '1'
                ],
                'label'         => 'Orden*',
                'required'      => FALSE,
            ])
            ->add('idSexo', EntityType::class,[
                'class' => CtlSexo::class,
                'label' => 'Sexo',
                'placeholder' => "Seleccionar...",
                'required' => FALSE
            ])
            ->add('idRangoEdad', EntityType::class,[
                'class' => CtlRangoEdad::class,
                'label' => 'Rango Edad',
                'placeholder' => "Seleccionar...",
                'required' => FALSE
            ])
            ->add('observacion', TextareaType::class,['attr' => [
                ],
                'required' => FALSE,
            ])
            ->add('valorInicial', NumberType::class, ['attr' => [
                'style' => 'width: 70%',
                'placeholder' => "0.0",
                ],
                'required' => FALSE
            ])
            ->add('valorFinal', NumberType::class, ['attr' => [
                'style' => 'width: 70%',
                'placeholder' => "0.0",
                ],
                'required' => FALSE
            ])
            ->add('fechaInicio', DateType::class,[
                'widget'    => 'single_text',
                'data'      => $fecha,
                'attr'      => [
                    'style'     => 'width: 70%;',
                ],
                'required'   => FALSE,
                'label'     => 'Fecha Inicio*'
            ])
            ->add('fechaFin', DateType::class,[
                'widget'    => 'single_text',
                'required' => FALSE,
                'attr'      => [
                    'style'     => 'width: 70%;',
                ]
            ])
            ;
            
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked',
                    )))
                    ;
                } else { // si el registro esta inactivo
                    $formMapper
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE
                    ))
                    ;
                }
            } else { // cuando se crea el registro
                $formMapper
                    ->add('activo', null, array(
                        'label' => 'Activo',
                        'required' => FALSE,
                        'attr' => array(
                            'checked' => 'checked'
                )))
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

    public function prePersist(object $alias) : void {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
    }
    
    public function validate(ErrorElement $errorElement, $object): void {
        $fechaInicio        = $object->getFechaInicio();
        $fechaFin           = $object->getFechaFin();

        if ($fechaInicio > $fechaFin && $fechaFin != null) {
            $errorElement->with('fechaInicio')
                            ->addViolation('La fecha inicio no puede ser mayor a la fecha fin')
                         ->end();
        }
    }

    public function preUpdate(object $alias) : void {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }
    
}