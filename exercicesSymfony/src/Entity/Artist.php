<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biography = null;

    #[ORM\OneToMany(mappedBy: 'artist', targetEntity: OEuvre::class)]
    private Collection $yes;

    public function __construct()
    {
        $this->yes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection<int, OEuvre>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(OEuvre $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes->add($ye);
            $ye->setArtist($this);
        }

        return $this;
    }

    public function removeYe(OEuvre $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getArtist() === $this) {
                $ye->setArtist(null);
            }
        }

        return $this;
    }
}
