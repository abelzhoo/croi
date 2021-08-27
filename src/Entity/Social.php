<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SocialRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"social_read"}},
 *      denormalizationContext={"groups"={"social_write"}}
 * )
 * @ORM\Entity(repositoryClass=SocialRepository::class)
 */
class Social
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"social_read","social_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideNourriture;

    /**
     * @Groups({"social_read","social_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideEducation;

    /**
     * @Groups({"social_read","social_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideSocial;

    /**
     * @Groups({"social_read","social_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideSante;

    /**
     * @Groups({"social_read","social_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideTravail;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="social", cascade={"persist", "remove"})
     */
    private $commity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAideNourriture(): ?string
    {
        return $this->aideNourriture;
    }

    public function setAideNourriture(?string $aideNourriture): self
    {
        $this->aideNourriture = $aideNourriture;

        return $this;
    }

    public function getAideEducation(): ?string
    {
        return $this->aideEducation;
    }

    public function setAideEducation(?string $aideEducation): self
    {
        $this->aideEducation = $aideEducation;

        return $this;
    }

    public function getAideSocial(): ?string
    {
        return $this->aideSocial;
    }

    public function setAideSocial(?string $aideSocial): self
    {
        $this->aideSocial = $aideSocial;

        return $this;
    }

    public function getAideSante(): ?string
    {
        return $this->aideSante;
    }

    public function setAideSante(?string $aideSante): self
    {
        $this->aideSante = $aideSante;

        return $this;
    }

    public function getAideTravail(): ?string
    {
        return $this->aideTravail;
    }

    public function setAideTravail(?string $aideTravail): self
    {
        $this->aideTravail = $aideTravail;

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
