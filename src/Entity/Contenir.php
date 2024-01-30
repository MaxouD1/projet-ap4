<?php

namespace App\Entity;

use App\Repository\ContenirRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: ContenirRepository::class)]
#[ApiResource()]
class Contenir
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $quantite = null;

    #[ORM\Column]
    private ?float $TVA = null;

    #[ORM\Column]
    private ?float $prixUnitaire = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $fkProduit = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $fkCommande = null;

    #[ORM\ManyToOne(inversedBy: 'contenirs')]
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

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): static
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getPrixUnitaire(): ?float
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire(float $prixUnitaire): static
    {
        $this->prixUnitaire = $prixUnitaire;

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

    public function getFkCommandeId(): ?Commande
    {
        return $this->fkCommande;
    }

    public function setFkCommandeId(?Commande $fkCommande): static
    {
        $this->fkCommande = $fkCommande;

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