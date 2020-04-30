<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VehiculoRepository")
 */
class Vehiculo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuario", inversedBy="vehiculo", cascade={"persist", "remove"})
     */
    private $propietario;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_plazas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricula;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modelo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPropietario(): ?Usuario
    {
        return $this->propietario;
    }

    public function setPropietario(?Usuario $propietario): self
    {
        $this->propietario = $propietario;

        return $this;
    }

    public function getNumeroPlazas(): ?int
    {
        return $this->numero_plazas;
    }

    public function setNumeroPlazas(int $numero_plazas): self
    {
        $this->numero_plazas = $numero_plazas;

        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }
}
