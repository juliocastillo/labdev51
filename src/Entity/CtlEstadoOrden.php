<?php

namespace App\Entity;

use App\Repository\CtlEstadoOrdenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CtlEstadoOrdenRepository::class)
 * @UniqueEntity("nombreEstado", message="Ya existe un estado con este nombre!")
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
     * @ORM\Column(type="string", length=150, unique=true)
     * @Assert\NotNull(message="Este campo no puede quedar vacío.")
     * @Assert\Length(min=5,minMessage="El nombre debe tener al menos 5 caracteres.")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]/", message="El nombre debe iniciar con una letra Mayuscula. | No se permiten sólo números o caracteres especiales.")
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
