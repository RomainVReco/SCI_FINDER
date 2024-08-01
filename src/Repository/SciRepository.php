<?php

namespace App\Repository;

use App\Entity\Sci;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sci>
 */
class SciRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sci::class);
    }

    public function findByPartialId(string $partialSciId):array 
    {
        $queryBuilder = $this->createQueryBuilder('sci');
        
        $queryBuilder->where('sci.idSci LIKE :partialId')
                     ->setParameter('partialId', $partialSciId . '%');
        
        return $queryBuilder->getQuery()->getResult();
    }

    public function findByPartialName(string $denomination):array 
    {
        $queryBuilder = $this->createQueryBuilder('sci');
        
        $queryBuilder->where('sci.denomination LIKE :denomination')
                    ->setParameter('denomination', $denomination . '%');
        
        return $queryBuilder->getQuery()->getResult();
    }

//    /**
//     * @return Sci[] Returns an array of Sci objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sci
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
