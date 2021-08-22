<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\ProfessionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"profession_read"}},
 *      denormalizationContext={"groups"={"profession_write"}}
 * )
 * @ORM\Entity(repositoryClass=ProfessionRepository::class)
 */
class Profession
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domaineActivite;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255,  nullable=true)
     */
    private $salaire;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prime;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255, length=255, nullable=true)
     */
    private $profession;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $personnel;

    /**
     * @Groups({"profession_read","profession_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $locataire;

    /**
     * @ORM\ManyToOne(targetEntity=Commity::class, inversedBy="profession")
     */
    private $commity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDomaineActivite(): ?string
    {
        return $this->domaineActivite;
    }

    public function setDomaineActivite(?string $domaineActivite): self
    {
        $this->domaineActivite = $domaineActivite;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(?int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getPrime(): ?int
    {
        return $this->prime;
    }

    public function setPrime(?int $prime): self
    {
        $this->prime = $prime;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(?string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getPersonnel(): ?string
    {
        return $this->personnel;
    }

    public function setPersonnel(?string $personnel): self
    {
        $this->personnel = $personnel;

        return $this;
    }

    public function getLocataire(): ?string
    {
        return $this->locataire;
    }

    public function setLocataire(string $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }

    public function getCommity(): ?Commity
    {
        return $this->commity;
    }

    public function setCommity(?Commity $commity): self
    {
        $this->commity = $commity;

        return $this;
    }
}
