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
            'Chaussures' => 'https://media.discordapp.net/attachments/557281370506788885/1201909279658090566/Sans_titre.jpg?ex=65cb883e&is=65b9133e&hm=441c439153c66bed9c8b3bcd8100b36a7aee15a08744f8b640fe91db8cdc99dc&=&format=webp',
            'Maillots' => 'https://media.discordapp.net/attachments/557281370506788885/1201909070387220520/maillot-de-bain-1-piece-dos-nu-et-fines-bretelles-croisees-uni-rouge.jpg?ex=65cb880c&is=65b9130c&hm=999584664e40a9536d098318b34aa93c8652187049608a038a27958967b2e861&=&format=webp&width=360&height=468',
            'Shorts' => 'https://media.discordapp.net/attachments/557281370506788885/1201909154147729418/istockphoto-697913308-612x612.jpg?ex=65cb8820&is=65b91320&hm=8cefa47fb0a0cf54d8a1b6a713df8961dfa17b105631ece5ced648e9b390424a&=&format=webp',
            'Equipements de protection' => 'https://media.discordapp.net/attachments/557281370506788885/1201909712644218931/Sans_titre.jpg?ex=65cb88a5&is=65b913a5&hm=8349bd41439061ef7a5ca470b0fbec886bef523492177728049513dbeb68742d&=&format=webp',
            'Balles' => 'https://media.discordapp.net/attachments/557281370506788885/1201909856592732180/unnamed.png?ex=65cb88c8&is=65b913c8&hm=d4f2a90ef61c73384419e46ee06edffe1501184f7307da9721a9c394e3b8fb7d&=&format=webp&quality=lossless&width=446&height=468',
            'Raquettes' => 'https://media.discordapp.net/attachments/557281370506788885/1201909954873655336/Raquette-de-tennis.jpg?ex=65cb88df&is=65b913df&hm=ee90fb7e71f77cd18b394dca44648006caab67992599759a17ba26481e672922&=&format=webp',
            'Gants' => 'https://media.discordapp.net/attachments/557281370506788885/1201910051380674560/81RE9EBCagL._AC_UF10001000_QL80_.jpg?ex=65cb88f6&is=65b913f6&hm=ae546d4ec7b31a44228fd67711a1dd01bff71ef5876b1d6a0bafff565e46c267&=&format=webp&width=447&height=468',
            'Filets' => 'https://media.discordapp.net/attachments/557281370506788885/1201910171824291911/filet-multi-sports-reglable-sportnet-75-a-150-cm.jpg?ex=65cb8913&is=65b91413&hm=86c05dfaf18bf484dd1a386f4e886ea3c5fa9303b9649c26b9c286b7d0835434&=&format=webp&width=468&height=468',
            'Bâtons' => 'https://media.discordapp.net/attachments/557281370506788885/1201910321594507284/batons-trail-sport-3-black-diamond.jpg?ex=65cb8937&is=65b91437&hm=f680814cbdd2aac395465577abfe41262153b1fdd8f7849ac19debe12b7afc9f&=&format=webp&width=468&height=468',
            'Casques' => 'https://media.discordapp.net/attachments/557281370506788885/1201910401357578280/Sans_titre.jpg?ex=65cb894a&is=65b9144a&hm=76f90d4b809c80349561be73d2d2ca1da486758b4944ec4cf9d9e549f5eb8c73&=&format=webp'
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
            $marque = $marques[array_rand($marques)];
            $rayonNom = $rayonRef->getNom();
            $typeProduitChoisi = array_rand($typesProduit);
            $photoProduit = $typesProduit[$typeProduitChoisi];
    

            $nomProduit = $rayonRef->getNom() . ' ' . $marque . ' ' . $typeProduitChoisi ;
            $reference = substr($rayonNom, 0, 3).substr($marque, 0, 3).substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 12);

        

            $produit->setNom($nomProduit);
            $produit->setPrix(rand(20, 200));
            $produit->setDescription("Description du produit $x");
            $produit->setRayonId($rayonRef); 
            $produit->setReference($reference);
            $produit->setImage($photoProduit);
        

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
