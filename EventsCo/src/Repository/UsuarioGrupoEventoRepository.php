<?php

namespace App\Repository;

use App\Entity\UsuarioGrupoEvento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsuarioGrupoEvento|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioGrupoEvento|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioGrupoEvento[]    findAll()
 * @method UsuarioGrupoEvento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioGrupoEventoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioGrupoEvento::class);
    }

    // /**
    //  * @return UsuarioGrupoEvento[] Returns an array of UsuarioGrupoEvento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsuarioGrupoEvento
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
