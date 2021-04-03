<?php

namespace App\Entity;

use App\Repository\CtlEstadoOrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlEstadoOrdenRepository::class)
 */
class CtlEstadoOrden
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nombreEstado;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEstado(): ?string
    {
        return $this->nombreEstado;
    }

    public function setNombreEstado(string $nombreEstado): self
    {
        $this->nombreEstado = $nombreEstado;

        return $this;
    }

    public function __toString() {
        return $this->nombreEstado ? (string) $this->nombreEstado : ''; 
    }
}
