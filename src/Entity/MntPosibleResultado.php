<?php

namespace App\Entity;

use App\Repository\MntPosibleResultadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntPosibleResultadoRepository::class)
 */
class MntPosibleResultado
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CtlPosibleResultado::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPosibleResultado;

    /**
     * @var \CtlExamen
     * 
     * @ORM\ManyToOne(targetEntity="CtlExamen")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_examen",referencedColumnName="id",nullable=false)
     * })
     */
    private $idExamen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPosibleResultado(): ?CtlPosibleResultado
    {
        return $this->idPosibleResultado;
    }

    public function setIdPosibleResultado(?CtlPosibleResultado $idPosibleResultado): self
    {
        $this->idPosibleResultado = $idPosibleResultado;

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

}
