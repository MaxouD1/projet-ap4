<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetUserMailController extends AbstractController
{
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
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

        // Vérifier si l'utilisateur existe et si le mot de passe est valide
        if ($user && $this->get('security.password_encoder')->isPasswordValid($user, $mdp)) {
            // Vous pouvez ajouter d'autres vérifications ici si nécessaire

            return $this->json($user, 200);
        } else {
            return $this->json(['error' => 'Utilisateur non trouvé ou mot de passe invalide.'], 404);
        }
    }
}
