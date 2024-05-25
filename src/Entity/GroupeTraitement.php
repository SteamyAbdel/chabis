<?php

namespace App\Entity;

use App\Repository\GroupeTraitementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GroupeTraitementRepository::class)]
class GroupeTraitement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numGroupe = null;

    #[ORM\ManyToOne(inversedBy: 'groupeTraitements')]
    #[ORM\JoinColumn(nullable: false, onDelete: null)]
    private ?Traitement $Traitement = null;

    #[ORM\ManyToMany(targetEntity: Chevre::class, mappedBy: 'groupetraitements')]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    private Collection $chevres;

    public function __construct()
    {
        $this->chevres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumGroupe(): ?int
    {
        return $this->numGroupe;
    }

    public function setNumGroupe(int $numGroupe): static
    {
        $this->numGroupe = $numGroupe;

        return $this;
    }

    public function getTraitement(): ?Traitement
    {
        return $this->Traitement;
    }

    public function setTraitement(?Traitement $Traitement): static
    {
        $this->Traitement = $Traitement;

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
            $chevre->addGroupetraitement($this);
        }

        return $this;
    }

    public function removeChevre(Chevre $chevre): static
    {
        if ($this->chevres->removeElement($chevre)) {
            $chevre->removeGroupetraitement($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this ->id;
    }

}
