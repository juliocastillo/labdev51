<?php

namespace App\Entity;

use App\Repository\CtlFormaPagoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlFormaPagoRepository::class)
 */
class CtlFormaPago
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
    private $nombre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
    
    
    public function __toString() {
        return $this->nombre  ? (string) $this->nombre : ''; 
    }

    
}
