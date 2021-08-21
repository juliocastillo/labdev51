<?php

namespace App\Entity;

use App\Repository\CtlAreaLaboratorioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlAreaLaboratorioRepository::class)
 */
class CtlAreaLaboratorio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreArea;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreArea(): ?string
    {
        return $this->nombreArea;
    }

    public function setNombreArea(string $nombreArea): self
    {
        $this->nombreArea = $nombreArea;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
    
    public function __toString() {
        return $this->nombreArea ? (string) $this->nombreArea : ''; 
    }
}
