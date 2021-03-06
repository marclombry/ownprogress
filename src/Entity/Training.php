<?php

namespace App\Entity;

use App\Repository\TrainingRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrainingRepository::class)
 */
class Training
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_realized;

    /**
     * @ORM\ManyToMany(targetEntity=Exercice::class, inversedBy="trainings")
     */
    private $exercice;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_training;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="training")
     */
    private $user;

    public function __construct()
    {
        $this->exercice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsRealized(): ?bool
    {
        return $this->is_realized;
    }

    public function setIsRealized(?bool $is_realized): self
    {
        $this->is_realized = $is_realized;

        return $this;
    }

    /**
     * @return Collection|Exercice[]
     */
    public function getExercice(): Collection
    {
        return $this->exercice;
    }

    public function addExercice(Exercice $exercice): self
    {
        if (!$this->exercice->contains($exercice)) {
            $this->exercice[] = $exercice;
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): self
    {
        $this->exercice->removeElement($exercice);

        return $this;
    }

    public function getDateTraining(): ?\DateTimeInterface
    {
        if(!$this->date_training) $this->date_training = new \Datetime('now');
        return $this->date_training;
    }

    public function setDateTraining(?\DateTimeInterface $date_training): self
    {
        $this->date_training = $date_training;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
