<?php

namespace App\Entity;

use App\Repository\CommityRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 *  @ApiResource(
 *      normalizationContext={"groups"={"commity_read"}},
 *      denormalizationContext={"groups"={"commity_write"}}
 * )
 * @ORM\Entity(repositoryClass=CommityRepository::class)
 * 
 * @Vich\Uploadable
 */
class Commity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomFamille;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomFamille;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieuNaissance;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nationalite;

    /**
     * @Groups({"commity_read","commity_write"})
     */
    private $documentVoyage = [];

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroPassport;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroCin;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $situationMarital;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroPhone;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseEmail;

    /**
    * @ORM\Column(type="string", length=255)
    * @var string
    */
    private $image;

    /**
    * @Groups({"commity_read","commity_write"})
    * @Vich\UploadableField(mapping="personne_avatar", fileNameProperty="image")
    * @var File
    */
    private $imageFile;

    /**
     * @Groups({"commity_read","commity_write"})
     * @ORM\Column(type="string", length=255)
     */
    private $situationFamiliale;

    /**
     * @ORM\OneToOne(targetEntity=Sante::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $sante;

    /**
     * @ORM\OneToOne(targetEntity=Tabligh::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $tabligh;

    /**
     * @ORM\OneToOne(targetEntity=Social::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $social;

    /**
     * @ORM\OneToMany(targetEntity=Logement::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $possession;

    /**
     * @ORM\OneToMany(targetEntity=Education::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $etudiant;

    /**
     * @ORM\OneToMany(targetEntity=Profession::class, mappedBy="commity", cascade={"persist", "remove"})
     */
    private $profession;

    /**
     * @ORM\OneToMany(targetEntity=Sport::class, mappedBy="commity", cascade={"persist","remove"})
     */
    private $sport;

    /**
     * @ORM\OneToOne(targetEntity=Deces::class, mappedBy="personne", cascade={"persist", "remove"})
     */
    private $deces;

    /**
     * @ORM\OneToOne(targetEntity=Mariage::class, mappedBy="mari", cascade={"remove"})
     */
    private $mariMariage;

    /**
     * @ORM\OneToOne(targetEntity=Mariage::class, mappedBy="marie", cascade={"remove"})
     */
    private $marieMariage;

    /**
     * @ORM\OneToOne(targetEntity=Enfant::class, mappedBy="pere", cascade={"persist", "remove"})
     */
    private $pereEnfant;

    /**
     * @ORM\OneToOne(targetEntity=Enfant::class, mappedBy="mere", cascade={"persist", "remove"})
     */
    private $mereEnfant;

    /**
     * @ORM\OneToMany(targetEntity=Enfant::class, mappedBy="enfant")
     */
    private $enfants;

    public function __construct()
    {
        $this->possession = new ArrayCollection();
        $this->etudiant = new ArrayCollection();
        $this->profession = new ArrayCollection();
        $this->sport = new ArrayCollection();
        $this->enfants = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrenomFamille(): ?string
    {
        return $this->prenomFamille;
    }

    public function setPrenomFamille(?string $prenomFamille): self
    {
        $this->prenomFamille = $prenomFamille;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieuNaissance;
    }

    public function setLieuNaissance(?string $lieuNaissance): self
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(?string $nationalite): self
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getDocumentVoyage()
    {
        return $this->documentVoyage;
    }

    public function setDocumentVoyage($documentVoyage)
    {
        $this->documentVoyage = $documentVoyage;

        return $this;
    }

    public function getNumeroPassport(): ?string
    {
        return $this->numeroPassport;
    }

    public function setNumeroPassport(?string $numeroPassport): self
    {
        $this->numeroPassport = $numeroPassport;

        return $this;
    }

    public function getNumeroCin(): ?string
    {
        return $this->numeroCin;
    }

    public function setNumeroCin(?string $numeroCin): self
    {
        $this->numeroCin = $numeroCin;

        return $this;
    }

    public function getSituationMarital(): ?string
    {
        return $this->situationMarital;
    }

    public function setSituationMarital(?string $situationMarital): self
    {
        $this->situationMarital = $situationMarital;

        return $this;
    }

    public function getNumeroPhone(): ?string
    {
        return $this->numeroPhone;
    }

    public function setNumeroPhone(?string $numeroPhone): self
    {
        $this->numeroPhone = $numeroPhone;

        return $this;
    }

    public function getAdresseEmail(): ?string
    {
        return $this->adresseEmail;
    }

    public function setAdresseEmail(?string $adresseEmail): self
    {
        $this->adresseEmail = $adresseEmail;

        return $this;
    }

    public function getMariage(): ?Mariage
    {
        return $this->mariage;
    }

    public function setMariage(?Mariage $mariage): self
    {
        $this->mariage = $mariage;

        return $this;
    }


    public function getSituationFamiliale(): ?string
    {
        return $this->situationFamiliale;
    }

    public function setSituationFamiliale(string $situationFamiliale): self
    {
        $this->situationFamiliale = $situationFamiliale;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSante(): ?Sante
    {
        return $this->sante;
    }

    public function setSante(?Sante $sante): self
    {
        // unset the owning side of the relation if necessary
        if ($sante === null && $this->sante !== null) {
            $this->sante->setCommity(null);
        }

        if ($sante !== null && $sante->getCommity() !== $this) {
            $sante->setCommity($this);
        }

        $this->sante = $sante;

        return $this;
    }

    public function getTabligh(): ?Tabligh
    {
        return $this->tabligh;
    }

    public function setTabligh(?Tabligh $tabligh): self
    {
        // unset the owning side of the relation if necessary
        if ($tabligh === null && $this->tabligh !== null) {
            $this->tabligh->setCommity(null);
        }

        // set the owning side of the relation if necessary
        if ($tabligh !== null && $tabligh->getCommity() !== $this) {
            $tabligh->setCommity($this);
        }

        $this->tabligh = $tabligh;

        return $this;
    }

    public function getSocial(): ?Social
    {
        return $this->social;
    }

    public function setSocial(?Social $social): self
    {
        // unset the owning side of the relation if necessary
        if ($social === null && $this->social !== null) {
            $this->social->setCommity(null);
        }

        // set the owning side of the relation if necessary
        if ($social !== null && $social->getCommity() !== $this) {
            $social->setCommity($this);
        }

        $this->social = $social;

        return $this;
    }

    /**
     * @return Collection|Logement[]
     */
    public function getPossession(): Collection
    {
        return $this->possession;
    }

    public function addPossession(Logement $possession): self
    {
        if (!$this->possession->contains($possession)) {
            $this->possession[] = $possession;
            $possession->setCommity($this);
        }

        return $this;
    }

    public function removePossession(Logement $possession): self
    {
        if ($this->possession->removeElement($possession)) {
            // set the owning side to null (unless already changed)
            if ($possession->getCommity() === $this) {
                $possession->setCommity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Education[]
     */
    public function getEtudiant(): Collection
    {
        return $this->etudiant;
    }

    public function addEtudiant(Education $etudiant): self
    {
        if (!$this->etudiant->contains($etudiant)) {
            $this->etudiant[] = $etudiant;
            $etudiant->setCommity($this);
        }

        return $this;
    }

    public function removeEtudiant(Education $etudiant): self
    {
        if ($this->etudiant->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getCommity() === $this) {
                $etudiant->setCommity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Profession[]
     */
    public function getProfession(): Collection
    {
        return $this->profession;
    }

    public function addProfession(Profession $profession): self
    {
        if (!$this->profession->contains($profession)) {
            $this->profession[] = $profession;
            $profession->setCommity($this);
        }

        return $this;
    }

    public function removeProfession(Profession $profession): self
    {
        if ($this->profession->removeElement($profession)) {
            // set the owning side to null (unless already changed)
            if ($profession->getCommity() === $this) {
                $profession->setCommity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSport(): Collection
    {
        return $this->sport;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sport->contains($sport)) {
            $this->sport[] = $sport;
            $sport->setCommity($this);
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sport->removeElement($sport)) {
            // set the owning side to null (unless already changed)
            if ($sport->getCommity() === $this) {
                $sport->setCommity(null);
            }
        }

        return $this;
    }

    public function getDeces(): ?Deces
    {
        return $this->deces;
    }

    public function setDeces(?Deces $deces): self
    {
        // unset the owning side of the relation if necessary
        if ($deces === null && $this->deces !== null) {
            $this->deces->setPersonne(null);
        }

        // set the owning side of the relation if necessary
        if ($deces !== null && $deces->getPersonne() !== $this) {
            $deces->setPersonne($this);
        }

        $this->deces = $deces;

        return $this;
    }

    public function getMariMariage(): ?Mariage
    {
        return $this->mariMariage;
    }

    public function setMariMariage(?Mariage $mariMariage): self
    {
        // unset the owning side of the relation if necessary
        if ($mariMariage === null && $this->mariMariage !== null) {
            $this->mariMariage->setMari(null);
        }

        // set the owning side of the relation if necessary
        if ($mariMariage !== null && $mariMariage->getMari() !== $this) {
            $mariMariage->setMari($this);
        }

        $this->mariMariage = $mariMariage;

        return $this;
    }

    public function getMarieMariage(): ?Mariage
    {
        return $this->marieMariage;
    }

    public function setMarieMariage(?Mariage $marieMariage): self
    {
        // unset the owning side of the relation if necessary
        if ($marieMariage === null && $this->marieMariage !== null) {
            $this->marieMariage->setMarie(null);
        }

        // set the owning side of the relation if necessary
        if ($marieMariage !== null && $marieMariage->getMarie() !== $this) {
            $marieMariage->setMarie($this);
        }

        $this->marieMariage = $marieMariage;

        return $this;
    }

    public function getPereEnfant(): ?Enfant
    {
        return $this->pereEnfant;
    }

    public function setPereEnfant(?Enfant $pereEnfant): self
    {
        // unset the owning side of the relation if necessary
        if ($pereEnfant === null && $this->pereEnfant !== null) {
            $this->pereEnfant->setPere(null);
        }

        // set the owning side of the relation if necessary
        if ($pereEnfant !== null && $pereEnfant->getPere() !== $this) {
            $pereEnfant->setPere($this);
        }

        $this->pereEnfant = $pereEnfant;

        return $this;
    }

    public function getMereEnfant(): ?Enfant
    {
        return $this->mereEnfant;
    }

    public function setMereEnfant(?Enfant $mereEnfant): self
    {
        // unset the owning side of the relation if necessary
        if ($mereEnfant === null && $this->mereEnfant !== null) {
            $this->mereEnfant->setMere(null);
        }

        // set the owning side of the relation if necessary
        if ($mereEnfant !== null && $mereEnfant->getMere() !== $this) {
            $mereEnfant->setMere($this);
        }

        $this->mereEnfant = $mereEnfant;

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
            $enfant->setEnfant($this);
        }

        return $this;
    }

    public function removeEnfant(Enfant $enfant): self
    {
        if ($this->enfants->removeElement($enfant)) {
            // set the owning side to null (unless already changed)
            if ($enfant->getEnfant() === $this) {
                $enfant->setEnfant(null);
            }
        }

        return $this;
    }
}
