<?php

namespace App\Entity;

use App\Repository\CtlTemplateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CtlTemplateRepository::class)
 * @UniqueEntity("nombreTemplate", message="Ya existe un template con este nombre!")
 */
class CtlTemplate
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
     * @Assert\Length(min=5,minMessage="El nombre debe tener al menos 5 caracteres.")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z]/", message="El nombre debe iniciar con una letra Mayuscula. | No se permiten sólo números o caracteres especiales.")
     */
    private $nombreTemplate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnombreTemplate(): ?string
    {
        return $this->nombreTemplate;
    }

    public function setnombreTemplate(string $nombreTemplate): self
    {
        $this->nombreTemplate = $nombreTemplate;

        return $this;
    }

    public function __toString() {
        return $this->nombreTemplate ? (string) $this->nombreTemplate : ''; 
    }
}
