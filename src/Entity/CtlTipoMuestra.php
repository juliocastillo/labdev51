<?php

namespace App\Entity;

use App\Repository\CtlTipoMuestraRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlTipoMuestraRepository::class)
 */
class CtlTipoMuestra
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
    private $tipoMuestra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipoMuestra(): ?string
    {
        return $this->tipoMuestra;
    }

    public function setTipoMuestra(string $tipoMuestra): self
    {
        $this->tipoMuestra = $tipoMuestra;

        return $this;
    }
    
    public function __toString() {
        return $this->tipoMuestra ? (string) $this->tipoMuestra : ''; 
    }
}
