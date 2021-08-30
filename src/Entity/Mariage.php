<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MariageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\OneToMany(targetEntity=Enfant::class, mappedBy="parent", cascade={"persist", "remove"})
     */
    private $enfants;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="mariMariage", cascade={"remove"})
     */
    private $mari;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="marieMariage", cascade={"remove"})
     */
    private $marie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomFamille;


    public function __construct()
    {
        $this->enfants = new ArrayCollection();
    }

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

    /**
     * @return Collection|Enfant[]
     */
    public function getEnfants(): Collection
    {
        return $this->enfants;
    }

    public function addEnfant(Enfant $enfant): self
    {
        if (!$this->enfants->contains($enfant)) {
            $this->enfants[] = $enfant;
            $enfant->setParent($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getParent() === $this) {
                $enfant->setParent(null);
            }
        }

        return $this;
    }

    public function getMari(): ?Commity
    {
        return $this->mari;
    }

    public function setMari(?Commity $mari): self
    {
        $this->mari = $mari;

        return $this;
    }

    public function getMarie(): ?Commity
    {
        return $this->marie;
    }

    public function setMarie(?Commity $marie): self
    {
        $this->marie = $marie;

        return $this;
    }

    public function getNomFamille(): ?string
    {
        return $this->nomFamille;
    }

    public function setNomFamille(?string $nomFamille): self
    {
        $this->nomFamille = $nomFamille;

        return $this;
    }
}
