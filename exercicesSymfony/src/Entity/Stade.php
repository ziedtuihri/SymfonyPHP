<?php

namespace App\Entity;

use App\Repository\StadeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StadeRepository::class)]
class Stade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $nom = null;

    #[ORM\Column(length: 200)]
    private ?string $ville = null;

    #[ORM\ManyToOne(inversedBy: 'yes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matche $matche = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getMatche(): ?Matche
    {
        return $this->matche;
    }

    public function setMatche(?Matche $matche): self
    {
        $this->matche = $matche;

        return $this;
    }
}
