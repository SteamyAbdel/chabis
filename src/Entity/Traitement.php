<?php

namespace App\Entity;

use App\Repository\TraitementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementRepository::class)]
class Traitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTraitement = null;

    #[ORM\Column]
    private ?int $numTraitement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $debutTraitement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $finTraitement = null;

    #[ORM\Column(length: 255)]
    private ?string $raisonTraitement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAchatTraitement = null;

    #[ORM\Column]
    private ?int $dureeQuantiteeEnJour = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateVisiteVeterinaire = null;

    #[ORM\Column(length: 255)]
    private ?string $raisonVisiteVeterinaire = null;

    #[ORM\OneToMany(mappedBy: 'traitement', targetEntity: Veterinaire::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: null)]
    private Collection $Veterinaires;

    #[ORM\OneToMany(mappedBy: 'Traitement', targetEntity: GroupeTraitement::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: null)]
    private Collection $groupeTraitements;

    public function __construct()
    {
        $this->Veterinaires = new ArrayCollection();
        $this->groupeTraitements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTraitement(): ?string
    {
        return $this->nomTraitement;
    }

    public function setNomTraitement(string $nomTraitement): static
    {
        $this->nomTraitement = $nomTraitement;

        return $this;
    }

    public function getNumTraitement(): ?int
    {
        return $this->numTraitement;
    }

    public function setNumTraitement(int $numTraitement): static
    {
        $this->numTraitement = $numTraitement;

        return $this;
    }

    public function getDebutTraitement(): ?\DateTimeInterface
    {
        return $this->debutTraitement;
    }

    public function setDebutTraitement(\DateTimeInterface $debutTraitement): static
    {
        $this->debutTraitement = $debutTraitement;

        return $this;
    }

    public function getFinTraitement(): ?\DateTimeInterface
    {
        return $this->finTraitement;
    }

    public function setFinTraitement(\DateTimeInterface $finTraitement): static
    {
        $this->finTraitement = $finTraitement;

        return $this;
    }

    public function getRaisonTraitement(): ?string
    {
        return $this->raisonTraitement;
    }

    public function setRaisonTraitement(string $raisonTraitement): static
    {
        $this->raisonTraitement = $raisonTraitement;

        return $this;
    }

    public function getDateAchatTraitement(): ?\DateTimeInterface
    {
        return $this->dateAchatTraitement;
    }

    public function setDateAchatTraitement(\DateTimeInterface $dateAchatTraitement): static
    {
        $this->dateAchatTraitement = $dateAchatTraitement;

        return $this;
    }

    public function getDureeQuantiteeEnJour(): ?int
    {
        return $this->dureeQuantiteeEnJour;
    }

    public function setDureeQuantiteeEnJour(int $dureeQuantiteeEnJour): static
    {
        $this->dureeQuantiteeEnJour = $dureeQuantiteeEnJour;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getDateVisiteVeterinaire(): ?\DateTimeInterface
    {
        return $this->dateVisiteVeterinaire;
    }

    public function setDateVisiteVeterinaire(\DateTimeInterface $dateVisiteVeterinaire): static
    {
        $this->dateVisiteVeterinaire = $dateVisiteVeterinaire;

        return $this;
    }

    public function getRaisonVisiteVeterinaire(): ?string
    {
        return $this->raisonVisiteVeterinaire;
    }

    public function setRaisonVisiteVeterinaire(string $raisonVisiteVeterinaire): static
    {
        $this->raisonVisiteVeterinaire = $raisonVisiteVeterinaire;

        return $this;
    }

    /**
     * @return Collection<int, Veterinaire>
     */
    public function getVeterinaires(): Collection
    {
        return $this->Veterinaires;
    }

    public function addVeterinaire(Veterinaire $veterinaire): static
    {
        if (!$this->Veterinaires->contains($veterinaire)) {
            $this->Veterinaires->add($veterinaire);
            $veterinaire->setTraitement($this);
        }

        return $this;
    }

    public function removeVeterinaire(Veterinaire $veterinaire): static
    {
        if ($this->Veterinaires->removeElement($veterinaire)) {
            // set the owning side to null (unless already changed)
            if ($veterinaire->getTraitement() === $this) {
                $veterinaire->setTraitement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GroupeTraitement>
     */
    public function getGroupeTraitements(): Collection
    {
        return $this->groupeTraitements;
    }

    public function addGroupeTraitement(GroupeTraitement $groupeTraitement): static
    {
        if (!$this->groupeTraitements->contains($groupeTraitement)) {
            $this->groupeTraitements->add($groupeTraitement);
            $groupeTraitement->setTraitement($this);
        }

        return $this;
    }

    public function removeGroupeTraitement(GroupeTraitement $groupeTraitement): static
    {
        if ($this->groupeTraitements->removeElement($groupeTraitement)) {
            // set the owning side to null (unless already changed)
            if ($groupeTraitement->getTraitement() === $this) {
                $groupeTraitement->setTraitement(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this ->nomTraitement;
    }


}
