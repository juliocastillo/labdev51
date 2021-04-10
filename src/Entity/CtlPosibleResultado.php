<?php

namespace App\Entity;

use App\Repository\CtlPosibleResultadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlPosibleResultadoRepository::class)
 */
class CtlPosibleResultado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombrePosibleResultado;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePosibleResultado(): ?string
    {
        return $this->nombrePosibleResultado;
    }

    public function setNombrePosibleResultado(string $nombrePosibleResultado): self
    {
        $this->nombrePosibleResultado = $nombrePosibleResultado;

        return $this;
    }

    public function __toString() {
        return $this->nombrePosibleResultado ? (string) $this->nombrePosibleResultado : ''; 
    }
}
