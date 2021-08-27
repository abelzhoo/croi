<?php

namespace App\Entity;

use App\Repository\DecesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DecesRepository::class)
 */
class Deces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDeces;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateEnterement;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="deces", cascade={"persist", "remove"})
     */
    private $personne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDeces(): ?\DateTimeInterface
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?\DateTimeInterface $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    public function getDateEnterement(): ?\DateTimeInterface
    {
        return $this->dateEnterement;
    }

    public function setDateEnterement(?\DateTimeInterface $dateEnterement): self
    {
        $this->dateEnterement = $dateEnterement;

        return $this;
    }

    public function getPersonne(): ?Commity
    {
        return $this->personne;
    }

    public function setPersonne(?Commity $personne): self
    {
        $this->personne = $personne;

        return $this;
    }
}
