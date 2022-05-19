<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'Usuario', targetEntity: EntradaCine::class)]
    private $entradasCine;

    #[ORM\OneToMany(mappedBy: 'Usuario', targetEntity: Peliculas::class)]
    private $peliculas;

    public function __construct()
    {
        $this->entradasCine = new ArrayCollection();
        $this->peliculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, EntradaCine>
     */
    public function getEntradasCine(): Collection
    {
        return $this->entradasCine;
    }

    public function addEntradasCine(EntradaCine $entradasCine): self
    {
        if (!$this->entradasCine->contains($entradasCine)) {
            $this->entradasCine[] = $entradasCine;
            $entradasCine->setUsuario($this);
        }

        return $this;
    }

    public function removeEntradasCine(EntradaCine $entradasCine): self
    {
        if ($this->entradasCine->removeElement($entradasCine)) {
            // set the owning side to null (unless already changed)
            if ($entradasCine->getUsuario() === $this) {
                $entradasCine->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Peliculas>
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Peliculas $pelicula): self
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas[] = $pelicula;
            $pelicula->setUsuario($this);
        }

        return $this;
    }

    public function removePelicula(Peliculas $pelicula): self
    {
        if ($this->peliculas->removeElement($pelicula)) {
            // set the owning side to null (unless already changed)
            if ($pelicula->getUsuario() === $this) {
                $pelicula->setUsuario(null);
            }
        }

        return $this;
    }
}
