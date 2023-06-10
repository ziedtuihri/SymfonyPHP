<?php

namespace App\Entity;

use App\Repository\MatcheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatcheRepository::class)]
class Matche
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $numMatche = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateM = null;

    #[ORM\Column]
    private ?int $nbSpectateurs = null;

    #[ORM\OneToMany(mappedBy: 'matche', targetEntity: Stade::class, orphanRemoval: true)]
    private Collection $yes;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getNumMatche(): ?int
    {
        return $this->numMatche;
    }

    public function setNumMatche(int $numMatche): self
    {
        $this->numMatche = $numMatche;

        return $this;
    }

    public function getDateM(): ?\DateTimeInterface
    {
        return $this->dateM;
    }

    public function setDateM(\DateTimeInterface $dateM): self
    {
        $this->dateM = $dateM;

        return $this;
    }

    public function getNbSpectateurs(): ?int
    {
        return $this->nbSpectateurs;
    }

    public function setNbSpectateurs(int $nbSpectateurs): self
    {
        $this->nbSpectateurs = $nbSpectateurs;

        return $this;
    }

    /**
     * @return Collection<int, Stade>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Stade $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setMatche($this);
        }

        return $this;
    }

    public function removeYe(Stade $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getMatche() === $this) {
                $ye->setMatche(null);
            }
        }

        return $this;
    }
}
