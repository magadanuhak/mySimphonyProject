<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 */
class Trip
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $DepartureAirport;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $DestinationAirport;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DepartureDateTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ArrivalDateTime;

    /**
     * @ORM\Column(type="text")
     */
    private $Passengers;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDepartureAirport(): ?string
    {
        return $this->DepartureAirport;
    }

    public function setDepartureAirport(string $DepartureAirport): self
    {
        $this->DepartureAirport = $DepartureAirport;

        return $this;
    }

    public function getDestinationAirport(): ?string
    {
        return $this->DestinationAirport;
    }

    public function setDestinationAirport(string $DestinationAirport): self
    {
        $this->DestinationAirport = $DestinationAirport;

        return $this;
    }

    public function getDepartureDateTime(): ?\DateTimeInterface
    {
        return $this->DepartureDateTime;
    }

    public function setDepartureDateTime(\DateTimeInterface $DepartureDateTime): self
    {
        $this->DepartureDateTime = $DepartureDateTime;

        return $this;
    }

    public function getArrivalDateTime(): ?\DateTimeInterface
    {
        return $this->ArrivalDateTime;
    }

    public function setArrivalDateTime(\DateTimeInterface $ArrivalDateTime): self
    {
        $this->ArrivalDateTime = $ArrivalDateTime;

        return $this;
    }

    public function getPassengers(): ?string
    {
        return $this->Passengers;
    }

    public function setPassengers(string $Passengers): self
    {
        $this->Passengers = $Passengers;

        return $this;
    }
}
