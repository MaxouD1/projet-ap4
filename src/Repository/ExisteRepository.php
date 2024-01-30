<?php

namespace App\Repository;

use App\Entity\Existe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Existe>
 *
 * @method Existe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Existe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Existe[]    findAll()
 * @method Existe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Existe::class);
    }

//    /**
//     * @return Existe[] Returns an array of Existe objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Existe
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
