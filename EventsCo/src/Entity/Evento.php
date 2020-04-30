<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventoRepository")
 */
class Evento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsuarioGrupoEvento", mappedBy="evento_id")
     */
    private $usuarioGrupoEventos;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Actividad", mappedBy="eventos")
     */
    private $actividades;

    public function __construct()
    {
        $this->usuarioGrupoEventos = new ArrayCollection();
        $this->actividades = new ArrayCollection();
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
            $usuarioGrupoEvento->setEventoId($this);
        }

        return $this;
    }

    public function removeUsuarioGrupoEvento(UsuarioGrupoEvento $usuarioGrupoEvento): self
    {
        if ($this->usuarioGrupoEventos->contains($usuarioGrupoEvento)) {
            $this->usuarioGrupoEventos->removeElement($usuarioGrupoEvento);
            // set the owning side to null (unless already changed)
            if ($usuarioGrupoEvento->getEventoId() === $this) {
                $usuarioGrupoEvento->setEventoId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Actividad[]
     */
    public function getActividades(): Collection
    {
        return $this->actividades;
    }

    public function addActividad(Actividad $actividade): self
    {
        if (!$this->actividades->contains($actividade)) {
            $this->actividades[] = $actividade;
            $actividade->addEvento($this);
        }

        return $this;
    }

    public function removeActividad(Actividad $actividade): self
    {
        if ($this->actividades->contains($actividade)) {
            $this->actividades->removeElement($actividade);
            $actividade->removeEvento($this);
        }

        return $this;
    }
}
