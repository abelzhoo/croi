<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\SanteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"sante_read"}},
 *      denormalizationContext={"groups"={"sante_write"}}
 * )
 * @ORM\Entity(repositoryClass=SanteRepository::class)
 */
class Sante
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groupeSanguin;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maladieChronique;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tailles;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poids;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $intervention;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paysChirurgie;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomMedicament;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $maladieRelative;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $limiteSante;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempsLimite;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="array", nullable=true)
     */
    private $objetPorte = [];

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prixIntervention;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $traitementMedical;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $frequenceMaladie;

    /**
     * @ORM\OneToOne(targetEntity=Commity::class, inversedBy="sante", cascade={"persist", "remove"})
     */
    private $commity;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="datetime", length=255, nullable=true)
     */
    private $dateDebut;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="datetime", length=255, nullable=true)
     */
    private $dateFin;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $consultMedicin;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bilanSanguin;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $obj;

    /**
     * @Groups({"sante_read","sante_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $chirurgie;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typeMaladie = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupeSanguin(): ?string
    {
        return $this->groupeSanguin;
    }

    public function setGroupeSanguin(?string $groupeSanguin): self
    {
        $this->groupeSanguin = $groupeSanguin;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getMaladieChronique(): ?string
    {
        return $this->maladieChronique;
    }

    public function setMaladieChronique(?string $maladieChronique): self
    {
        $this->maladieChronique = $maladieChronique;

        return $this;
    }

    public function getTailles(): ?string
    {
        return $this->tailles;
    }

    public function setTailles(?string $tailles): self
    {
        $this->tailles = $tailles;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }


    public function getIntervention(): ?string
    {
        return $this->intervention;
    }

    public function setIntervention(?string $intervention): self
    {
        $this->intervention = $intervention;

        return $this;
    }

    public function getPaysChirurgie(): ?string
    {
        return $this->paysChirurgie;
    }

    public function setPaysChirurgie(?string $paysChirurgie): self
    {
        $this->paysChirurgie = $paysChirurgie;

        return $this;
    }

    public function getNomMedicament(): ?string
    {
        return $this->nomMedicament;
    }

    public function setNomMedicament(?string $nomMedicament): self
    {
        $this->nomMedicament = $nomMedicament;

        return $this;
    }

    public function getMaladieRelative(): ?string
    {
        return $this->maladieRelative;
    }

    public function setMaladieRelative(?string $maladieRelative): self
    {
        $this->maladieRelative = $maladieRelative;

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

    public function getLimiteSante(): ?string
    {
        return $this->limiteSante;
    }

    public function setLimiteSante(?string $limiteSante): self
    {
        $this->limiteSante = $limiteSante;

        return $this;
    }

    public function getTempsLimite(): ?string
    {
        return $this->tempsLimite;
    }

    public function setTempsLimite(?string $tempsLimite): self
    {
        $this->tempsLimite = $tempsLimite;

        return $this;
    }

    public function getObjetPorte(): ?array
    {
        return $this->objetPorte;
    }

    public function setObjetPorte(?array $objetPorte): self
    {
        $this->objetPorte = $objetPorte;

        return $this;
    }

    public function getPrixIntervention(): ?string
    {
        return $this->prixIntervention;
    }

    public function setPrixIntervention(?string $prixIntervention): self
    {
        $this->prixIntervention = $prixIntervention;

        return $this;
    }

    public function getTraitementMedical(): ?string
    {
        return $this->traitementMedical;
    }

    public function setTraitementMedical(?string $traitementMedical): self
    {
        $this->traitementMedical = $traitementMedical;

        return $this;
    }

    public function getFrequenceMaladie(): ?string
    {
        return $this->frequenceMaladie;
    }

    public function setFrequenceMaladie(?string $frequenceMaladie): self
    {
        $this->frequenceMaladie = $frequenceMaladie;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTime $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getConsultMedicin(): ?string
    {
        return $this->consultMedicin;
    }

    public function setConsultMedicin(?string $consultMedicin): self
    {
        $this->consultMedicin = $consultMedicin;

        return $this;
    }

    public function getBilanSanguin(): ?string
    {
        return $this->bilanSanguin;
    }

    public function setBilanSanguin(?string $bilanSanguin): self
    {
        $this->bilanSanguin = $bilanSanguin;

        return $this;
    }

    public function getObj(): ?string
    {
        return $this->obj;
    }

    public function setObj(?string $obj): self
    {
        $this->obj = $obj;

        return $this;
    }

    public function getChirurgie(): ?string
    {
        return $this->chirurgie;
    }

    public function setChirurgie(?string $chirurgie): self
    {
        $this->chirurgie = $chirurgie;

        return $this;
    }

    public function getTypeMaladie(): ?array
    {
        return $this->typeMaladie;
    }

    public function setTypeMaladie(?array $typeMaladie): self
    {
        $this->typeMaladie = $typeMaladie;

        return $this;
    }
}
