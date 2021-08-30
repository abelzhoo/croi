<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EnfantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=EnfantRepository::class)
 */
class Enfant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="pereEnfant", cascade={"persist", "remove"})
     */
    private $pere;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="mereEnfant", cascade={"persist", "remove"})
     */
    private $mere;

    /**
     * @ORM\ManyToOne(targetEntity=Commity::class, inversedBy="enfants")
     */
    private $enfant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPere(): ?Commity
    {
        return $this->pere;
    }

    public function setPere(?Commity $pere): self
    {
        $this->pere = $pere;

        return $this;
    }

    public function getMere(): ?Commity
    {
        return $this->mere;
    }

    public function setMere(?Commity $mere): self
    {
        $this->mere = $mere;

        return $this;
    }

    public function getEnfant(): ?Commity
    {
        return $this->enfant;
    }

    public function setEnfant(?Commity $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }

}
