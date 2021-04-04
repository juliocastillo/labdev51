<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="mnt_usuario")
 * @UniqueEntity(fields={"email"}, message="An account already exists for this email")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", nullable=true)
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password.
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "Your password must be at least {{ limit }} characters long.",
     * )
     * @var string
     */
    private $plainPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login", type="datetime", nullable=true)
     */
    private $lastLogin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_suspended", type="boolean")
     */
    private $isSuspended = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var Collection|Role[]
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(
     *      name="mnt_usuario_rol",
     *      joinColumns={@ORM\JoinColumn(name="id_usuario", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_rol", referencedColumnName="id")}
     * )
     */
    private $uroles;



    public function __construct()
    {
        $this->uroles = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword = null)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;

        return $this;
    }

    public function getRoles()
    {
        return array_map( function($rol) { return $rol->getName(); }, $this->uroles->toArray() );
    }

    public function hasRole($role)
    {
        return in_array(strtoupper($role), $this->getRoles(), true);
    }

    /**
     * @return Collection|Role[]
     */
    public function getUroles(): Collection
    {
        return $this->uroles;
    }

    public function addUrole(Role $urole): self
    {
        if (!$this->uroles->contains($urole)) {
            $this->uroles[] = $urole;
        }

        return $this;
    }

    public function removeUrole(Role $urole): self
    {
        $this->uroles->removeElement($urole);

        return $this;
    }

    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    public function setLastLogin(\DateTime $lastLogin)
    {
        $this->lastLogin = $lastLogin;

        return $this;
    }

    public function isSuspended()
    {
        return $this->isSuspended;
    }

    public function getIsSuspended(): ?bool
    {
        return $this->isSuspended;
    }

    public function setIsSuspended(bool $isSuspended)
    {
        $this->isSuspended = $isSuspended;

        return $this;
    }

    public function getSalt() {
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;

        return $this;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isSuspended
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isSuspended
            ) = unserialize($serialized);
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function __toString() {
        return $this->id ? $this->email : '';
    }
}