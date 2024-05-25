<?php

namespace App\Entity;

use App\Repository\CheptelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CheptelRepository::class)]
class Cheptel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCheptel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\ManyToMany(targetEntity: Production::class, inversedBy: 'cheptels')]
    #[ORM\JoinColumn(nullable: true,onDelete: "SET NULL")]
    private Collection $productions;

    #[ORM\ManyToOne(inversedBy: 'cheptels')]
    #[ORM\JoinColumn(nullable: true,onDelete: "SET NULL")]
    private ?Ration $ration = null;

    #[ORM\OneToMany(mappedBy: 'cheptel', targetEntity: Chevre::class)]
    #[ORM\JoinColumn(nullable: true,onDelete: "SET NULL")]
    private Collection $chevres;

    public function __construct()
    {
        $this->productions = new ArrayCollection();
        $this->chevres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCheptel(): ?string
    {
        return $this->nomCheptel;
    }

    public function setNomCheptel(string $nomCheptel): static
    {
        $this->nomCheptel = $nomCheptel;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

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
     * @return Collection<int, Production>
     */
    public function getProductions(): Collection
    {
        return $this->productions;
    }

    public function addProduction(Production $production): static
    {
        if (!$this->productions->contains($production)) {
            $this->productions->add($production);
        }

        return $this;
    }

    public function removeProduction(Production $production): static
    {
        $this->productions->removeElement($production);

        return $this;
    }

    public function getRation(): ?Ration
    {
        return $this->ration;
    }

    public function setRation(?Ration $ration): static
    {
        $this->ration = $ration;

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
            $chevre->setCheptel($this);
        }

        return $this;
    }

    public function removeChevre(Chevre $chevre): static
    {
        if ($this->chevres->removeElement($chevre)) {
            // set the owning side to null (unless already changed)
            if ($chevre->getCheptel() === $this) {
                $chevre->setCheptel(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this->nomCheptel;
    }

}
