<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScheduleRepository")
 */
class Schedule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $day;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $start;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $end;

    /**
     * @ORM\Column(type="boolean")
     */
    private $IsDayOff;

    /**
     * @ORM\Column(type="integer")
     */
    private $numDay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(?\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(?\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getIsDayOff(): ?bool
    {
        return $this->IsDayOff;
    }

    public function setIsDayOff(bool $IsDayOff): self
    {
        $this->IsDayOff = $IsDayOff;

        return $this;
    }

    public function getNumDay(): ?int
    {
        return $this->numDay;
    }

    public function setNumDay(int $numDay): self
    {
        $this->numDay = $numDay;

        return $this;
    }
}
