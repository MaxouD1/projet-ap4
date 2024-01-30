<?php

namespace App\Entity;

use App\Repository\ExisteRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ExisteRepository::class)]
#[ApiResource()]
class Existe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'existes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduit = null;

    #[ORM\ManyToOne(inversedBy: 'existes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entrepot $fkEntrepot = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getFkProduitId(): ?Produits
    {
        return $this->fkProduit;
    }

    public function setFkProduitId(?Produits $fkProduit): static
    {
        $this->fkProduit = $fkProduit;

        return $this;
    }

    public function getFkEntrepotId(): ?Entrepot
    {
        return $this->fkEntrepot;
    }

    public function setFkEntrepotId(?Entrepot $fkEntrepot): static
    {
        $this->fkEntrepot = $fkEntrepot;

        return $this;
    }

}