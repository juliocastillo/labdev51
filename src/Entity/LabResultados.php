<?php

namespace App\Entity;

use App\Repository\LabResultadosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabResultadosRepository::class)
 */
class LabResultados
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \MntElementos
     * 
     * @ORM\ManyToOne(targetEntity="MntElementos")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_elemento",referencedColumnName="id",nullable=false)
     * })
     */
    private $idElemento;

    /**
     * @var \MntEmpleado
     * 
     * @ORM\ManyToOne(targetEntity="MntEmpleado")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_empleado",referencedColumnName="id",nullable=false)
     * })
     */
    private $idEmpleado;

    /**
     * @var \LabDetalleOrden
     * 
     * @ORM\ManyToOne(targetEntity="LabDetalleOrden")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_detalle_orden",referencedColumnName="id",nullable=false)
     * })
     */
    private $idDetalleOrden;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var \CtlMicroorganismo
     * 
     * @ORM\ManyToOne(targetEntity="CtlMicroorganismo")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_microorganismo",referencedColumnName="id",nullable=false)
     * })
     */
    private $idMicroorganismo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cantidad;

     /**
     * @var \User
     * 
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_usuario_reg",referencedColumnName="id",nullable=true)
     * })
     */
    private $idUsuarioReg;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $fechahoraReg;

    /**
     * @var \User
     * 
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_usuario_mod",referencedColumnName="id",nullable=true)
     * })
     */
    private $idUsuarioMod;

    /**
     * @ORM\Column(type="datetime",nullable=true)
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

    public function getIdElemento(): ?MntElementos
    {
        return $this->idElemento;
    }

    public function setIdElemento(?MntElementos $idElemento): self
    {
        $this->idElemento = $idElemento;

        return $this;
    }

    public function getIdEmpleado(): ?MntEmpleado
    {
        return $this->idEmpleado;
    }

    public function setIdEmpleado(?MntEmpleado $idEmpleado): self
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    public function getIdDetalleOrden(): ?LabDetalleOrden
    {
        return $this->idDetalleOrden;
    }

    public function setIdDetalleOrden(?LabDetalleOrden $idDetalleOrden): self
    {
        $this->idDetalleOrden = $idDetalleOrden;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getIdMicroorganismo(): ?CtlMicroorganismo
    {
        return $this->idMicroorganismo;
    }

    public function setIdMicroorganismo(?CtlMicroorganismo $idMicroorganismo): self
    {
        $this->idMicroorganismo = $idMicroorganismo;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(?string $cantidad): self
    {
        $this->cantidad = $cantidad;

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

    public function setActivo(?bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
}
