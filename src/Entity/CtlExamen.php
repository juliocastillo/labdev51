<?php

namespace App\Entity;

use App\Repository\CtlExamenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlExamenRepository::class)
 */
class CtlExamen
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
    private $nombreExamen;

    /**
     * @var \CtlAreaLaboratorio
     *
     * @ORM\ManyToOne(targetEntity="CtlAreaLaboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_laboratorio", referencedColumnName="id", nullable=false)
     * })
     */
    private $idAreaLaboratorio;

    /**
     * @var \CtlTemplate
     *
     * @ORM\ManyToOne(targetEntity="CtlTemplate")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_template", referencedColumnName="id")
     * })
     */
    private $idTemplate;

     /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_reg", referencedColumnName="id")
     * })
     */
    private $idUsuarioReg;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechahoraReg;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario_mod", referencedColumnName="id")
     * })
     */
    private $idUsuarioMod;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechahoraMod;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo;

    /**
     * @ORM\Column(type="float")
     */
    private $precio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreExamen(): ?string
    {
        return $this->nombreExamen;
    }

    public function setNombreExamen(string $nombreExamen): self
    {
        $this->nombreExamen = $nombreExamen;

        return $this;
    }

    public function getIdAreaLaboratorio(): ?CtlAreaLaboratorio
    {
        return $this->idAreaLaboratorio;
    }

    public function setIdAreaLaboratorio(?CtlAreaLaboratorio $idAreaLaboratorio): self
    {
        $this->idAreaLaboratorio = $idAreaLaboratorio;

        return $this;
    }

    public function getIdUsuarioReg(): ?User
    {
        return $this->idUsuarioReg;
    }

    public function setIdUsuarioReg(?User $idUsuarioReg): self
    {
        $this->idUsuarioReg = $idUsuarioReg;

        return $this;
    }

    public function getFechahoraReg(): ?\DateTimeInterface
    {
        return $this->fechahoraReg;
    }

    public function setFechahoraReg(\DateTimeInterface $fechahoraReg): self
    {
        $this->fechahoraReg = $fechahoraReg;

        return $this;
    }

    public function getIdUsuarioMod(): ?User
    {
        return $this->idUsuarioMod;
    }

    public function setIdUsuarioMod(?User $idUsuarioMod): self
    {
        $this->idUsuarioMod = $idUsuarioMod;

        return $this;
    }

    public function getFechahoraMod(): ?\DateTimeInterface
    {
        return $this->fechahoraMod;
    }

    public function setFechahoraMod(?\DateTimeInterface $fechahoraMod): self
    {
        $this->fechahoraMod = $fechahoraMod;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function __toString() {
        return $this->nombreExamen  ? (string) $this->nombreExamen  .' ($' . $this->precio . ')' : ''; 
    }
    
    
    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }
}
