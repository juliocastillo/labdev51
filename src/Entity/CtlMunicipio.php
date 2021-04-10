<?php

namespace App\Entity;

use App\Repository\CtlMunicipioRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlMunicipioRepository::class)
 */
class CtlMunicipio
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
    private $nombreMunicipio;

      /**
     * @var \CtlDepartamento
     *
     * @ORM\ManyToOne(targetEntity="CtlDepartamento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_departamento", referencedColumnName="id")
     * })
     */
    private $idDepartamento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreMunicipio(): ?string
    {
        return $this->nombreMunicipio;
    }

    public function setNombreMunicipio(string $nombreMunicipio): self
    {
        $this->nombreMunicipio = $nombreMunicipio;

        return $this;
    }

    public function getIdDepartamento(): ?CtlDepartamento
    {
        return $this->idDepartamento;
    }

    public function setIdDepartamento(?CtlDepartamento $idDepartamento): self
    {
        $this->idDepartamento = $idDepartamento;

        return $this;
    }

    public function __toString() {
        return $this->nombreMunicipio ? (string) $this->nombreMunicipio : ''; 
    }
   
}
