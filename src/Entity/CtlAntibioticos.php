<?php

namespace App\Entity;

use App\Repository\CtlAntibioticosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlAntibioticosRepository::class)
 */
class CtlAntibioticos
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
    private $nombreAntibiotico;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreAntibiotico(): ?string
    {
        return $this->nombreAntibiotico;
    }

    public function setNombreAntibiotico(string $nombreAntibiotico): self
    {
        $this->nombreAntibiotico = $nombreAntibiotico;

        return $this;
    }

    public function __toString() {
        return $this->nombreAntibiotico ? (string) $this->nombreAntibiotico : ''; 
    }
}
