<?php

namespace App\Entity;

use App\Repository\MntEmpleadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntEmpleadoRepository::class)
 */
class MntEmpleado
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
    private $nombresEmpleado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidosEmpleado;

    /**
     * @var \CtlCargoEmpleado
     * 
     * @ORM\ManyToOne(targetEntity="CtlCargoEmpleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cargo", referencedColumnName="id")
     * })
     */
    private $idCargo;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombresEmpleado(): ?string
    {
        return $this->nombresEmpleado;
    }

    public function setNombresEmpleado(string $nombresEmpleado): self
    {
        $this->nombresEmpleado = $nombresEmpleado;

        return $this;
    }

    public function getApellidosEmpleado(): ?string
    {
        return $this->apellidosEmpleado;
    }

    public function setApellidosEmpleado(string $apellidosEmpleado): self
    {
        $this->apellidosEmpleado = $apellidosEmpleado;

        return $this;
    }

    public function getIdCargo(): ?CtlCargoEmpleado
    {
        return $this->idCargo;
    }

    public function setIdCargo(?CtlCargoEmpleado $idCargo): self
    {
        $this->idCargo = $idCargo;

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
        return $this->nombresEmpleado ? (string) $this->nombresEmpleado : ''; 
    }
}
