<<<<<<< HEAD
<?php

namespace App\Entity;

use App\Repository\MntPacienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntPacienteRepository::class)
 */
class MntPaciente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $apellido;

    /**
     * @var \CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $direccionPaciente;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $duiPersonaContacto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombrePersonaContacto;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $parentescoContacto;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $NRC;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $NIT;

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

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getIdSexo(): ?CtlSexo
    {
        return $this->idSexo;
    }

    public function setIdSexo(CtlSexo $idSexo): self
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

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

    public function getDireccionPaciente(): ?string
    {
        return $this->direccionPaciente;
    }

    public function setDireccionPaciente(?string $direccionPaciente): self
    {
        $this->direccionPaciente = $direccionPaciente;

        return $this;
    }

    public function getDuiPersonaContacto(): ?string
    {
        return $this->duiPersonaContacto;
    }

    public function setDuiPersonaContacto(?string $duiPersonaContacto): self
    {
        $this->duiPersonaContacto = $duiPersonaContacto;

        return $this;
    }

    public function getNombrePersonaContacto(): ?string
    {
        return $this->nombrePersonaContacto;
    }

    public function setNombrePersonaContacto(?string $nombrePersonaContacto): self
    {
        $this->nombrePersonaContacto = $nombrePersonaContacto;

        return $this;
    }

    public function getParentescoContacto(): ?string
    {
        return $this->parentescoContacto;
    }

    public function setParentescoContacto(?string $parentescoContacto): self
    {
        $this->parentescoContacto = $parentescoContacto;

        return $this;
    }

    public function getNRC(): ?string
    {
        return $this->NRC;
    }

    public function setNRC(?string $NRC): self
    {
        $this->NRC = $NRC;

        return $this;
    }

    public function getNIT(): ?string
    {
        return $this->NIT;
    }

    public function setNIT(?string $NIT): self
    {
        $this->NIT = $NIT;

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
        return  $this->nombre . " " . $this->apellido ? (string)  $this->nombre . " " . $this->apellido : ''; 
    }
}
=======
<?php

namespace App\Entity;

use App\Repository\MntPacienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntPacienteRepository::class)
 */
class MntPaciente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $apellido;

    /**
     * @var \CtlSexo
     *
     * @ORM\ManyToOne(targetEntity="CtlSexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sexo", referencedColumnName="id")
     * })
     */
    private $idSexo;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $direccionPaciente;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $duiPersonaContacto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombrePersonaContacto;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private $parentescoContacto;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $NRC;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $NIT;

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

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getIdSexo(): ?CtlSexo
    {
        return $this->idSexo;
    }

    public function setIdSexo(CtlSexo $idSexo): self
    {
        $this->idSexo = $idSexo;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

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

    public function getDireccionPaciente(): ?string
    {
        return $this->direccionPaciente;
    }

    public function setDireccionPaciente(?string $direccionPaciente): self
    {
        $this->direccionPaciente = $direccionPaciente;

        return $this;
    }

    public function getDuiPersonaContacto(): ?string
    {
        return $this->duiPersonaContacto;
    }

    public function setDuiPersonaContacto(?string $duiPersonaContacto): self
    {
        $this->duiPersonaContacto = $duiPersonaContacto;

        return $this;
    }

    public function getNombrePersonaContacto(): ?string
    {
        return $this->nombrePersonaContacto;
    }

    public function setNombrePersonaContacto(?string $nombrePersonaContacto): self
    {
        $this->nombrePersonaContacto = $nombrePersonaContacto;

        return $this;
    }

    public function getParentescoContacto(): ?string
    {
        return $this->parentescoContacto;
    }

    public function setParentescoContacto(?string $parentescoContacto): self
    {
        $this->parentescoContacto = $parentescoContacto;

        return $this;
    }

    public function getNRC(): ?string
    {
        return $this->NRC;
    }

    public function setNRC(?string $NRC): self
    {
        $this->NRC = $NRC;

        return $this;
    }

    public function getNIT(): ?string
    {
        return $this->NIT;
    }

    public function setNIT(?string $NIT): self
    {
        $this->NIT = $NIT;

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
        return  $this->nombre . " " . $this->apellido ? (string)  $this->nombre . " " . $this->apellido : ''; 
    }
}
>>>>>>> b821112b42499a8a79a0bf962e5629752817982b
