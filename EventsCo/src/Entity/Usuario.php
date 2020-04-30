<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 */
class Usuario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioGrupoEvento", mappedBy="usuario_id", orphanRemoval=true)
     */
    private $usuarioGrupoEventos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Grupo", inversedBy="usuarios")
     */
    private $grupos;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Vehiculo", mappedBy="propietario", cascade={"persist", "remove"})
     */
    private $vehiculo;

    public function __construct()
    {
        $this->usuarioGrupoEventos = new ArrayCollection();
        $this->grupos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|UsuarioGrupoEvento[]
     */
    public function getUsuarioGrupoEventos(): Collection
    {
        return $this->usuarioGrupoEventos;
    }

    public function addUsuarioGrupoEvento(UsuarioGrupoEvento $usuarioGrupoEvento): self
    {
        if (!$this->usuarioGrupoEventos->contains($usuarioGrupoEvento)) {
            $this->usuarioGrupoEventos[] = $usuarioGrupoEvento;
            $usuarioGrupoEvento->setUsuarioId($this);
        }

        return $this;
    }

    public function removeUsuarioGrupoEvento(UsuarioGrupoEvento $usuarioGrupoEvento): self
    {
        if ($this->usuarioGrupoEventos->contains($usuarioGrupoEvento)) {
            $this->usuarioGrupoEventos->removeElement($usuarioGrupoEvento);
            // set the owning side to null (unless already changed)
            if ($usuarioGrupoEvento->getUsuarioId() === $this) {
                $usuarioGrupoEvento->setUsuarioId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Grupo[]
     */
    public function getGrupos(): Collection
    {
        return $this->grupos;
    }

    public function addGrupo(Grupo $grupo): self
    {
        if (!$this->grupos->contains($grupo)) {
            $this->grupos[] = $grupo;
        }

        return $this;
    }

    public function removeGrupo(Grupo $grupo): self
    {
        if ($this->grupos->contains($grupo)) {
            $this->grupos->removeElement($grupo);
        }

        return $this;
    }

    public function getVehiculo(): ?Vehiculo
    {
        return $this->vehiculo;
    }

    public function setVehiculo(?Vehiculo $vehiculo): self
    {
        $this->vehiculo = $vehiculo;

        // set (or unset) the owning side of the relation if necessary
        $newPropietario = null === $vehiculo ? null : $this;
        if ($vehiculo->getPropietario() !== $newPropietario) {
            $vehiculo->setPropietario($newPropietario);
        }

        return $this;
    }
}
