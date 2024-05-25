<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSociete = null;

    #[ORM\Column(length: 255)]
    private ?string $TypeSociete = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\OneToMany(mappedBy: 'Societe', targetEntity: Achat::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $achats;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Vente::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $ventes;

    #[ORM\OneToMany(mappedBy: 'societe', targetEntity: Chevre::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $chevres;

    public function __construct()
    {
        $this->achats = new ArrayCollection();
        $this->ventes = new ArrayCollection();
        $this->chevres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    public function setNomSociete(string $nomSociete): static
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    public function getTypeSociete(): ?string
    {
        return $this->TypeSociete;
    }

    public function setTypeSociete(string $TypeSociete): static
    {
        $this->TypeSociete = $TypeSociete;

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
            $achat->setSociete($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): static
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getSociete() === $this) {
                $achat->setSociete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vente>
     */
    public function getVentes(): Collection
    {
        return $this->ventes;
    }

    public function addVente(Vente $vente): static
    {
        if (!$this->ventes->contains($vente)) {
            $this->ventes->add($vente);
            $vente->setSociete($this);
        }

        return $this;
    }

    public function removeVente(Vente $vente): static
    {
        if ($this->ventes->removeElement($vente)) {
            // set the owning side to null (unless already changed)
            if ($vente->getSociete() === $this) {
                $vente->setSociete(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Chevre>
     */
    public function getChevres(): Collection
    {
        return $this->chevres;
    }

    public function addChevre(Chevre $chevre): static
    {
        if (!$this->chevres->contains($chevre)) {
            $this->chevres->add($chevre);
            $chevre->setSociete($this);
        }

        return $this;
    }

    public function removeChevre(Chevre $chevre): static
    {
        if ($this->chevres->removeElement($chevre)) {
            // set the owning side to null (unless already changed)
            if ($chevre->getSociete() === $this) {
                $chevre->setSociete(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->nomSociete;
    }

}
