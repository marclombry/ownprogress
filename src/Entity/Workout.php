<?php

namespace App\Entity;

use App\Repository\WorkoutRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WorkoutRepository::class)
 */
class Workout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $pound;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreps;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPound(): ?float
    {
        return $this->pound;
    }

    public function setPound(?float $pound): self
    {
        $this->pound = $pound;

        return $this;
    }

    public function getNbreps(): ?int
    {
        return $this->nbreps;
    }

    public function setNbreps(int $nbreps): self
    {
        $this->nbreps = $nbreps;

        return $this;
    }
}
