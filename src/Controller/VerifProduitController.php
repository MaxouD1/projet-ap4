<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class VerifProduitController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/api/verifproduits/{id}', name: 'app_verif_produit',  methods: ['GET'])]
    public function index(Request $request): Response
    {
        $idproduit = $request->get('id');

    $qb = $this->entityManager->createQueryBuilder();
    $qb->select('entrepot.id, SUM(existe.quantite) as quantite')
    ->from('App\Entity\Existe', 'existe')
    ->join('existe.fkEntrepot', 'entrepot') 
    ->where('existe.fkProduit = :idproduit')
    ->groupBy('existe.fkEntrepot')
    ->setParameter('idproduit', $idproduit);
    $query = $qb->getQuery();
    $result = $query->getResult();

    if ($result !== null) {
       return $this->json($result, 200);
    } else {
        return $this->json(['error' => 'TAMER'], 404);
    }
}
}
