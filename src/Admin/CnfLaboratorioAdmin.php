<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


final class CnfLaboratorioAdmin extends AbstractAdmin
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
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
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
         ->with('Laboratorio',['class' => 'col-md-5'])
            ->add('nombreLaboratorio', TextType::class)
            ->add('representanteLegal')
            ->add('direccion', TextType::class)
            ->add('telefono', TextType::class)
            ->add('correoElectronico')
            ->add('logo')
         ->end() 
        ;
           
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('nombreLaboratorio')
            ->add('representanteLegal')
            ->add('direccion')
            ->add('telefono')
            ->add('correoElectronico')
            ->add('logo')
            ->add('activo')
            ;
    }

    public function prePersist($form) : void {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioReg($user);
        $form->setFechahoraReg(new \Datetime());
    }

    public function preUpdate($form) : void {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $form->setIdUsuarioMod($user);
        $form->setFechahoraMod(new \Datetime());
    }

}
