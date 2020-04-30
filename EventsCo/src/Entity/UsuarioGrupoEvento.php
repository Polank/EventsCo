<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioGrupoEventoRepository")
 */
class UsuarioGrupoEvento
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="usuarioGrupoEventos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grupo", inversedBy="usuarioGrupoEventos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $grupo_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evento", inversedBy="usuarioGrupoEventos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evento_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuarioId(): ?Usuario
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(?Usuario $usuario_id): self
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function getGrupoId(): ?Grupo
    {
        return $this->grupo_id;
    }

    public function setGrupoId(?Grupo $grupo_id): self
    {
        $this->grupo_id = $grupo_id;

        return $this;
    }

    public function getEventoId(): ?Evento
    {
        return $this->evento_id;
    }

    public function setEventoId(?Evento $evento_id): self
    {
        $this->evento_id = $evento_id;

        return $this;
    }
}
