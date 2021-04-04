<?php

namespace App\Entity;

use App\Repository\CtlEmpresaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlEmpresaRepository::class)
 */
class CtlEmpresa
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
    private $nombreEmpresa;

    /**
     * @var \CtlDescuento
     *
     * @ORM\ManyToOne(targetEntity="CtlDescuento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_descuento", referencedColumnName="id")
     * })
     */
    private $idDescuento;

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
     * @ORM\Column(type="datetime", nullable=true)
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreEmpresa(): ?string
    {
        return $this->nombreEmpresa;
    }

    public function setNombreEmpresa(string $nombreEmpresa): self
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    public function getIdDescuento(): ?CtlDescuento
    {
        return $this->idDescuento;
    }

    public function setIdDescuento(?CtlDescuento $idDescuento): self
    {
        $this->idDescuento = $idDescuento;

        return $this;
    }

    public function getidUsuarioReg(): ?User
    {
        return $this->idUsuarioReg;
    }

    public function setidUsuarioReg(?User $idUsuarioReg): self
    {
        $this->idUsuarioReg = $idUsuarioReg;

        return $this;
    }

    public function getFechahoraReg(): ?\DateTimeInterface
    {
        return $this->fechahoraReg;
    }

    public function setFechahoraReg(?\DateTimeInterface $fechahoraReg): self
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
}
