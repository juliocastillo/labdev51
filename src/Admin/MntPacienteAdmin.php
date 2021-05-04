<?php

declare(strict_types=1);

namespace App\Admin;

use DateTime;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\CtlSexo;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;

final class MntPacienteAdmin extends AbstractAdmin
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
            ->add('nombre')
            ->add('apellido')
            ->add('idSexo')
            //->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombre')
            ->add('apellido')
            ->add('idSexo')
            ->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
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
        $fecha  = new \DateTime();
        
        $formMapper
            ->add('nombre', TextType::class, [
                'label'     => 'Nombre Paciente*',
                'required'  => FALSE,
            ])
            ->add('apellido', TextType::class,[
                'label'     => 'Apellido Paciente*',
                'required'  => FALSE,
            ])
            ->add('idSexo', EntityType::class,[
                'class' => CtlSexo::class,
                'label' => 'Sexo*',
                'placeholder' => "Seleccionar...",
                'required'  => FALSE,
                ])
            ->add('fechaNacimiento', DateType::class, [
                'widget' => 'single_text',
                'data'      => $fecha,
                'attr'      => [
                    
                ],
                
            ])
            ->add('telefono', TextType::class,[
                'attr'      => [
                    'placeholder' => '8888-8888',
                ],
                'required'  => FALSE,
            ])
            ->add('direccionPaciente')
            /* ->add('idDepartamento', EntityType::class, [
                'class' => CtlDepartamento::class,
                'label' => 'Departamento',
            ])
            ->add('idMunicipio', EntityType::class, [
                'class' => CtlMunicipio::class,
                'label' => 'Municipio',
            ]) */
            ->add('NRC', TextType::class,[
                'attr' => [
                    'placeholder' => '888888-8',
                ],
                'required'  => FALSE,
            ])
            ->add('NIT', TextType::class,[
                'attr' => [
                    'placeholder' => '8888-888888-888-8',
                ],
                'required'  => FALSE,
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
            ->add('nombreCompleto')
            ->add('apellidos')
            ->add('idSexo')
            ->add('fechaNacimiento')
            ->add('telefono')
            ->add('direccionPaciente')
            ->add('NRC')
            ->add('NIT')
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
