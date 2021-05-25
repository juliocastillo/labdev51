<?php

namespace App\Entity;

use App\Repository\MntMedicoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntMedicoRepository::class)
 */
class MntMedico
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $correoElectronico;

    /**
     * @var \CtlEspecialidad
     *
     * @ORM\ManyToOne(targetEntity="CtlEspecialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_especialidad", referencedColumnName="id")
     * })
     */
    private $idEspecialidad;

    /**
     * @ORM\Column(type="string", length=25, nullable=false)
     */
    private $jvpm;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono;

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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido(?string $segundoApellido): self
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    public function getCorreoElectronico(): ?string
    {
        return $this->correoElectronico;
    }

    public function setCorreoElectronico(?string $correoElectronico): self
    {
        $this->correoElectronico = $correoElectronico;

        return $this;
    }

    public function getIdEspecialidad(): ?CtlEspecialidad
    {
        return $this->idEspecialidad;
    }

    public function setIdEspecialidad(?CtlEspecialidad $idEspecialidad): self
    {
        $this->idEspecialidad = $idEspecialidad;

        return $this;
    }

    public function getJvpm(): ?string
    {
        return $this->jvpm;
    }

    public function setJvpm(?string $jvpm): self
    {
        $this->jvpm = $jvpm;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

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
        return  $this->nombre . " " . $this->apellido ? $this->nombre . " " . $this->apellido : ''; 
    }
    
}
