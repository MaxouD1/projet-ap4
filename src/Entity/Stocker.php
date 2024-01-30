<?php

namespace App\Entity;

use App\Repository\StockerRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: StockerRepository::class)]
#[ApiResource()]
class Stocker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\ManyToOne(inversedBy: 'stockers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduit = null;

    #[ORM\ManyToOne(inversedBy: 'stockers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Magasin $fkMagasin = null;

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

    public function getFkMagasinId(): ?Magasin
    {
        return $this->fkMagasin;
    }

    public function setFkMagasinId(?Magasin $fkMagasin): static
    {
        $this->fkMagasin = $fkMagasin;

        return $this;
    }
}