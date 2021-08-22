<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\TablighRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"tabligh_read"}},
 *      denormalizationContext={"groups"={"tabligh_write"}}
 * )
 * @ORM\Entity(repositoryClass=TablighRepository::class)
 */
class Tabligh
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"tabligh_read","tabligh_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $questionMadressa;

    /**
     * @Groups({"tabligh_read","tabligh_write"})
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    private $classeMadressa;

    /**
     * @Groups({"tabligh_read","tabligh_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $frequentMadressa;

    /**
     * @Groups({"tabligh_read","tabligh_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $freqMosquetAnnee;

    /**
     * @Groups({"tabligh_read","tabligh_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $proposition;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="tabligh", cascade={"persist", "remove"})
     */
    private $commity;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $frequentMosquet = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionMadressa(): ?string
    {
        return $this->questionMadressa;
    }

    public function setQuestionMadressa(?string $questionMadressa): self
    {
        $this->questionMadressa = $questionMadressa;

        return $this;
    }

    public function getClasseMadressa(): ?int
    {
        return $this->classeMadressa;
    }

    public function setClasseMadressa(?int $classeMadressa): self
    {
        $this->classeMadressa = $classeMadressa;

        return $this;
    }

    public function getFrequentMadressa(): ?string
    {
        return $this->frequentMadressa;
    }

    public function setFrequentMadressa(?string $frequentMadressa): self
    {
        $this->frequentMadressa = $frequentMadressa;

        return $this;
    }

    public function getFreqMosquetAnnee(): ?string
    {
        return $this->freqMosquetAnnee;
    }

    public function setFreqMosquetAnnee(?string $freqMosquetAnnee): self
    {
        $this->freqMosquetAnnee = $freqMosquetAnnee;

        return $this;
    }

    public function getQuestionMosque(): ?string
    {
        return $this->questionMosque;
    }

    public function setQuestionMosque(string $questionMosque): self
    {
        $this->questionMosque = $questionMosque;

        return $this;
    }

    public function getProposition(): ?string
    {
        return $this->proposition;
    }

    public function setProposition(?string $proposition): self
    {
        $this->proposition = $proposition;

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

    public function getFrequentMosquet(): ?array
    {
        return $this->frequentMosquet;
    }

    public function setFrequentMosquet(?array $frequentMosquet): self
    {
        $this->frequentMosquet = $frequentMosquet;

        return $this;
    }

}
