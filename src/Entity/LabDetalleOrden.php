<?php

namespace App\Entity;

use App\Repository\LabDetalleOrdenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabDetalleOrdenRepository::class)
 */
class LabDetalleOrden
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtlExamen::class)
     * @ORM\JoinColumn(nullable=false, name="id_examen", referencedColumnName="id")
     */
    private $idExamen;

    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoMuestra::class)
     * @ORM\JoinColumn(nullable=false, name="id_tipo_muestra", referencedColumnName="id")
     */
    private $idTipoMuestra;

    /**
     * @ORM\ManyToOne(targetEntity=CtlEstadoExamen::class)
     * @ORM\JoinColumn(nullable=false, name="id_estado_examen", referencedColumnName="id")
     */
    private $idEstadoExamen;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precio;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaResultado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacion;
    
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
    
    //@ORM\JoinColumn(nullable=false, name="id_orden", referencedColumnName="id")
    /**
     * @ORM\ManyToOne(targetEntity=LabOrden::class, inversedBy="labDetalleOrdens")
     * @ORM\JoinColumn(name="id_orden", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $idOrden;    
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getIdExamen(): ?CtlExamen
    {
        return $this->idExamen;
    }

    public function setIdExamen(?CtlExamen $idExamen): self
    {
        $this->idExamen = $idExamen;

        return $this;
    }

    public function getIdTipoMuestra(): ?CtlTipoMuestra
    {
        return $this->idTipoMuestra;
    }

    public function setIdTipoMuestra(?CtlTipoMuestra $idTipoMuestra): self
    {
        $this->idTipoMuestra = $idTipoMuestra;

        return $this;
    }

    public function getIdEstadoExamen(): ?CtlEstadoExamen
    {
        return $this->idEstadoExamen;
    }

    public function setIdEstadoExamen(?CtlEstadoExamen $idEstadoExamen): self
    {
        $this->idEstadoExamen = $idEstadoExamen;

        return $this;
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

    public function getFechaResultado(): ?\DateTimeInterface
    {
        return $this->fechaResultado;
    }

    public function setFechaResultado(?\DateTimeInterface $fechaResultado): self
    {
        $this->fechaResultado = $fechaResultado;

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
    
    
        public function getIdUsuarioReg(): ?User
    {
        return $this->idUsuarioReg;
    }

    public function setIdUsuarioReg(User $idUsuarioReg): self
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
    
    public function __toString() {
        return (string) $this->getIdExamen();
    }

    public function getIdOrden(): ?LabOrden
    {
        return $this->idOrden;
    }

    public function setIdOrden(?LabOrden $idOrden): self
    {
        $this->idOrden = $idOrden;

        return $this;
    }

}
