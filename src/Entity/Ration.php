<?php

namespace App\Entity;

use App\Repository\RationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RationRepository::class)]
class Ration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $quantiteRation = null;

    #[ORM\ManyToOne(inversedBy: 'rations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Aliment $Aliments = null;

    #[ORM\OneToMany(mappedBy: 'ration', targetEntity: Cheptel::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $cheptels;

    public function __construct()
    {
        $this->cheptels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteRation(): ?float
    {
        return $this->quantiteRation;
    }

    public function setQuantiteRation(float $quantiteRation): static
    {
        $this->quantiteRation = $quantiteRation;

        return $this;
    }

    public function getAliments(): ?Aliment
    {
        return $this->Aliments;
    }

    public function setAliments(?Aliment $Aliments): static
    {
        $this->Aliments = $Aliments;

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
            $cheptel->setRation($this);
        }

        return $this;
    }

    public function removeCheptel(Cheptel $cheptel): static
    {
        if ($this->cheptels->removeElement($cheptel)) {
            // set the owning side to null (unless already changed)
            if ($cheptel->getRation() === $this) {
                $cheptel->setRation(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId();
    }


}
