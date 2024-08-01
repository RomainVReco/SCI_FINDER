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
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('*')
            ->from('sci', 'sci')
            ->where('sci.id_sci LIKE :partialId')
            ->setParameter('partialId', $partialSciId.'%');

        $query = $queryBuilder->getQuery();
        return $query->getResult();
    }

    public function findByPartialName(string $name):array 
    {
        $em = $this->getEntityManager();
        print_r($name);
        $queryBuilder = $em->createQueryBuilder();
        $queryBuilder->select('*')
            ->from('sci', 'sci')
            ->where('sci.denomination LIKE :name')
            ->setParameter('name', $name . '%');
        $query = $queryBuilder->getQuery();
        return $query->getResult();
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
