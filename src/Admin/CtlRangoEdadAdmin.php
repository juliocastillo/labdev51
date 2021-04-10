<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\DependencyInjection\ContainerInterface;


final class CtlRangoEdadAdmin extends AbstractAdmin
{

      protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('id')
           /* ->add('nombre')
            ->add('edadMinima')
            ->add('edadMaxima')
            ->add('tipoEdad')*/
            ->add('activo')
            ;
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->add('nombre')
            ->add('edadMinima')
            ->add('edadMaxima')
            ->add('tipoEdad')
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
            ->add('nombre', TextType::class, ['attr' => [
                'placeholder' => 'Nombre Rango...',
                ]
            ])
            ->add('edadMinima', TextType::class, ['attr' => [
                'placeholder' => 'Escriba edad minima...',
                ]
            ])
            ->add('edadMaxima', TextType::class, ['attr' => [
                'placeholder' => 'Escriba edad máxima...',
                ]
            ])
            ->add('tipoEdad', ChoiceType::class, [
                'choices' => [
                    'Días' => 1,
                    'Meses' => 2,
                    'Años' => 3,
                ],
            ])
            ->add('activo')
            ;
    
    }

    protected function configureShowFields(ShowMapper $showMapper): void
    {
        $showMapper
            ->add('id')
            ->add('nombre')
            ->add('edadMinima')
            ->add('edadMaxima')
            ->add('tipoEdad')
            ->add('activo')
            ;
    }
    
    public function prePersist($alias) : void {
        // validando rangos
        $edadMinima = $alias->getEdadMinima();
        $edadMaxima = $alias->getEdadMaxima();
        try {
            if ($edadMinima > $edadMaxima){
                throw new \Exception('Edad Minima debe ser menor a Edad Maxima');
                
            }        
        } catch (\Exception $e) {            
            //$this->addFlash('sonata_flash_error', $e);
            $this->getRequest()->getSession()->getFlashBag()->add("mytodo_success", "My To-Do custom success message");
        }
         
        
    }

    public function validate(ErrorElement $errorElement, $alias) : void {
        $edadMinima = $alias->getEdadMinima();
        $edadMaxima = $alias->getEdadMaxima();
        if ($edadMinima > $edadMaxima){
            //throw new \Exception('Edad Minima debe ser menor a Edad Maxima');
            $errorElement->with('edadMinima')
                    ->addViolation('Edad Minima debe ser menor a Edad Maxima')
                    ->end();  
        }       
       
          
    }

}
