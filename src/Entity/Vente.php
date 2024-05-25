<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDepart = null;

    #[ORM\Column]
    private ?float $prixVente = null;

    #[ORM\ManyToOne(inversedBy: 'ventes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Societe $societe = null;

    #[ORM\OneToMany(mappedBy: 'vente', targetEntity: Chevre::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $chevres;

    public function __construct()
    {
        $this->chevres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): static
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): static
    {
        $this->prixVente = $prixVente;

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
            $chevre->setVente($this);
        }

        return $this;
    }

    public function removeChevre(Chevre $chevre): static
    {
        if ($this->chevres->removeElement($chevre)) {
            // set the owning side to null (unless already changed)
            if ($chevre->getVente() === $this) {
                $chevre->setVente(null);
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
