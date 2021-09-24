<?php

namespace App\EventListener;

use Sonata\AdminBundle\Event\ConfigureMenuEvent;

/**
 * Class MenuBuilderListener
 * @package AdminBundle\EventListener
 */
class MenuBuilderListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function adminMenuItems(ConfigureMenuEvent $event)
    {
        // Esta es la funcionalidad para agregar opciones estáticas al menú de Sonata
        $event->getMenu()
            ->addChild('Ordenes', ['route' => ''])
            ->setExtras(
                [
                    'icon' => '<span class="fa fa-file"></span>&nbsp;',
                ]
            )
            ->setLabel('Ordenes')
            ->addChild('orden_de_laboratorio', ['route' => 'admin_app_laborden_index'])
            ->setLabel('Ordenes de laboratorio')
            ->getParent()
            ->addChild('ordenes_completas', ['route' => 'ordenes_completas_list'])
            ->setLabel('Ordenes Completas')
            ->getParent();
        
        $event->getMenu()
            ->addChild('Resultados', ['route' => ''])
            ->setExtras(
                [
                    'icon' => '<span class="fa fa-file"></span>&nbsp;',
                ]
            )
            ->setLabel('Resultados')
            ->addChild('resultados_de_laboratorio', ['route' => 'admin_app_labresultados_index'])
            ->setLabel('Resultados de laboratorio')
            ->getParent();
        
        $event->getMenu()
            ->addChild('Reportes', ['route' => ''])
            ->setExtras(
                [
                    'icon' => '<span class="fa fa-file-pdf-o"></span>&nbsp;',
                ]
            )
            ->setLabel('Reportes')
            ->addChild('pruebas_realizadas', ['route' => 'pruebas_list'])
            ->setLabel('Pruebas Realizadas')
            ->getParent();
    }
}
