<?php

namespace App\Entity;

use App\Repository\CtlDepartamentoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlDepartamentoRepository::class)
 */
class CtlDepartamento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombreDepartamento;

    /**
     * @var \CtlPais
     *
     * @ORM\ManyToOne(targetEntity="CtlPais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id")
     * })
     */
    private $idPais;
 
    public function getNombreDepartamento(): ?string
    {
        return $this->nombreDepartamento;
    }

    public function setNombreDepartamento(string $nombreDepartamento): self
    {
        $this->nombreDepartamento = $nombreDepartamento;

        return $this;
    }

    public function getIdPais(): ?CtlPais
    {
        return $this->idPais;
    }

    public function setIdPais(?CtlPais $idPais): self
    {
        $this->idPais = $idPais;

        return $this;
    }
   
    public function __toString() {
        return $this->nombreDepartamento ? (string) $this->nombreDepartamento : ''; 
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
}
