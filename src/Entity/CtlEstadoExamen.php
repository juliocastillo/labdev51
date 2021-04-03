<?php

namespace App\Entity;

use App\Repository\CtlEstadoExamenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlEstadoExamenRepository::class)
 */
class CtlEstadoExamen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $estado_examen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstadoExamen(): ?string
    {
        return $this->estado_examen;
    }

    public function setEstadoExamen(string $estado_examen): self
    {
        $this->estado_examen = $estado_examen;

        return $this;
    }
}
