<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupoRepository")
 */
class Grupo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioGrupoEvento", mappedBy="grupo_id")
     */
    private $usuarioGrupoEventos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuario", mappedBy="grupos")
     */
    private $usuarios;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario")
     * @ORM\JoinColumn(nullable=false)
     */
    private $admin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    public function __construct()
    {
        $this->usuarioGrupoEventos = new ArrayCollection();
        $this->usuarios = new ArrayCollection();
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
            $usuarioGrupoEvento->setGrupoId($this);
        }

        return $this;
    }

    public function removeUsuarioGrupoEvento(UsuarioGrupoEvento $usuarioGrupoEvento): self
    {
        if ($this->usuarioGrupoEventos->contains($usuarioGrupoEvento)) {
            $this->usuarioGrupoEventos->removeElement($usuarioGrupoEvento);
            // set the owning side to null (unless already changed)
            if ($usuarioGrupoEvento->getGrupoId() === $this) {
                $usuarioGrupoEvento->setGrupoId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios[] = $usuario;
            $usuario->addGrupo($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuarios->contains($usuario)) {
            $this->usuarios->removeElement($usuario);
            $usuario->removeGrupo($this);
        }

        return $this;
    }

    public function getAdmin(): ?Usuario
    {
        return $this->admin;
    }

    public function setAdmin(?Usuario $admin): self
    {
        $this->admin = $admin;

        return $this;
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
}
