<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GetUserMailController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/mail', name: 'app_get_user_mail', methods: ['POST'])]
    public function getUserByMail(Request $request): JsonResponse
    {
        // Récupérer le contenu JSON de la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier si les clés 'email' et 'mdp' existent dans le tableau $data
        if (!isset($data['email']) || !isset($data['mdp'])) {
            return $this->json(['error' => 'L\'email ou le mot de passe est manquant dans la requête.'], 400);
        }

        // Récupérer l'email et le mot de passe à partir des données JSON
        $email = $data['email'];
        $mdp = $data['mdp'];

        // Récupérer l'utilisateur par email depuis la base de données
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user && $user->getPassword() === $mdp) {
            return $this->json($user, 200);
        } else {
            return $this->json(['error' => 'Utilisateur non trouvé ou mot de passe invalide.'], 404);
        }
    }
}
