<?php

namespace App\Entity;

use App\Repository\EntradaCineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntradaCineRepository::class)]
class EntradaCine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $fechaInicio;

    #[ORM\Column(type: 'date')]
    private $fechaFin;

    #[ORM\Column(type: 'integer')]
    private $numEntradas;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $bolsaPalomitas;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'entradasCine')]
    #[ORM\JoinColumn(nullable: false)]
    private $Usuario;

    #[ORM\Column(type: 'string', length: 30)]
    private $nombrePelicula;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fechaFin;
    }

    public function setFechaFin(\DateTimeInterface $fechaFin): self
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    public function getNumEntradas(): ?int
    {
        return $this->numEntradas;
    }

    public function setNumEntradas(int $numEntradas): self
    {
        $this->numEntradas = $numEntradas;

        return $this;
    }

    public function getBolsaPalomitas(): ?int
    {
        return $this->bolsaPalomitas;
    }

    public function setBolsaPalomitas(?int $bolsaPalomitas): self
    {
        $this->bolsaPalomitas = $bolsaPalomitas;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->Usuario;
    }

    public function setUsuario(?User $Usuario): self
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getNombrePelicula(): ?string
    {
        return $this->nombrePelicula;
    }

    public function setNombrePelicula(string $nombrePelicula): self
    {
        $this->nombrePelicula = $nombrePelicula;

        return $this;
    }
}
