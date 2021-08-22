<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MariageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=MariageRepository::class)
 */
class Mariage
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
    private $dateMariage;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="mariage", cascade={"persist", "remove"})
     */
    private $commity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateMariage(): ?\DateTimeInterface
    {
        return $this->dateMariage;
    }

    public function setDateMariage(?\DateTimeInterface $dateMariage): self
    {
        $this->dateMariage = $dateMariage;

        return $this;
    }

    public function getCommity(): ?Commity
    {
        return $this->commity;
    }

    public function setCommity(?Commity $commity): self
    {
        // unset the owning side of the relation if necessary
        if ($commity === null && $this->commity !== null) {
            $this->commity->setMariage(null);
        }

        // set the owning side of the relation if necessary
        if ($commity !== null && $commity->getMariage() !== $this) {
            $commity->setMariage($this);
        }

        $this->commity = $commity;

        return $this;
    }
}
