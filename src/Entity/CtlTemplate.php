<?php

namespace App\Entity;

use App\Repository\CtlTemplateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CtlTemplateRepository::class)
 */
class CtlTemplate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nombreTemplate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getnombreTemplate(): ?string
    {
        return $this->nombreTemplate;
    }

    public function setnombreTemplate(string $nombreTemplate): self
    {
        $this->nombreTemplate = $nombreTemplate;

        return $this;
    }

    public function __toString() {
        return $this->nombreTemplate ? (string) $this->nombreTemplate : ''; 
    }
}
