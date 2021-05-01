<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CtlMicroorganismoRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=CtlMicroorganismoRepository::class)
 * @UniqueEntity("nombreMicroorganismo", message="Ya existe un microorganismo con este nombre!")
 */
class CtlMicroorganismo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotNull(message="Este campo no puede quedar vacío.")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]/", message="El nombre debe iniciar con una letra Mayuscula. | No se permite sólo números o caracteres especiales.")
     */
    private $nombreMicroorganismo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreMicroorganismo(): ?string
    {
        return $this->nombreMicroorganismo;
    }

    public function setNombreMicroorganismo(string $nombreMicroorganismo): self
    {
        $this->nombreMicroorganismo = $nombreMicroorganismo;

        return $this;
    }

    public function __toString() {
        return $this->nombreMicroorganismo ? (string) $this->nombreMicroorganismo : ''; 
    }
}
