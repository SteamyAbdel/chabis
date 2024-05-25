<?php

namespace App\Entity;

use App\Repository\ChevreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChevreRepository::class)]
class Chevre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $matriculeChevre = null;

    #[ORM\Column(length: 255)]
    private ?string $ancienMatricule = null;

    #[ORM\Column(length: 255)]
    private ?string $sexeChevre = null;

    #[ORM\Column(length: 255)]
    private ?string $raceChevre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateArrivee = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'chevres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cheptel $cheptel = null;

    #[ORM\ManyToOne(inversedBy: 'chevres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $pays = null;

    #[ORM\ManyToMany(targetEntity: GroupeTraitement::class, inversedBy: 'chevres')]
    #[ORM\JoinColumn(nullable: false, onDelete: "SET NULL")]
    private Collection $groupetraitements;

    #[ORM\ManyToOne(inversedBy: 'chevres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\ManyToOne(inversedBy: 'chevres')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Vente $vente = null;

    #[ORM\OneToMany(mappedBy: 'chevre', targetEntity: Achat::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $achats;

    public function __construct()
    {
        $this->groupetraitements = new ArrayCollection();
        $this->achats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeChevre(): ?string
    {
        return $this->matriculeChevre;
    }

    public function setMatriculeChevre(string $matriculeChevre): static
    {
        $this->matriculeChevre = $matriculeChevre;

        return $this;
    }

    public function getAncienMatricule(): ?string
    {
        return $this->ancienMatricule;
    }

    public function setAncienMatricule(string $ancienMatricule): static
    {
        $this->ancienMatricule = $ancienMatricule;

        return $this;
    }

    public function getSexeChevre(): ?string
    {
        return $this->sexeChevre;
    }

    public function setSexeChevre(string $sexeChevre): static
    {
        $this->sexeChevre = $sexeChevre;

        return $this;
    }

    public function getRaceChevre(): ?string
    {
        return $this->raceChevre;
    }

    public function setRaceChevre(string $raceChevre): static
    {
        $this->raceChevre = $raceChevre;

        return $this;
    }

    public function getDateArrivee(): ?\DateTimeInterface
    {
        return $this->dateArrivee;
    }

    public function setDateArrivee(\DateTimeInterface $dateArrivee): static
    {
        $this->dateArrivee = $dateArrivee;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

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

    public function getCheptel(): ?Cheptel
    {
        return $this->cheptel;
    }

    public function setCheptel(?Cheptel $cheptel): static
    {
        $this->cheptel = $cheptel;

        return $this;
    }

    public function setSituation(?Situation $situation): static
    {
        $this->situation = $situation;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): static
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * @return Collection<int, GroupeTraitement>
     */
    public function getGroupetraitements(): Collection
    {
        return $this->groupetraitements;
    }

    public function addGroupetraitement(GroupeTraitement $groupetraitement): static
    {
        if (!$this->groupetraitements->contains($groupetraitement)) {
            $this->groupetraitements->add($groupetraitement);
        }

        return $this;
    }

    public function removeGroupetraitement(GroupeTraitement $groupetraitement): static
    {
        $this->groupetraitements->removeElement($groupetraitement);

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): static
    {
        $this->vente = $vente;

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): static
    {
        if (!$this->achats->contains($achat)) {
            $this->achats->add($achat);
            $achat->setChevre($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): static
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getChevre() === $this) {
                $achat->setChevre(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->id;
    }
}
