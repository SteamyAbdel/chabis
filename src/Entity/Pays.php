<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPays = null;

    #[ORM\Column(length: 2)]
    private ?string $codePays = null;

    #[ORM\Column(length: 255)]
    private ?string $refPays = null;

    #[ORM\Column(length: 255)]
    private ?string $commentaire = null;

    #[ORM\OneToMany(mappedBy: 'pays', targetEntity: Chevre::class)]
    #[ORM\JoinColumn(nullable: true)]
    private Collection $chevres;

    public function __construct()
    {
        $this->chevres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPays(): ?string
    {
        return $this->nomPays;
    }

    public function setNomPays(string $nomPays): static
    {
        $this->nomPays = $nomPays;

        return $this;
    }

    public function getCodePays(): ?string
    {
        return $this->codePays;
    }

    public function setCodePays(string $codePays): static
    {
        $this->codePays = $codePays;

        return $this;
    }

    public function getRefPays(): ?string
    {
        return $this->refPays;
    }

    public function setRefPays(string $refPays): static
    {
        $this->refPays = $refPays;

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
            $chevre->setPays($this);
        }

        return $this;
    }

    public function removeChevre(Chevre $chevre): static
    {
        if ($this->chevres->removeElement($chevre)) {
            // set the owning side to null (unless already changed)
            if ($chevre->getPays() === $this) {
                $chevre->setPays(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        // TODO: Implement __toString() method.
        return $this ->nomPays;
    }

}
