<?php

namespace App\Entity;

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
}
