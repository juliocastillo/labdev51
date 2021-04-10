<?php

namespace App\Entity;

use App\Repository\CtlPaisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlPaisRepository::class)
 */
class CtlPais
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
    private $nombrePais;

   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePais(): ?string
    {
        return $this->nombrePais;
    }

    public function setNombrePais(string $nombrePais): self
    {
        $this->nombrePais = $nombrePais;

        return $this;
    }

  
    public function __toString() {
        return $this->nombrePais ? (string) $this->nombrePais : ''; 
    }
}
