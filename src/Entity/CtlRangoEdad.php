<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\CtlRangoEdadRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=CtlRangoEdadRepository::class)
 */
class CtlRangoEdad
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
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=MntElementos::class, mappedBy="idRangoEdad", orphanRemoval=true)
     */
    //private $mntElementos;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *    min = "0",
     *    max = "125",
     *    minMessage = "El menor número a ingresar es 0",
     *    maxMessage = "El mayor número a ingresar es 125",
     * )
     * 
     */
    private $edadMinima;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *    min = "0",
     *    max = "125",
     *    minMessage = "El menor número a ingresar es 0",
     *    maxMessage = "El mayor número a ingresar es 125",
     * )
     * 
     */
    private $edadMaxima;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $tipoEdad;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activo;

    public function __construct()
    {
        $this->MntElementos = new ArrayCollection();
    }

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

    public function __toString() {
        return $this->nombre ? (string) $this->nombre : ''; 
    }

    public function getEdadMinima(): ?int
    {
        return $this->edadMinima;
    }

    public function setEdadMinima(int $edadMinima): self
    {
        $this->edadMinima = $edadMinima;

        return $this;
    }

    public function getEdadMaxima(): ?int
    {
        return $this->edadMaxima;
    }

    public function setEdadMaxima(int $edadMaxima): self
    {
        $this->edadMaxima = $edadMaxima;

        return $this;
    }

    public function getTipoEdad(): ?string
    {
        return $this->tipoEdad;
    }

    public function setTipoEdad(string $tipoEdad): self
    {
        $this->tipoEdad = $tipoEdad;

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
}
