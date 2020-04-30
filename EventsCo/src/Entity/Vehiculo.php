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
}
