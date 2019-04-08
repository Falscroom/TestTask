<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeskRepository")
 */
class Desk
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TableType", inversedBy="tables")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TablePosition", inversedBy="tables")
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="Desk", orphanRemoval=true)
     */
    private $reservations;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?TableType
    {
        return $this->type;
    }

    public function setType(?TableType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPosition(): ?TablePosition
    {
        return $this->position;
    }

    public function setPosition(?TablePosition $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setDesk($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getDesk() === $this) {
                $reservation->setDesk(null);
            }
        }

        return $this;
    }


}
