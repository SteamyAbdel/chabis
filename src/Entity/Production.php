<?php

namespace App\Entity;

use App\Repository\ProductionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductionRepository::class)]
class Production
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantiteeProduction = null;

    #[ORM\Column(length: 255)]
    private ?string $qualite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateProduction = null;

    #[ORM\Column]
    private ?float $matiereButyrique = null;

    #[ORM\Column]
    private ?float $MatiereProteique = null;

    #[ORM\Column]
    private ?float $tauxCellulaire = null;

    #[ORM\ManyToMany(targetEntity: Cheptel::class, mappedBy: 'productions')]
    #[ORM\JoinColumn(nullable: true,onDelete: "SET NULL")]
    private Collection $cheptels;

    public function __construct()
    {
        $this->cheptels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteeProduction(): ?float
    {
        return $this->quantiteeProduction;
    }

    public function setQuantiteeProduction(float $quantiteeProduction): static
    {
        $this->quantiteeProduction = $quantiteeProduction;

        return $this;
    }

    public function getQualite(): ?string
    {
        return $this->qualite;
    }

    public function setQualite(string $qualite): static
    {
        $this->qualite = $qualite;

        return $this;
    }

    public function getDateProduction(): ?\DateTimeInterface
    {
        return $this->dateProduction;
    }

    public function setDateProduction(\DateTimeInterface $dateProduction): static
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    public function getMatiereButyrique(): ?float
    {
        return $this->matiereButyrique;
    }

    public function setMatiereButyrique(float $matiereButyrique): static
    {
        $this->matiereButyrique = $matiereButyrique;

        return $this;
    }

    public function getMatiereProteique(): ?float
    {
        return $this->MatiereProteique;
    }

    public function setMatiereProteique(float $MatiereProteique): static
    {
        $this->MatiereProteique = $MatiereProteique;

        return $this;
    }

    public function getTauxCellulaire(): ?float
    {
        return $this->tauxCellulaire;
    }

    public function setTauxCellulaire(float $tauxCellulaire): static
    {
        $this->tauxCellulaire = $tauxCellulaire;

        return $this;
    }

    /**
     * @return Collection<int, Cheptel>
     */
    public function getCheptels(): Collection
    {
        return $this->cheptels;
    }

    public function addCheptel(Cheptel $cheptel): static
    {
        if (!$this->cheptels->contains($cheptel)) {
            $this->cheptels->add($cheptel);
            $cheptel->addProduction($this);
        }

        return $this;
    }

    public function removeCheptel(Cheptel $cheptel): static
    {
        if ($this->cheptels->removeElement($cheptel)) {
            $cheptel->removeProduction($this);
        }

        return $this;
    }
}
