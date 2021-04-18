<?php

namespace App\Entity;

use App\Repository\MntPosibleResultadoElementoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MntPosibleResultadoElementoRepository::class)
 */
class MntPosibleResultadoElemento
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \CtlPosibleResultado
     * 
     * @ORM\ManyToOne(targetEntity="CtlPosibleResultado")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_posible_resultado",referencedColumnName="id",nullable=false)
     * })
     */
    private $idPosibleResultado;

    /**
     * @var \MntElementos
     * 
     * @ORM\ManyToOne(targetEntity="MntElementos")
     * @ORM\JoinColumns({
     *  @ORM\JoinColumn(name="id_elemento",referencedColumnName="id",nullable=false)
     * })
     */
    private $idElemento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPosibleResultado(): ? CtlPosibleResultado
    {
        return $this->idPosibleResultado;
    }

    public function setIdPosibleResultado(? CtlPosibleResultado $idPosibleResultado): self
    {
        $this->idPosibleResultado = $idPosibleResultado;

        return $this;
    }

    public function getIdElemento(): ? MntElementos
    {
        return $this->idPosibleResultado;
    }

    public function setIdElemento(? MntElementos $idElemento): self
    {
        $this->idElemento = $idElemento;

        return $this;
    }
}
