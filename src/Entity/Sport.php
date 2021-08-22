<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"sport_read"}},
 *      denormalizationContext={"groups"={"sport_write"}}
 * )
 * @ORM\Entity(repositoryClass=SportRepository::class)
 */
class Sport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"sport_read","sport_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pratiqueSport;

    /**
     * @Groups({"sport_read","sport_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomSport;

    /**
     * @Groups({"sport_read","sport_write"})
     * @ORM\Column(type="string", length=255, length=255, nullable=true)
     */
    private $frequenceSport;

    /**
     * @Groups({"sport_read","sport_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pratiqueLoisir;

    /**
     * @Groups({"sport_read","sport_write"})
     * @ORM\Column(type="string", length=255, length=255, nullable=true)
     */
    private $nomLoisir;

    /**
     * @ORM\ManyToOne(targetEntity=Commity::class, inversedBy="sport")
     */
    private $commity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPratiqueSport(): ?string
    {
        return $this->pratiqueSport;
    }

    public function setPratiqueSport(?string $pratiqueSport): self
    {
        $this->pratiqueSport = $pratiqueSport;

        return $this;
    }

    public function getNomSport(): ?string
    {
        return $this->nomSport;
    }

    public function setNomSport(?string $nomSport): self
    {
        $this->nomSport = $nomSport;

        return $this;
    }

    public function getFrequenceSport(): ?string
    {
        return $this->frequenceSport;
    }

    public function setFrequenceSport(?string $frequenceSport): self
    {
        $this->frequenceSport = $frequenceSport;

        return $this;
    }

    public function getPratiqueLoisir(): ?string
    {
        return $this->pratiqueLoisir;
    }

    public function setPratiqueLoisir(?string $pratiqueLoisir): self
    {
        $this->pratiqueLoisir = $pratiqueLoisir;

        return $this;
    }

    public function getNomLoisir(): ?string
    {
        return $this->nomLoisir;
    }

    public function setNomLoisir(?string $nomLoisir): self
    {
        $this->nomLoisir = $nomLoisir;

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
