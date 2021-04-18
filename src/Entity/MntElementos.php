<?php

namespace App\Entity;

use App\Repository\MntElementosRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MntElementosRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class MntElementos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    //@Assert\NotNull
    /**
     * @ORM\Column(type="string", length=150)
     * 
     * @Assert\Length(min=5,minMessage="No pueden ingresarse menos de 5 caracteres.")
     * @Assert\Regex(pattern="/^[A-Z]{1}+[a-zA-Z0-9]/", message = "La cantidad minina de caracteres es 5 y no se permiten numeros o caracteres especiales.")
     */
    private $nombreElemento;

    /**
     * @var \CtlExamen
     * 
     * @ORM\ManyToOne(targetEntity="CtlExamen")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_examen",referencedColumnName="id",nullable=false)
     * })
     */
    private $idExamen;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valorInicial;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valorFinal;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $unidades;

    /**
     * @var \CtlTipoElemento
     * 
     * @ORM\ManyToOne(targetEntity="CtlTipoElemento")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_tipo_elemento",referencedColumnName="id",nullable=false)
     * })
     */
    private $idTipoElemento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ordenamiento;

    /**
     * @var \CtlSexo
     * 
     * @ORM\ManyToOne(targetEntity="CtlSexo")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_sexo",referencedColumnName="id",nullable=false)
     * })
     */
    private $idSexo;

    /**
     * @var \CtlRangoEdad
     * 
     * @ORM\ManyToOne(targetEntity="CtlRangoEdad")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_rango_edad",referencedColumnName="id",nullable=false)
     * })
     */
    private $idRangoEdad;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaFin;

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
     * @ORM\Column(type="datetime", nullable=true)
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

    public function getNombreElemento(): ?string
    {
        return $this->nombreElemento;
    }

    public function setNombreElemento(string $nombreElemento): self
    {
        $this->nombreElemento = $nombreElemento;

        return $this;
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

    public function getValorInicial(): ?float
    {
        return $this->valorInicial;
    }

    public function setValorInicial(?float $valorInicial): self
    {
        $this->valorInicial = $valorInicial;

        return $this;
    }

    public function getValorFinal(): ?float
    {
        return $this->valorFinal;
    }

    public function setValorFinal(?float $valorFinal): self
    {
        $this->valorFinal = $valorFinal;

        return $this;
    }

    public function getUnidades(): ?string
    {
        return $this->unidades;
    }

    public function setUnidades(?string $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }

    public function getIdTipoElemento(): ?CtlTipoElemento
    {
        return $this->idTipoElemento;
    }

    public function setIdTipoElemento(?CtlTipoElemento $idTipoElemento): self
    {
        $this->idTipoElemento = $idTipoElemento;

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

    public function getOrdenamiento(): ?int
    {
        return $this->ordenamiento;
    }

    public function setOrdenamiento(int $ordenamiento): self
    {
        $this->ordenamiento = $ordenamiento;

        return $this;
    }

    public function getIdSexo(): ?CtlSexo
    {
        return $this->idSexo;
    }

    public function setIdSexo(?CtlSexo $idSexo): self
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    public function getIdRangoEdad(): ?CtlRangoEdad
    {
        return $this->idRangoEdad;
    }

    public function setIdRangoEdad(?CtlRangoEdad $idRangoEdad): self
    {
        $this->idRangoEdad = $idRangoEdad;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(?\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

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

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function __toString() {
        return $this->nombreElemento ? (string) $this->nombreElemento : ''; 
    }

    /**
     *Gets triggered only in insert
     *@ORM\PrePersist 
    */
    /* public function onPrePersist(){
        $this->fechahoraReg = new \DateTime('now');
    } */
}
