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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="float")
     */
    private $precio_total;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $lista_invitados = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $lista_confirmados = [];

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

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

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

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getPrecioTotal(): ?float
    {
        return $this->precio_total;
    }

    public function setPrecioTotal(float $precio_total): self
    {
        $this->precio_total = $precio_total;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getListaInvitados(): ?array
    {
        return $this->lista_invitados;
    }

    public function setListaInvitados(?array $lista_invitados): self
    {
        $this->lista_invitados = $lista_invitados;

        return $this;
    }

    public function getListaConfirmados(): ?array
    {
        return $this->lista_confirmados;
    }

    public function setListaConfirmados(?array $lista_confirmados): self
    {
        $this->lista_confirmados = $lista_confirmados;

        return $this;
    }
}
