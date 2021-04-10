<?php

namespace App\Entity;

use App\Repository\CtlMicroorganismoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlMicroorganismoRepository::class)
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
