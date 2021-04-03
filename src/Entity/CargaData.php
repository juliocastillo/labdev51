<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CargaData
 *
 * @ORM\Table(name="carga_data", uniqueConstraints={@ORM\UniqueConstraint(name="carga_data_pk", columns={"id_carga"})})
 * @ORM\Entity
 */
class CargaData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_carga", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="carga_data_id_carga_seq", allocationSize=1, initialValue=1)
     */
    private $idCarga;

    /**
     * @var string|null
     *
     * @ORM\Column(name="message_load", type="string", length=254, nullable=true)
     */
    private $messageLoad;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_load", type="date", nullable=true)
     */
    private $dateLoad;

    /**
     * @var int|null
     *
     * @ORM\Column(name="totantes", type="integer", nullable=true)
     */
    private $totantes;

    /**
     * @var int|null
     *
     * @ORM\Column(name="totbaseprev", type="integer", nullable=true)
     */
    private $totbaseprev;

    /**
     * @var int|null
     *
     * @ORM\Column(name="actualizar", type="integer", nullable=true)
     */
    private $actualizar;

    public function getIdCarga(): ?int
    {
        return $this->idCarga;
    }

    public function getMessageLoad(): ?string
    {
        return $this->messageLoad;
    }

    public function setMessageLoad(?string $messageLoad): self
    {
        $this->messageLoad = $messageLoad;

        return $this;
    }

    public function getDateLoad(): ?\DateTimeInterface
    {
        return $this->dateLoad;
    }

    public function setDateLoad(?\DateTimeInterface $dateLoad): self
    {
        $this->dateLoad = $dateLoad;

        return $this;
    }

    public function getTotantes(): ?int
    {
        return $this->totantes;
    }

    public function setTotantes(?int $totantes): self
    {
        $this->totantes = $totantes;

        return $this;
    }

    public function getTotbaseprev(): ?int
    {
        return $this->totbaseprev;
    }

    public function setTotbaseprev(?int $totbaseprev): self
    {
        $this->totbaseprev = $totbaseprev;

        return $this;
    }

    public function getActualizar(): ?int
    {
        return $this->actualizar;
    }

    public function setActualizar(?int $actualizar): self
    {
        $this->actualizar = $actualizar;

        return $this;
    }


}

