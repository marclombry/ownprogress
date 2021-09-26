<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExerciceRepository::class)
 */
class Exercice
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreps;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbserie;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxpound;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="exercices")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getNbserie(): ?int
    {
        return $this->nbserie;
    }

    public function setNbserie(int $nbserie): self
    {
        $this->nbserie = $nbserie;

        return $this;
    }

    public function getMaxpound(): ?float
    {
        return $this->maxpound;
    }

    public function setMaxpound(?float $maxpound): self
    {
        $this->maxpound = $maxpound;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
