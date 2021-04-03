<?php

namespace App\Entity;

use App\Repository\LabOrdenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LabOrdenRepository::class)
 */
class LabOrden
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaOrden;

    /**
     * @ORM\ManyToOne(targetEntity=MntPaciente::class)
     * @ORM\JoinColumn(nullable=false, name="id_paciente", referencedColumnName="id")
     */
    private $idPaciente;

    /**
     * @ORM\ManyToOne(targetEntity=MntMedico::class)
     * @ORM\JoinColumn(nullable=false, name="id_medico", referencedColumnName="id")
     */
    private $idMedico;

    /**
     * @ORM\ManyToOne(targetEntity=CtlEstadoOrden::class)
     * @ORM\JoinColumn(nullable=false, name="id_estado_orden", referencedColumnName="id")
     */
    private $idEstadoOrden;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechaTomaMuestra;

    /**
     * @ORM\ManyToOne(targetEntity=CtlTipoDocumento::class)
     * @ORM\JoinColumn(nullable=false, name="id_tipo_documento", referencedColumnName="id")
     */
    private $idTipoDocumento;

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
     * @ORM\OneToMany(targetEntity=LabDetalleOrden::class, mappedBy="idOrden", cascade={"all"}, orphanRemoval=true)
     */
    private $labDetalleOrdens;

    /**
     * @ORM\ManyToOne(targetEntity=CtlFormaPago::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idFormaPago;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numeroDocumento;

    public function __construct()
    {
        $this->labDetalleOrdens = new ArrayCollection();
    }
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaOrden(): ?\DateTimeInterface
    {
        return $this->fechaOrden;
    }

    public function setFechaOrden(\DateTimeInterface $fechaOrden): self
    {
        $this->fechaOrden = $fechaOrden;

        return $this;
    }

    public function getIdPaciente(): ?MntPaciente
    {
        return $this->idPaciente;
    }

    public function setIdPaciente(?MntPaciente $idPaciente): self
    {
        $this->idPaciente = $idPaciente;

        return $this;
    }

    public function getIdMedico(): ?MntMedico
    {
        return $this->idMedico;
    }

    public function setIdMedico(?MntMedico $idMedico): self
    {
        $this->idMedico = $idMedico;

        return $this;
    }

    public function getIdEstadoOrden(): ?CtlEstadoOrden
    {
        return $this->idEstadoOrden;
    }

    public function setIdEstadoOrden(?CtlEstadoOrden $idEstadoOrden): self
    {
        $this->idEstadoOrden = $idEstadoOrden;

        return $this;
    }

    public function getFechaTomaMuestra(): ?\DateTimeInterface
    {
        return $this->fechaTomaMuestra;
    }

    public function setFechaTomaMuestra(?\DateTimeInterface $fechaTomaMuestra): self
    {
        $this->fechaTomaMuestra = $fechaTomaMuestra;

        return $this;
    }

    public function getIdTipoDocumento(): ?CtlTipoDocumento
    {
        return $this->idTipoDocumento;
    }

    public function setIdTipoDocumento(?CtlTipoDocumento $idTipoDocumento): self
    {
        $this->idTipoDocumento = $idTipoDocumento;

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

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    

    /**
     * @return Collection|LabDetalleOrden[]
     */
    public function getLabDetalleOrdens(): Collection
    {
        return $this->labDetalleOrdens;
    }

    public function addLabDetalleOrden(LabDetalleOrden $labDetalleOrden): self
    {
        if (!$this->labDetalleOrdens->contains($labDetalleOrden)) {
            $this->labDetalleOrdens[] = $labDetalleOrden;
            $labDetalleOrden->setIdOrden($this);
        }

        return $this;
    }

    public function removeLabDetalleOrden(LabDetalleOrden $labDetalleOrden): self
    {
        if ($this->labDetalleOrdens->removeElement($labDetalleOrden)) {
            // set the owning side to null (unless already changed)
            if ($labDetalleOrden->getIdOrden() === $this) {
                $labDetalleOrden->setIdOrden(null);
            }
        }

        return $this;
    }

    public function getIdFormaPago(): ?CtlFormaPago
    {
        return $this->idFormaPago;
    }

    public function setIdFormaPago(?CtlFormaPago $idFormaPago): self
    {
        $this->idFormaPago = $idFormaPago;

        return $this;
    }

    public function getNumeroDocumento(): ?int
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento(?int $numeroDocumento): self
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }    
    
}
