<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\EducationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"education_read"}},
 *      denormalizationContext={"groups"={"education_write"}}
 * )
 * @ORM\Entity(repositoryClass=EducationRepository::class)
 */
class Education
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomEcole;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomUniversite;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $classe;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carteEtudiant;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseEcole;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseUniversite;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="date", length=255, nullable=true)
     */
    private $anneeScolaire;

    /**
     * @Groups({"education_read","education_write"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $nomPays;

    /**
    * @Groups({"education_read","education_write"})
    * @ORM\Column(type="string", nullable=true)
    */
    private $province;

    /**
    * @Groups({"education_read","education_write"})
    * @ORM\Column(type="string", length=255, nullable=true)
    */
    private $niveauEtude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $aideEducation;

    /**
     * @ORM\ManyToOne(targetEntity=Commity::class, inversedBy="etudiant", cascade={"persist", "remove"})
     */
    private $commity;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEcole(): ?string
    {
        return $this->nomEcole;
    }

    public function setNomEcole(?string $nomEcole): self
    {
        $this->nomEcole = $nomEcole;

        return $this;
    }

    public function getNomUniversite(): ?string
    {
        return $this->nomUniversite;
    }

    public function setNomUniversite(?string $nomUniversite): self
    {
        $this->nomUniversite = $nomUniversite;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->classe;
    }

    public function setClasse(?string $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    public function getCarteEtudiant(): ?string
    {
        return $this->carteEtudiant;
    }

    public function setCarteEtudiant(?string $carteEtudiant): self
    {
        $this->carteEtudiant = $carteEtudiant;

        return $this;
    }

    public function getAdresseEcole(): ?string
    {
        return $this->adresseEcole;
    }

    public function setAdresseEcole(?string $adresseEcole): self
    {
        $this->adresseEcole = $adresseEcole;

        return $this;
    }

    public function getAdresseUniversite(): ?string
    {
        return $this->adresseUniversite;
    }

    public function setAdresseUniversite(?string $adresseUniversite): self
    {
        $this->adresseUniversite = $adresseUniversite;

        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(?string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getAnneeScolaire(): ?\DateTimeInterface
    {
        return $this->anneeScolaire;
    }

    public function setAnneeScolaire(?\DateTimeInterface $anneeScolaire): self
    {
        $this->anneeScolaire = $anneeScolaire;

        return $this;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(?string $nomPays): self
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getNiveauEtude(): ?string
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(?string $niveauEtude): self
    {
        $this->niveauEtude = $niveauEtude;

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
