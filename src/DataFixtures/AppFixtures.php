<?php

namespace App\DataFixtures;

use App\Entity\Stocker;
use App\Entity\User;
use App\Entity\Rayon;
use App\Entity\Produits;
use App\Entity\Entrepot;
use App\Entity\Magasin;
use App\Entity\Existe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager)
    {
        $rayons = [
            'Football',
            'Basketball',
            'Tennis',
            'Rugby',
            'Natation',
            'Athlétisme',
            'Volleyball',
            'Badminton',
            'Baseball',
            'Hockey'
        ];

        $marques = [
            'Nike',
            'Adidas',
            'Puma',
            'Under Armour',
            'Reebok',
            'New Balance',
            'Mizuno',
            'Asics',
            'Wilson',
            'Rawlings'
        ];

        $typesProduit = [
            'Chaussures',
            'Maillots',
            'Shorts',
            'Equipements de protection',
            'Balles',
            'Raquettes',
            'Gants',
            'Filets',
            'Bâtons',
            'Casques'
        ];

        //Création des rayons
        foreach ($rayons as $key => $rayonName) {
            $rayon = new Rayon();
            $rayon->setNom($rayonName);
            $manager->persist($rayon);
            $this->addReference('rayon-' . $key, $rayon);
        }
        $manager->flush();

        // Création des entrepôts
        for ($i = 1; $i <= 3; $i++) {
            $entrepot = new Entrepot();
            $entrepot->setAdresse("Adresse de l'entrepôt $i");
            $entrepot->setVille("Ville $i");
            $entrepot->setCodePostal(rand(10000, 99999));
            $manager->persist($entrepot);
            $this->addReference('entrepot-' . $i, $entrepot); // Ajoutez une référence pour chaque entrepôt créé
        }

        // Création des produits
        for ($x = 1; $x <= 500; $x++) {
            $produit = new Produits();
            $rayonRef = $this->getReference('rayon-' . rand(0, count($rayons) - 1));

            $nomProduit = $rayonRef->getNom() . ' ' . $marques[array_rand($marques)] . ' ' . $typesProduit[array_rand($typesProduit)];

            $produit->setNom($nomProduit);
            $produit->setPrix(rand(20, 200));
            $produit->setDescription("Description du produit $x");
            $produit->setRayonId($rayonRef); 
        

            $manager->persist($produit);

            // Créez des relations Produit-Entrepot avec une quantité aléatoire
            for ($i = 1; $i <= rand(1, 3); $i++) { 
                $entrepot = $this->getReference('entrepot-' . rand(1, 3)); 
                $quantite = rand(1, 10); 

                $existe = new Existe();
                $existe->setFkEntrepotId($entrepot);
                $existe->setFkProduitId($produit);
                $existe->setQuantite($quantite);
                $manager->persist($existe);
            }
        }

        // Création d'un utilisateur
        $user = new User();
        $user->setPrenom('Amanie');
        $user->setNom("Said");
        $user->setEmail('amanie@gmail.com');
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setPrenom('Maxence');
        $user->setNom("Drozdz");
        $user->setEmail('maxence@gmail.com');
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setPrenom('Thomas');
        $user->setNom("Dindin");
        $user->setEmail('thomas@gmail.com');
        $password = $this->hasher->hashPassword($user, '123456');
        $user->setPassword($password);
        $manager->persist($user);

        $manager->flush();
    }
}
