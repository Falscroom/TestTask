<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TablePositionRepository")
 */
class TablePosition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Desk", mappedBy="position")
     */
    private $tables;

    public function __construct()
    {
        $this->tables = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return Collection|Desk[]
     */
    public function getTables(): Collection
    {
        return $this->tables;
    }

    public function addTable(Desk $table): self
    {
        if (!$this->tables->contains($table)) {
            $this->tables[] = $table;
            $table->setPosition($this);
        }

        return $this;
    }

    public function removeTable(Desk $table): self
    {
        if ($this->tables->contains($table)) {
            $this->tables->removeElement($table);
            // set the owning side to null (unless already changed)
            if ($table->getPosition() === $this) {
                $table->setPosition(null);
            }
        }

        return $this;
    }
}
