<?php

declare(strict_types=1);

namespace App\Admin;

use App\Entity\CtlAreaLaboratorio;
use App\Entity\CtlExamen;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ContainerInterface;


final class CtlExamenAdmin extends AbstractAdmin
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
            ->add('nombreExamen')
            ->add('idAreaLaboratorio')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('precio')
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
        ->with('Datos',['class' => 'col-md-5'])
                ->add('idAreaLaboratorio', EntityType::class,[
                    'class' => CtlAreaLaboratorio::class,
                    'label' => 'Area de Laboratorio',
                    'placeholder' => "Seleccionar..."
                    ]    
                )
                ->add('nombreExamen', TextType::class, ['attr' => [
                    'placeholder' => 'Nombre de Examen...',
                    ]
                ])
                ->add('precio', NumberType::class, ['attr' => [
                    'placeholder' => 'Precio Examen...',
                    ]
                ])
                //->add('activo')
        ->end()
           
            ;
            if ($id) {  // cuando se edite el registro
                if ($entity->getActivo() == TRUE) { // si el registro esta activo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE,
                                'attr' => array(
                                    'checked' => 'checked'
                    )));
                } else { // si el registro esta inactivo
                    $formMapper
                            ->add('activo', null, array(
                                'label' => 'Activo',
                                'required' => FALSE
                    ));
                }
            } else { // cuando se crea el registro
                $formMapper
                        ->add('activo', null, array(
                            'label' => 'Activo',
                            'required' => FALSE,
                            'attr' => array(
                                'checked' => 'checked'
                )));
            }
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('idAreaLaboratorio')    
            ->add('nombreExamen')
            ->add('activo')
            ;
    }

    public function prePersist($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioReg($user);
        $alias->setFechahoraReg(new \DateTime());
    }

    public function preUpdate($alias) : void {
        // llenar campos de auditoria
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $alias->setIdUsuarioMod($user);
        $alias->setFechahoraMod(new \DateTime());
    }

}
