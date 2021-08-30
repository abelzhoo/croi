<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Repository\LogementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *      normalizationContext={"groups"={"logement_read"}},
 *      denormalizationContext={"groups"={"logement_write"}}
 * )
 * @ORM\Entity(repositoryClass=LogementRepository::class)
 */
class Logement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"logement_read", "membre_read"})
     */
    private $id;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressePermanente;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseTemporaire;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomPays;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $province;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montantLoyer;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montantSyndic;

    /**
     * @Groups({"logement_read", "logement_write"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $proprietaire;

    /**
     * @ORM\ManyToOne(targetEntity=Commity::class, inversedBy="possession", cascade={"persist", "remove"})
     */
    private $commity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressePermanente(): ?string
    {
        return $this->adressePermanente;
    }

    public function setAdressePermanente(?string $adressePermanente): self
    {
        $this->adressePermanente = $adressePermanente;

        return $this;
    }

    public function getAdresseTemporaire(): ?string
    {
        return $this->adresseTemporaire;
    }

    public function setAdresseTemporaire(?string $adresseTemporaire): self
    {
        $this->adresseTemporaire = $adresseTemporaire;

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

    public function getMontantLoyer(): ?string
    {
        return $this->montantLoyer;
    }

    public function setMontantLoyer(?string $montantLoyer): self
    {
        $this->montantLoyer = $montantLoyer;

        return $this;
    }

    public function getMontantSyndic(): ?string
    {
        return $this->montantSyndic;
    }

    public function setMontantSyndic(?string $montantSyndic): self
    {
        $this->montantSyndic = $montantSyndic;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

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
